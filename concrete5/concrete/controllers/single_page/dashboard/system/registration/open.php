<?php
namespace Concrete\Controller\SinglePage\Dashboard\System\Registration;

use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Page\Controller\DashboardPageController;
use Config;
use Loader;

class Open extends DashboardPageController
{
    public $helpers = array('form');

    public function update_registration_type()
    {
        if (!$this->token->validate('update_registration_type')) {
            $this->error->add($this->token->getErrorMessage());
        }

        $config = $this->app->make(Repository::class);

        if (!$this->error->has() && $this->isPost()) {
            $config->save('concrete.user.registration.email_registration', ($this->post('email_as_username') ? true : false));

            $config->save('concrete.user.registration.type', $this->post('registration_type'));
            $config->save('concrete.user.registration.captcha', ($this->post('enable_registration_captcha')) ? true : false);
            $security = $this->app->make('helper/security');

            switch ($this->post('registration_type')) {
                case "enabled":
                    $config->save('concrete.user.registration.enabled', true);
                    $config->save('concrete.user.registration.validate_email', false);
                    $config->save('concrete.user.registration.notification', $this->post('register_notification'));
                    $config->save(
                        'concrete.user.registration.notification_email',
                        $security->sanitizeEmail($this->post('register_notification_email')));
                    break;

                case "validate_email":
                    $config->save('concrete.user.registration.enabled', true);
                    $config->save('concrete.user.registration.validate_email', true);
                    $config->save('concrete.user.registration.notification', $this->post('register_notification'));
                    $config->save(
                        'concrete.user.registration.notification_email',
                        $security->sanitizeEmail($this->post('register_notification_email')));
                    break;

                case "manual_approve":
                    $config->save('concrete.user.registration.enabled', true);
                    $config->save('concrete.user.registration.approval', true);
                    $config->save('concrete.user.registration.validate_email', false);
                    $config->save('concrete.user.registration.notification', $this->post('register_notification'));
                    $config->save(
                        'concrete.user.registration.notification_email',
                        $security->sanitizeEmail($this->post('register_notification_email')));
                    break;

                default: // disabled
                    $config->save('concrete.user.registration.enabled', false);
                    $config->save('concrete.user.registration.notification', false);
                    break;
            }
            $config->save('concrete.user.registration.type', $this->post('registration_type'));
            $this->redirect('/dashboard/system/registration/open', 1);
        }
    }

    public function view($updated = false)
    {
        if ($updated) {
            $this->set('message', t('Registration settings have been saved.'));
        }

        $config = $this->app->make(Repository::class);
        $type = $config->get('concrete.user.registration.type');
        if (!$type) {
            $type = 'disabled';
        }
        $this->set('email_as_username', $config->get('concrete.user.registration.email_registration'));
        $this->set('registration_type', $type);
        $this->set('enable_registration_captcha', $config->get('concrete.user.registration.captcha'));
        $this->set('register_notification', (bool) $config->get('concrete.user.registration.notification'));
        $this->set('register_notification_email', $config->get('concrete.user.registration.notification_email'));
    }
}
