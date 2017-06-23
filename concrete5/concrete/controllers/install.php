<?php
namespace Concrete\Controller;

use Concrete\Core\Cache\Cache;
use Concrete\Core\Config\Renderer;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Localization\Localization as Localization;
use Controller;
use Exception;
use Hautelook\Phpass\PasswordHash;
use StartingPointPackage;
use View;
use Database;
use ReflectionObject;
use stdClass;
use Concrete\Core\Url\UrlImmutable;

defined('C5_EXECUTE') or die("Access Denied.");

if (!ini_get('safe_mode')) {
    @set_time_limit(1000);
}

class Install extends Controller
{
    /**
     * This is to check if comments are being stripped
     * Doctrine ORM depends on comments not being stripped.
     *
     * @var int
     */
    protected $docCommentCanary = 1;

    /**
     * If the database already exists and is valid, lets just attach to it rather than installing over it.
     *
     * @var bool
     */
    protected $auto_attach = false;

    /**
     * Handle of the site_install.php file.
     *
     * @var resource|null|false
     */
    protected $fp;

    /**
     * Handle of the site_install_user.php file.
     *
     * @var resource|null|false
     */
    protected $fpu;

    public $helpers = ['form', 'html'];

    public function getViewObject()
    {
        $v = new View('/frontend/install');
        $v->setViewTheme('concrete');

        return $v;
    }

    public function view()
    {
        $locales = $this->getLocales();
        $this->set('locales', $locales);
        $this->set('backgroundFade', 500);
        $this->testAndRunInstall();
    }

    protected function getLocales()
    {
        return Localization::getAvailableInterfaceLanguageDescriptions(null);
    }

    protected function testAndRunInstall()
    {
        if (file_exists(DIR_CONFIG_SITE . '/site_install_user.php')) {
            $this->set('backgroundFade', 0);
            require DIR_CONFIG_SITE . '/site_install.php';
            @include DIR_CONFIG_SITE . '/site_install_user.php';
            if (defined('APP_INSTALL_LANGUAGE') && APP_INSTALL_LANGUAGE) {
                Localization::changeLocale(APP_INSTALL_LANGUAGE);
            }
            $e = $this->app->make('helper/validation/error');
            $e = $this->validateDatabase($e);
            if (defined('INSTALL_STARTING_POINT') && INSTALL_STARTING_POINT) {
                $spName = INSTALL_STARTING_POINT;
            } else {
                $spName = 'elemental_full';
            }
            $spl = StartingPointPackage::getClass($spName);
            if ($spl === null) {
                $e->add(t('Invalid starting point: %s', $spName));
            }
            if ($e->has()) {
                $this->set('error', $e);
            } else {
                $this->set('installPackage', $spl->getPackageHandle());
                $this->set('installRoutines', $spl->getInstallRoutines());
                $this->set(
                    'successMessage',
                    t(
                        'concrete5 has been installed. You have been logged in as <b>%s</b> with the password you chose. If you wish to change this password, you may do so from the users area of the dashboard.',
                        USER_SUPER
                    )
                );
            }
        }
    }

    protected function validateDatabase(ErrorList $e)
    {
        if (!extension_loaded('pdo')) {
            $e->add($this->getDBErrorMsg());
        } else {
            $DB_SERVER = isset($_POST['DB_SERVER']) ? $_POST['DB_SERVER'] : null;
            $DB_DATABASE = isset($_POST['DB_DATABASE']) ? $_POST['DB_DATABASE'] : null;
            $db = Database::getFactory()->createConnection(
                [
                    'host' => $DB_SERVER,
                    'user' => isset($_POST['DB_USERNAME']) ? $_POST['DB_USERNAME'] : null,
                    'password' => isset($_POST['DB_PASSWORD']) ? $_POST['DB_PASSWORD'] : null,
                    'database' => $DB_DATABASE,
                ]
            );

            if ($DB_SERVER && $DB_DATABASE) {
                if (!$db) {
                    $e->add(t('Unable to connect to database.'));
                } elseif (!$this->isAutoAttachEnabled()) {
                    $num = $db->GetCol("show tables");
                    if (count($num) > 0) {
                        $e->add(
                            t(
                                'There are already %s tables in this database. concrete5 must be installed in an empty database.',
                                count($num)
                            )
                        );
                    }

                    try {
                        $support = $db->fetchAll('show engines');
                        $supported = false;
                        foreach ($support as $engine) {
                            $engine = array_change_key_case($engine, CASE_LOWER);
                            if (isset($engine['engine']) && strtolower($engine['engine']) == 'innodb') {
                                $supported = true;
                            }
                        }
                        if (!$supported) {
                            $e->add(t('Your MySQL database does not support InnoDB database tables. These are required.'));
                        }
                    } catch (Exception $exception) {
                        // we're going to just proceed and hope for the best.
                    }
                }
            }
        }

        return $e;
    }

