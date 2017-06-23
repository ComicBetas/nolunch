<?php

return [
    /*
     * Current Version
     *
     * @var string
     */
    'version' => '8.1.0',
    'version_installed' => '8.1.0',
    'version_db' => '20170123000000', // the key of the latest database migration

    /*
     * Installation status
     *
     * @var bool
     */
    'installed' => true,

    /*
     * The current Locale
     */
    'locale' => 'en_US',

    /*
     * The current Charset
     */
    'charset' => 'UTF-8',

    /*
     * Maintenance mode
     */
    'maintenance_mode' => false,

    /*
     * ------------------------------------------------------------------------
     * Debug settings
     * ------------------------------------------------------------------------
     */
    'debug' => [
        /*
         * Display errors
         *
         * @var bool
         */
        'display_errors' => true,

        /*
         * Site debug level
         *
         * @var string (message|debug)
         */
        'detail' => 'message',
    ],

    /*
     * ------------------------------------------------------------------------
     * Proxy Settings
     * ------------------------------------------------------------------------
     */
    'proxy' => [
        'host' => null,
        'port' => null,
        'user' => null,
        'password' => null,
    ],

    /*
     * ------------------------------------------------------------------------
     * File upload settings
     * ------------------------------------------------------------------------
     */
    'upload' => [
        /*
         * Allowed file extensions
         *
         * @var string semi-colon separated.
         */
        'extensions' => '*.flv;*.jpg;*.gif;*.jpeg;*.ico;*.docx;*.xla;*.png;*.psd;*.swf;*.doc;*.txt;*.xls;*.xlsx;' .
            '*.csv;*.pdf;*.tiff;*.rtf;*.m4a;*.mov;*.wmv;*.mpeg;*.mpg;*.wav;*.3gp;*.avi;*.m4v;*.mp4;*.mp3;*.qt;*.ppt;' .
            '*.pptx;*.kml;*.xml;*.svg;*.webm;*.ogg;*.ogv',
    ],

    /*
     * ------------------------------------------------------------------------
     * Interface settings
     * ------------------------------------------------------------------------
     */
    'interface' => [
        'panel' => [
            /*
             * Enable the page relations panel
             */
            'page_relations' => false,
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * Mail settings
     * ------------------------------------------------------------------------
     */
    'mail' => [
        'method' => 'PHP_MAIL',
        'methods' => [
            'smtp' => [
                'server' => '',
                'port' => '',
                'username' => '',
                'password' => '',
                'encryption' => '',
            ],
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * Cache settings
     * ------------------------------------------------------------------------
     */
    'cache' => [
        /*
         * Enabled
         *
         * @var bool
         */
        'enabled' => true,

        /*
         * Lifetime
         *
         * @var int Seconds
         */
        'lifetime' => 21600,

        /*
         * Cache overrides
         *
         * @var bool
         */
        'overrides' => true,

        /*
         * Cache Blocks
         *
         * @var bool
         */
        'blocks' => true,

        /*
         * Cache Assets
         *
         * @var bool
         */
        'assets' => false,

        /*
         * Cache Theme CSS/JS
         *
         * @var bool
         */
        'theme_css' => true,

        /*
         * Cache full page
         *
         * @var bool|string (block|all)
         */
        'pages' => false,

        /*
         * Use Doctrine development mode
         *
         * @var bool
         */
        'doctrine_dev_mode' => false,

        /*
         * How long to cache full page
         *
         * @var string
         */
        'full_page_lifetime' => 'default',

        /*
         * Custom lifetime value, only used if concrete.cache.full_page_lifetime is 'custom'
         *
         * @var int
         */
        'full_page_lifetime_value' => null,

        /*
         * Calculate the cache key reading the assets contents (true) of the assets modification time (false).
         *
         * @var bool
         */
        'full_contents_assets_hash' => false,

        'directory' => DIR_FILES_UPLOADED_STANDARD . '/cache',
        /*
         * Relative path to the cache directory. If empty it'll be calculated from concrete.cache.directory
         * @var string|null
         */
        'directory_relative' => null,
        'page' => [
            'directory' => DIR_FILES_UPLOADED_STANDARD . '/cache/pages',
            'adapter' => 'file',
        ],
        'environment' => [
            'file' => 'environment.cache',
        ],

        'levels' => [
            'expensive' => [
                'drivers' => [
                    'core_ephemeral' => [
                        'class' => '\Stash\Driver\Ephemeral',
                        'options' => [],
                    ],

                    'core_filesystem' => [
                        'class' => '\Stash\Driver\FileSystem',
                        'options' => [
                            'path' => DIR_FILES_UPLOADED_STANDARD . '/cache',
                            'dirPermissions' => DIRECTORY_PERMISSIONS_MODE_COMPUTED,
                            'filePermissions' => FILE_PERMISSIONS_MODE_COMPUTED,
                        ],
                    ],
                ],
            ],
            'object' => [
                'drivers' => [
                    'core_ephemeral' => [
                        'class' => '\Stash\Driver\Ephemeral',
                        'options' => [],
                    ],
                ],
            ],
        ],
    ],

    'multilingual' => [
        'redirect_home_to_default_locale' => false,
        'use_browser_detected_locale' => false,
        'default_locale' => false,
        'default_source_locale' => 'en_US',
    ],

    'design' => [
        'enable_custom' => true,
        'enable_layouts' => true,
    ],

    /*
     * ------------------------------------------------------------------------
     * Logging settings
     * ------------------------------------------------------------------------
     */
    'log' => [
        /*
         * Log emails
         *
         * @var bool
         */
        'emails' => true,

        /*
         * Log Errors
         *
         * @var bool
         */
        'errors' => true,

        /*
         * Log Spam
         *
         * @var bool
         */
        'spam' => false,

        'queries' => [
            /*
             * Whether to log database queries or not.
             *
             * @var bool
             */
            'log' => false,

            'clear_on_reload' => false,
        ],
    ],
    'jobs' => [
        'enable_scheduling' => true,
    ],

    'filesystem' => [
        /* Temporary directory.
         * @link \Concrete\Core\File\Service\File::getTemporaryDirectory
         */
        'temp_directory' => null,
        'permissions' => [
            'file' => FILE_PERMISSIONS_MODE_COMPUTED,
            'directory' => DIRECTORY_PERMISSIONS_MODE_COMPUTED,
        ],
    ],

/*
     * ------------------------------------------------------------------------
     * Email settings
     * ------------------------------------------------------------------------
     */
    'email' => [
        /*
         * Enable emails
         *
         * @var bool
         */
        'enabled' => true,
        'default' => [
            'address' => 'concrete5-noreply@concrete5',
            'name' => '',
        ],
        'form_block' => [
            'address' => false,
        ],
        'forgot_password' => [
            'address' => null,
            'name' => null,
        ],
        'validate_registration' => [
            'address' => null,
            'name' => null,
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * Marketplace settings
     * ------------------------------------------------------------------------
     */
    'marketplace' => [
        /*
         * Enable marketplace integration
         *
         * @var bool concrete.marketplace.enabled
         */
        'enabled' => true,

        /*
         * Time it takes for a request to timeout
         *
         * @var int concrete.marketplace.request_timeout
         */
        'request_timeout' => 30,

        /*
         * Marketplace Token
         *
         * @var null|string concrete.marketplace.token
         */
        'token' => null,

        /*
         * Marketplace Site url Token
         *
         * @var null|string concrete.marketplace.site_token
         */
        'site_token' => null,

        /*
         * Enable intelligent search integration
         *
         * @var bool concrete.marketplace.intelligent_search
         */
        'intelligent_search' => true,

        /*
         * Log requests
         *
         * @var bool concrete.marketplace.log_requests
         */
        'log_requests' => false,
    ],

    /*
     * ------------------------------------------------------------------------
     * Getting external news and help from concrete5.org
     * ------------------------------------------------------------------------
     */
    'external' => [
        /*
         * Provide help within the intelligent search
         *
         * @var bool concrete.external.intelligent_search_help
         */
        'intelligent_search_help' => true,

        /*
         * Display an overlay with up-to-date news from concrete5
         *
         * @var bool concrete.external.news_overlay
         */
        'news_overlay' => false,

        /*
         * Enable concrete5 news within your site
         *
         * @var bool concrete.external.news
         */
        'news' => true,
    ],

    /*
     * --------------------------------------------------------------------
     * Miscellaneous settings
     * --------------------------------------------------------------------
     */
    'misc' => [
        'user_timezones' => false,
        'package_backup_directory' => DIR_FILES_UPLOADED_STANDARD . '/trash',
        'enable_progressive_page_reindex' => true,
        'mobile_theme_id' => 0,
        'sitemap_approve_immediately' => true,
        'enable_translate_locale_en_us' => false,
        'page_search_index_lifetime' => 259200,
        'enable_trash_can' => true,
        'app_version_display_in_header' => true,
        'default_jpeg_image_compression' => 80,
        'help_overlay' => true,
        'require_version_comments' => false,
    ],

    'theme' => [
        'compress_preprocessor_output' => true,
        'generate_less_sourcemap' => false,
    ],

    'updates' => [
        'enable_auto_update_packages' => false,
        'enable_permissions_protection' => true,
        'check_threshold' => 172800,
        'services' => [
            'get_available_updates' => 'http://www.concrete5.org/tools/update_core',
            'inspect_update' => 'http://www.concrete5.org/tools/inspect_update',
        ],
    ],
    'paths' => [
        'trash' => '/!trash',
        'drafts' => '/!drafts',
    ],
    'icons' => [
        'page_template' => [
            'width' => 120,
            'height' => 90,
        ],
        'theme_thumbnail' => [
            'width' => 120,
            'height' => 90,
        ],
        'file_manager_listing' => [
            'handle' => 'file_manager_listing',
            'width' => 60,
            'height' => 60,
        ],
        'file_manager_detail' => [
            'handle' => 'file_manager_detail',
            'width' => 400,
        ],
        'user_avatar' => [
            'width' => 80,
            'height' => 80,
            'default' => ASSETS_URL_IMAGES . '/avatar_none.png',
        ],
    ],

    'file_manager' => [
        'images' => [
            'use_exif_data_to_rotate_images' => false,
            'manipulation_library' => 'gd',
        ],
        'results' => 10,
    ],

    'search_users' => [
        'results' => 10,
    ],

    'sitemap_xml' => [
        'file' => 'sitemap.xml',
        'frequency' => 'weekly',
        'priority' => 0.5,
    ],

    /*
     * ------------------------------------------------------------------------
     * Accessibility
     * ------------------------------------------------------------------------
     */
    'accessibility' => [
        /*
         * Show titles in the concrete5 toolbars
         *
         * @var bool
         */
        'toolbar_titles' => false,

        /*
         * Increase the font size in the concrete5 toolbars
         *
         * @var bool
         */
        'toolbar_large_font' => false,

        /*
         * Show help system
         *
         * @var bool
         */
        'display_help_system' => true,

        /*
         * Show tooltips in the concrete5 toolbars
         *
         * @var bool
         */
        'toolbar_tooltips' => true,
    ],

    /*
     * ------------------------------------------------------------------------
     * Internationalization
     * ------------------------------------------------------------------------
     */
    'i18n' => [
        /*
         * Allow users to choose language on login
         *
         * @var bool
         */
        'choose_language_login' => false,
    ],
    'urls' => [
        'concrete5' => 'http://www.concrete5.org',
        'concrete5_secure' => 'https://www.concrete5.org',
        'newsflow' => 'http://newsflow.concrete5.org',
        'background_feed' => '//backgroundimages.concrete5.org/wallpaper',
        'background_feed_secure' => 'https://backgroundimages.concrete5.org/wallpaper',
        'background_info' => 'http://backgroundimages.concrete5.org/get_image_data.php',
        'videos' => 'https://www.youtube.com/user/concrete5cms/videos',
        'help' => [
            'developer' => 'http://documentation.concrete5.org/developers',
            'user' => 'http://documentation.concrete5.org/editors',
            'forum' => 'http://www.concrete5.org/community/forums',
        ],
        'paths' => [
            'menu_help_service' => '/tools/get_remote_help_list/',
            'site_page' => '/private/sites',
            'newsflow_slot_content' => '/tools/slot_content/',
            'marketplace' => [
                'connect' => '/marketplace/connect',
                'connect_success' => '/marketplace/connect/-/connected',
                'connect_validate' => '/marketplace/connect/-/validate',
                'connect_new_token' => '/marketplace/connect/-/generate_token',
                'checkout' => '/cart/-/add/',
                'purchases' => '/marketplace/connect/-/get_available_licenses',
                'item_information' => '/marketplace/connect/-/get_item_information',
                'item_free_license' => '/marketplace/connect/-/enable_free_license',
                'remote_item_list' => '/marketplace/',
            ],
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * White labeling.
     * ------------------------------------------------------------------------
     */
    'white_label' => [
        /*
         * Custom Logo source path relative to the public directory.
         *
         * @var bool|string The logo path
         */
        'logo' => false,

        /*
         * Custom Name
         *
         * @var bool|string The name
         */
        'name' => false,

        /*
         * Dashboard background image url
         *
         * @var null|string
         */
        'dashboard_background' => null,
    ],
    'session' => [
        'name' => 'CONCRETE5',
        'handler' => 'file',
        'save_path' => null,
        'max_lifetime' => 7200,
        'cookie' => [
            'cookie_path' => false, // set a specific path here if you know it, otherwise it'll default to relative
            'cookie_lifetime' => 0,
            'cookie_domain' => false,
            'cookie_secure' => false,
            'cookie_httponly' => true,
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * User information and registration settings.
     * ------------------------------------------------------------------------
     */
    'user' => [
        /*
         * --------------------------------------------------------------------
         * Registration settings.
         * --------------------------------------------------------------------
         */
        'registration' => [
            /*
             * Registration
             *
             * @var bool
             */
            'enabled' => false,

            /*
             * Registration type
             *
             * @var string The type (disabled|enabled|validate_email|manual_approve)
             */
            'type' => 'disabled',

            /*
             * Enable Registration Captcha
             *
             * @var bool
             */
            'captcha' => true,

            /*
             * Use emails instead of usernames to log in
             *
             * @var bool
             */
            'email_registration' => false,

            /*
             * Validate emails during registration
             *
             * @var bool
             */
            'validate_email' => false,

            /*
             * Admins approve each registration
             *
             * @var bool
             */
            'approval' => false,

            /*
             * Send notifications after successful registration.
             *
             * @var bool|string Email to notify
             */
            'notification' => false,
        ],

        /*
         * --------------------------------------------------------------------
         * Gravatar Settings
         * --------------------------------------------------------------------
         */
        'group' => [
            'badge' => [
                'default_point_value' => 50,
            ],
        ],

        'username' => [
            'maximum' => 64,
            'minimum' => 3,
            'allow_spaces' => false,
        ],
        'password' => [
            'maximum' => 128,
            'minimum' => 5,
            'hash_portable' => false,
            'hash_cost_log2' => 12,
            'legacy_salt' => '',
        ],
        'private_messages' => [
            'throttle_max' => 20,
            'throttle_max_timespan' => 15, // minutes
        ],

    ],

    /*
     * ------------------------------------------------------------------------
     * Spam
     * ------------------------------------------------------------------------
     */
    'spam' => [
        /*
         * Whitelist group ID
         *
         * @var int
         */
        'whitelist_group' => 0,

        /*
         * Notification email
         *
         * @var string
         */
        'notify_email' => '',
    ],

    /*
     * ------------------------------------------------------------------------
     * Security
     * ------------------------------------------------------------------------
     */
    'security' => [
        'session' => [
            'invalidate_on_user_agent_mismatch' => true,

            'invalidate_on_ip_mismatch' => true,
        ],
        'ban' => [
            'ip' => [
                'enabled' => true,

                /*
                 * Maximum attempts
                 */
                'attempts' => 5,

                /*
                 * Threshold time
                 */
                'time' => 300,

                /*
                 * Ban length in minutes
                 */
                'length' => 10,
            ],
        ],
        'misc' => [
            /*
             * Defence Click Jacking.
             *
             * @var bool|string DENY, SAMEORIGIN, ALLOW-FROM uri
             */
            'x_frame_options' => 'SAMEORIGIN',
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * Permissions and behaviors toggles.
     * ------------------------------------------------------------------------
     */
    'permissions' => [
        /*
         * Forward to login if access is denied
         *
         * @var bool
         */
        'forward_to_login' => true,

        /*
         * Permission model
         *
         * @var string The permission model (simple|advanced)
         */
        'model' => 'simple',
    ],

    /*
     * ------------------------------------------------------------------------
     * SEO Settings
     * ------------------------------------------------------------------------
     */
    'seo' => [
        'tracking' => [
            /*
             * User defined tracking code
             *
             * @var string
             */
            'code' => '',

            /*
             * Tracking code position
             *
             * @var string (top|bottom)
             */
            'code_position' => 'bottom',
        ],
        'exclude_words' => 'a, an, as, at, before, but, by, for, from, is, in, into, like, of, off, on, onto, per, ' .
            'since, than, the, this, that, to, up, via, with',

        /*
         * URL rewriting
         *
         * Doesn't impact concrete.seo.url_rewriting_all which is set at a lower level and
         * controls whether ALL items will be rewritten.
         *
         * @var bool
         */
        'url_rewriting' => false,
        'url_rewriting_all' => false,
        'redirect_to_canonical_url' => false,
        'canonical_url' => null,
        'canonical_ssl_url' => null,
        'trailing_slash' => false,
        'title_format' => '%2$s :: %1$s',
        'title_segment_separator' => ' :: ',
        'page_path_separator' => '-',
        'group_name_separator' => ' / ',
        'segment_max_length' => 128,
        'paging_string' => 'ccm_paging_p',
    ],

    /*
     * ------------------------------------------------------------------------
     * Statistics Settings
     * ------------------------------------------------------------------------
     */
    'statistics' => [
        'track_downloads' => true,
    ],
    'limits' => [
        'sitemap_pages' => 100,
        'delete_pages' => 100,
        'copy_pages' => 10,
        'page_search_index_batch' => 200,
        'job_queue_batch' => 10,
        'style_customizer' => [
            'size_min' => -50,
            'size_max' => 200,
        ],
    ],

    'page' => [
        'search' => [
            // Always reindex pages (usually it isn't performed when approving workflows)
            'always_reindex' => false,
        ],
    ],
];