    public function getDBErrorMsg()
    {
        return t('The PDO extension is not loaded.');
    }

    public function setup()
    {
        $config = $this->app['config'];
        $passwordMinLength = (int) $config->get('concrete.user.password.minimum', 5);
        $passwordMaxLength = (int) $config->get('concrete.user.password.maximum');
        $passwordAttributes = [
            'autocomplete' => 'off',
        ];
        if ($passwordMinLength > 0) {
            $passwordAttributes['required'] = 'required';
            if ($passwordMaxLength > 0) {
                $passwordAttributes['placeholder'] = t('Between %1$s and %2$s Characters', $passwordMinLength, $passwordMaxLength);
                $passwordAttributes['pattern'] = '.{'.$passwordMinLength.','.$passwordMaxLength.'}';
            } else {
                $passwordAttributes['placeholder'] = t('at least %s characters', $passwordMinLength);
                $passwordAttributes['pattern'] = '.{'.$passwordMinLength.',}';
            }
        } elseif ($passwordMaxLength > 0) {
            $passwordAttributes['placeholder'] = t('up to %s characters', $passwordMaxLength);
            $passwordAttributes['pattern'] = '.{0,'.$passwordMaxLength.'}';
        }
        $this->set('passwordAttributes', $passwordAttributes);
        $canonicalUrl = '';
        $canonicalUrlChecked = false;
        $canonicalSSLUrl = '';
        $canonicalSSLUrlChecked = false;
        $uri = $this->request->getUri();
        if (preg_match('/^(https?)(:.+?)(?:\/'.preg_quote(DISPATCHER_FILENAME, '%').')?\/install(?:$|\/|\?)/i', $uri, $m)) {
            $canonicalUrl = 'http'.rtrim($m[2], '/');
            $canonicalSSLUrl = 'https'.rtrim($m[2], '/');
            /*switch (strtolower($m[1])) {
                case 'http':
                    $canonicalUrlChecked = true;
                    break;
                case 'http':
                    $canonicalSSLUrlChecked = true;
                    break;
            }*/
        }
        $countries = [];
        $ll = $this->app->make('localization/languages');
        $cl = $this->app->make('lists/countries');
        $computedSiteLocaleLanguage = Localization::activeLanguage();
        $computedSiteLocaleCountry = null;
        $recommendedCountryValues = $cl->getCountriesForLanguage($computedSiteLocaleLanguage);
        $otherCountries = [];
        foreach ($cl->getCountries() as $code => $country) {
            if (!in_array($code, $recommendedCountryValues)) {
                $otherCountries[$code] = $country;
            }
        }
        $recommendedCountries = [];
        foreach ($recommendedCountryValues as $country) {
            if (!$computedSiteLocaleCountry) {
                $computedSiteLocaleCountry = $country;
            }
            $recommendedCountries[$country] = $cl->getCountryName($country);
        }
        $languages = $ll->getLanguageList();
        $this->set('languages', $languages);
        $this->set('countries', $countries);
        $this->set('computedSiteLocaleLanguage', $computedSiteLocaleLanguage);
        $this->set('computedSiteLocaleCountry', $computedSiteLocaleCountry);
        $this->set('recommendedCountries', $recommendedCountries);
        $this->set('otherCountries', $otherCountries);
        $this->set('setInitialState', $this->request->post('SITE') === null);
        $this->set('canonicalUrl', $canonicalUrl);
        $this->set('canonicalUrlChecked', $canonicalUrlChecked);
        $this->set('canonicalSSLUrl', $canonicalSSLUrl);
        $this->set('canonicalSSLUrlChecked', $canonicalSSLUrlChecked);
    }

    public function select_language()
    {
    }

    /**
     * Testing.
     */
    public function on_start()
    {
        $this->addHeaderItem('<link href="'.ASSETS_URL_CSS.'/views/install.css" rel="stylesheet" type="text/css" media="all" />');
        $this->requireAsset('core/app');
        $this->requireAsset('javascript', 'backstretch');
        $this->requireAsset('javascript', 'bootstrap/collapse');
        if (isset($_POST['locale']) && $_POST['locale']) {
            $loc = Localization::changeLocale($_POST['locale']);
            $this->set('locale', $_POST['locale']);
        }
        Cache::disableAll();
        $this->setRequiredItems();
        $this->setOptionalItems();

        if ($this->app->isInstalled()) {
            throw new Exception(t('concrete5 is already installed.'));
        }
        if (!isset($_COOKIE['CONCRETE5_INSTALL_TEST'])) {
            setcookie('CONCRETE5_INSTALL_TEST', '1', 0, DIR_REL . '/');
        }
        $this->set('backgroundFade', 0);
        $this->set('pageTitle', t('Install concrete5'));
    }

    private function setRequiredItems()
    {
        //        $this->set('imageTest', function_exists('imagecreatetruecolor') || class_exists('Imagick'));
        $this->set('imageTest', function_exists('imagecreatetruecolor')
            && function_exists('imagepng')
            && function_exists('imagegif')
            && function_exists('imagejpeg'));
        $this->set('mysqlTest', extension_loaded('pdo_mysql'));
        $this->set('i18nTest', function_exists('ctype_lower') && function_exists('iconv') && extension_loaded('mbstring'));
        $this->set('domTest', extension_loaded('dom'));
        $this->set('jsonTest', extension_loaded('json'));
        $this->set('xmlTest', function_exists('xml_parse') && function_exists('simplexml_load_file'));
        $this->set('fileWriteTest', $this->testFileWritePermissions());
        $this->set('aspTagsTest', ini_get('asp_tags') == false);
        $this->set('finfoTest', function_exists('finfo_open'));
        $rf = new ReflectionObject($this);
        $rp = $rf->getProperty('docCommentCanary');
        $this->set('docCommentTest', (bool) $rp->getDocComment());

        $memoryThresoldMin = 24 * 1024 * 1024;
        $memoryThresold = 64 * 1024 * 1024;
        $this->set('memoryThresoldMin', $memoryThresoldMin);
        $this->set('memoryThresold', $memoryThresold);
        $memoryLimit = ini_get('memory_limit');
        if ($memoryLimit == -1) {
            $this->set('memoryTest', 1);
            $this->set('memoryBytes', 0);
        } else {
            $val = $this->app->make('helper/number')->getBytes($memoryLimit);
            $this->set('memoryBytes', $val);
            if ($val < $memoryThresoldMin) {
                $this->set('memoryTest', -1);
            } elseif ($val >= $memoryThresold) {
                $this->set('memoryTest', 1);
            } else {
                $this->set('memoryTest', 0);
            }
        }

        $phpVmin = $this->getMinimumPhpVersion();
        if (version_compare(PHP_VERSION, $phpVmin, '>=')) {
            $phpVtest = true;
        } else {
            $phpVtest = false;
        }
        $this->set('phpVmin', $phpVmin);
        $this->set('phpVtest', $phpVtest);
    }

    private function testFileWritePermissions()
    {
        $e = $this->app->make('helper/validation/error');
        if (!is_writable(DIR_CONFIG_SITE)) {
            $e->add(t('Your configuration directory config/ does not appear to be writable by the web server.'));
        }

        if (!is_writable(DIR_FILES_UPLOADED_STANDARD)) {
            $e->add(t('Your files directory files/ does not appear to be writable by the web server.'));
        }

        if (!is_writable(DIR_PACKAGES)) {
            $e->add(t('Your packages directory packages/ does not appear to be writable by the web server.'));
        }

        $this->fileWriteErrors = $e;
        if ($this->fileWriteErrors->has()) {
            return false;
        } else {
            return true;
        }
    }

    private function setOptionalItems()
    {
        // no longer need lucene
        //$this->set('searchTest', function_exists('iconv') && function_exists('mb_strtolower') && (@preg_match('/\pL/u', 'a') == 1));
        $this->set('remoteFileUploadTest', function_exists('iconv'));
        $this->set('fileZipTest', class_exists('ZipArchive'));
    }

    public function passedRequiredItems()
    {
        if ($this->get('imageTest') && $this->get('mysqlTest') && $this->get('fileWriteTest') &&
            $this->get('xmlTest') && $this->get('phpVtest') && $this->get('i18nTest') &&
            $this->get('memoryTest') !== -1 && $this->get('docCommentTest') && $this->get('aspTagsTest') &&
            $this->get('domTest')
        ) {
            return true;
        }
    }

    public function test_url($num1, $num2)
    {
        $js = $this->app->make('helper/json');
        $num = $num1 + $num2;
        echo $js->encode(['response' => $num]);
        exit;
    }

    public function run_routine($pkgHandle, $routine)
    {
        $spl = StartingPointPackage::getClass($pkgHandle);
        require DIR_CONFIG_SITE . '/site_install.php';
        @include DIR_CONFIG_SITE . '/site_install_user.php';
        $jsx = $this->app->make('helper/json');
        $js = new stdClass();

        try {
            if ($spl === null) {
                throw new Exception(t('Invalid starting point: %s', $pkgHandle));
            }
            $spl->executeInstallRoutine($routine);
            $js->error = false;
        } catch (Exception $e) {
            $js->error = true;
            $js->message = tc('InstallError', '%s.<br><br>Trace:<br>%s', $e->getMessage(), $e->getTraceAsString());
            $this->reset();
        }
        echo $jsx->encode($js);
        exit;
    }

    public function reset()
    {
        // remove site.php so that we can try again ?

        if (is_resource($this->fp)) {
            fclose($this->fp);
        }
        if (file_exists(DIR_CONFIG_SITE . '/site_install.php')) {
            unlink(DIR_CONFIG_SITE . '/site_install.php');
        }
        if (file_exists(DIR_CONFIG_SITE . '/site_install_user.php')) {
            unlink(DIR_CONFIG_SITE . '/site_install_user.php');
        }
    }

    /**
     * @return \Concrete\Core\Error\Error
     */
    public function configure()
    {
        $error = $this->app->make('helper/validation/error');
        /* @var $error \Concrete\Core\Error\ErrorList\ErrorList */
        try {
            $val = $this->app->make('helper/validation/form');
            /* @var \Concrete\Core\Form\Service\Validation $val */
            $val->setData($this->post());
            $val->addRequired("SITE", t("Please specify your site's name"));
            $val->addRequiredEmail("uEmail", t('Please specify a valid email address'));
            $val->addRequired("DB_DATABASE", t('You must specify a valid database name'));
            $val->addRequired("DB_SERVER", t('You must specify a valid database server'));

            $password = $_POST['uPassword'];
            $passwordConfirm = $_POST['uPasswordConfirm'];

            $this->app->make('validator/password')->isValid($password, $error);

            if ($password) {
                if ($password != $passwordConfirm) {
                    $error->add(t('The two passwords provided do not match.'));
                }
            }

            if (is_object($this->fileWriteErrors)) {
                foreach ($this->fileWriteErrors->getList() as $msg) {
                    $error->add($msg);
                }
            }

            $error = $this->validateDatabase($error);
            $error = $this->validateSampleContent($error);

            if ($this->post('canonicalUrlChecked') === '1') {
                try {
                    $url = UrlImmutable::createFromUrl($this->post('canonicalUrl'));
                    if (strcasecmp('http', $url->getScheme()) !== 0) {
                        throw new Exception('The HTTP canonical URL must have the http:// scheme');
                    }
                    $canonicalUrl = (string) $url;
                } catch (Exception $x) {
                    $error->add($x);
                }
            } else {
                $canonicalUrl = '';
            }
            if ($this->post('canonicalSSLUrlChecked') === '1') {
                $url = UrlImmutable::createFromUrl($this->post('canonicalSSLUrl'));
                if (strcasecmp('https', $url->getScheme()) !== 0) {
                    throw new Exception('The SSL canonical URL must have the https:// scheme');
                }
                $canonicalSSLUrl = (string) $url;
            } else {
                $canonicalSSLUrl = '';
            }
            if ($val->test() && (!$error->has())) {

                // write the config file
                $vh = $this->app->make('helper/validation/identifier');
                $this->fp = @fopen(DIR_CONFIG_SITE . '/site_install.php', 'w+');
                $this->fpu = @fopen(DIR_CONFIG_SITE . '/site_install_user.php', 'w+');
                if ($this->fp) {
                    $config = isset($_POST['SITE_CONFIG']) ? ((array) $_POST['SITE_CONFIG']) : [];
                    $config['database'] = [
                        'default-connection' => 'concrete',
                        'connections' => [
                            'concrete' => [
                                'driver' => 'c5_pdo_mysql',
                                'server' => $_POST['DB_SERVER'],
                                'database' => $_POST['DB_DATABASE'],
                                'username' => $_POST['DB_USERNAME'],
                                'password' => $_POST['DB_PASSWORD'],
                                'charset' => 'utf8',
                            ],
                        ],
                    ];
                    $config['canonical-url'] = $canonicalUrl;
                    $config['canonical-ssl-url'] = $canonicalSSLUrl;
                    $config['session-handler'] = isset($_POST['sessionHandler']) ? $_POST['sessionHandler'] : null;

                    $renderer = new Renderer($config);
                    fwrite($this->fp, $renderer->render());

                    fclose($this->fp);
                    chmod(DIR_CONFIG_SITE . '/site_install.php', 0700);
                } else {
                    throw new Exception(t('Unable to open config/app.php for writing.'));
                }

                if ($this->fpu) {
                    $config = $this->app->make('config');
                    $hasher = new PasswordHash($config->get('concrete.user.password.hash_cost_log2'), $config->get('concrete.user.password.hash_portable'));
                    $configuration = "<?php\n";
                    $configuration .= "define('INSTALL_USER_EMAIL', " . var_export((string) $_POST['uEmail'], true) . ");\n";
                    $configuration .= "define('INSTALL_USER_PASSWORD_HASH', " . var_export((string) $hasher->HashPassword($_POST['uPassword']), true) . ");\n";
                    $configuration .= "define('INSTALL_STARTING_POINT', " . var_export((string) $this->post('SAMPLE_CONTENT'), true) . ");\n";
                    $configuration .= "define('SITE', " . var_export((string) $_POST['SITE'], true) . ");\n";
                    $locale = $this->post('siteLocaleLanguage') . '_' . $this->post('siteLocaleCountry');
                    $configuration .= "define('SITE_INSTALL_LOCALE', " . var_export($locale, true) . ");\n";
                    $configuration .= "define('APP_INSTALL_LANGUAGE', " . var_export($this->post('locale'), true) . ");\n";
                    $res = fwrite($this->fpu, $configuration);
                    fclose($this->fpu);
                    chmod(DIR_CONFIG_SITE . '/site_install_user.php', 0700);
                    if (PHP_SAPI != 'cli') {
                        $this->redirect('/');
                    }
                } else {
                    throw new Exception(t('Unable to open config/site_user.php for writing.'));
                }
            } else {
                if ($error->has()) {
                    $this->set('error', $error);
                } else {
                    $error = $val->getError();
                    $this->set('error', $val->getError());
                }
            }
        } catch (Exception $ex) {
            $this->reset();
            $this->set('error', $ex);
            $error->add($ex);
        }
        $this->setup();

        return $error;
    }

    protected function validateSampleContent($e)
    {
        $pkg = StartingPointPackage::getClass($this->post('SAMPLE_CONTENT'));

        if ($pkg === null) {
            $e->add(t("You must select a valid sample content starting point."));
        }

        return $e;
    }

    public function getMinimumPhpVersion()
    {
        return '5.5.9';
    }

    /**
     * @return bool
     */
    public function isAutoAttachEnabled()
    {
        return $this->auto_attach;
    }

    /**
     * @param bool $auto_attach
     */
    public function setAutoAttach($auto_attach)
    {
        $this->auto_attach = $auto_attach;
    }
}
