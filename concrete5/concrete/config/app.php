<?php

use Concrete\Core\Asset\Asset;
use Concrete\Core\File\Type\Type as FileType;

return array(

    'debug' => false,
    'namespace' => 'Application',

    /*
     * Core Aliases
     */
    'aliases' => array(
        'Area' => '\Concrete\Core\Area\Area',
        'Asset' => '\Concrete\Core\Asset\Asset',
        'AssetList' => '\Concrete\Core\Asset\AssetList',
        'AttributeSet' => '\Concrete\Core\Attribute\Set',
        'AuthenticationType' => '\Concrete\Core\Authentication\AuthenticationType',
        'Block' => '\Concrete\Core\Block\Block',
        'BlockType' => '\Concrete\Core\Block\BlockType\BlockType',
        'BlockTypeList' => '\Concrete\Core\Block\BlockType\BlockTypeList',
        'BlockTypeSet' => '\Concrete\Core\Block\BlockType\Set',
        'Cache' => '\Concrete\Core\Cache\Cache',
        'Request' => '\Concrete\Core\Http\Request',
        'CacheLocal' => '\Concrete\Core\Cache\CacheLocal',
        'Collection' => '\Concrete\Core\Page\Collection\Collection',
        'CollectionAttributeKey' => '\Concrete\Core\Attribute\Key\CollectionKey',
        'CollectionVersion' => '\Concrete\Core\Page\Collection\Version\Version',
        'ConcreteAuthenticationTypeController' => '\Concrete\Authentication\Concrete\Controller',
        'Controller' => '\Concrete\Core\Controller\Controller',
        'Conversation' => '\Concrete\Core\Conversation\Conversation',
        'ConversationEditor' => '\Concrete\Core\Conversation\Editor\Editor',
        'ConversationFlagType' => '\Concrete\Core\Conversation\FlagType\FlagType',
        'ConversationMessage' => '\Concrete\Core\Conversation\Message\Message',
        'ConversationRatingType' => '\Concrete\Core\Conversation\Rating\Type',
        'Cookie' => '\Concrete\Core\Cookie\Cookie',
        'Environment' => '\Concrete\Core\Foundation\Environment',
        'FacebookAuthenticationTypeController' => '\Concrete\Authentication\Facebook\Controller',
        'File' => '\Concrete\Core\File\File',
        'FileAttributeKey' => '\Concrete\Core\Attribute\Key\FileKey',
        'FileImporter' => '\Concrete\Core\File\Importer',
        'FileList' => '\Concrete\Core\File\FileList',
        'FilePermissions' => '\Concrete\Core\Legacy\FilePermissions',
        'FileSet' => '\Concrete\Core\File\Set\Set',
        'GlobalArea' => '\Concrete\Core\Area\GlobalArea',
        'Group' => '\Concrete\Core\User\Group\Group',
        'GroupList' => '\Concrete\Core\User\Group\GroupList',
        'GroupSet' => '\Concrete\Core\User\Group\GroupSet',
        'GroupSetList' => '\Concrete\Core\User\Group\GroupSetList',
        'GroupTree' => '\Concrete\Core\Tree\Type\Group',
        'GroupTreeNode' => '\Concrete\Core\Tree\Node\Type\Group',
        'Job' => '\Concrete\Core\Job\Job',
        'JobSet' => '\Concrete\Core\Job\Set',
        'Loader' => '\Concrete\Core\Legacy\Loader',
        'Localization' => '\Concrete\Core\Localization\Localization',
        'Marketplace' => '\Concrete\Core\Marketplace\Marketplace',
        'Package' => '\Concrete\Core\Package\Package',
        'Page' => '\Concrete\Core\Page\Page',
        'PageCache' => '\Concrete\Core\Cache\Page\PageCache',
        'PageController' => '\Concrete\Core\Page\Controller\PageController',
        'PageEditResponse' => '\Concrete\Core\Page\EditResponse',
        'PageList' => '\Concrete\Core\Page\PageList',
        'PageTemplate' => '\Concrete\Core\Page\Template',
        'PageTheme' => '\Concrete\Core\Page\Theme\Theme',
        'PageType' => '\Concrete\Core\Page\Type\Type',
        'PermissionAccess' => '\Concrete\Core\Permission\Access\Access',
        'PermissionKey' => '\Concrete\Core\Permission\Key\Key',
        'PermissionKeyCategory' => '\Concrete\Core\Permission\Category',
        'Permissions' => '\Concrete\Core\Permission\Checker',
        'Queue' => '\Concrete\Core\Foundation\Queue\Queue',
        'QueueableJob' => '\Concrete\Core\Job\QueueableJob',
        'Redirect' => '\Concrete\Core\Routing\Redirect',
        'RedirectResponse' => '\Concrete\Core\Routing\RedirectResponse',
        'Response' => '\Concrete\Core\Http\Response',
        'Router' => '\Concrete\Core\Routing\Router',
        'SinglePage' => '\Concrete\Core\Page\Single',
        'Stack' => '\Concrete\Core\Page\Stack\Stack',
        'StackList' => '\Concrete\Core\Page\Stack\StackList',
        'StartingPointPackage' => '\Concrete\Core\Package\StartingPointPackage',
        'TaskPermission' => '\Concrete\Core\Legacy\TaskPermission',
        'User' => '\Concrete\Core\User\User',
        'UserAttributeKey' => '\Concrete\Core\Attribute\Key\UserKey',
        'UserList' => '\Concrete\Core\User\UserList',
        'View' => '\Concrete\Core\View\View',
        'Workflow' => '\Concrete\Core\Workflow\Workflow',
    ),

    /*
     * Core Providers
     */
    'providers' => array(
        // Router service provider
        'core_router' => 'Concrete\Core\Routing\RoutingServiceProvider',

        'core_file' => '\Concrete\Core\File\FileServiceProvider',
        'core_encryption' => '\Concrete\Core\Encryption\EncryptionServiceProvider',
        'core_validation' => '\Concrete\Core\Validation\ValidationServiceProvider',
        'core_localization' => '\Concrete\Core\Localization\LocalizationServiceProvider',
        'core_multilingual' => '\Concrete\Core\Multilingual\MultilingualServiceProvider',
        'core_feed' => '\Concrete\Core\Feed\FeedServiceProvider',
        'core_html' => '\Concrete\Core\Html\HtmlServiceProvider',
        'core_editor' => '\Concrete\Core\Editor\EditorServiceProvider',
        'core_mail' => '\Concrete\Core\Mail\MailServiceProvider',
        'core_application' => '\Concrete\Core\Application\ApplicationServiceProvider',
        'core_utility' => '\Concrete\Core\Utility\UtilityServiceProvider',
        'core_content_importer' => '\Concrete\Core\Backup\ContentImporter\ContentImporterServiceProvider',
        'core_manager_grid_framework' => '\Concrete\Core\Page\Theme\GridFramework\ManagerServiceProvider',
        'core_manager_pagination_view' => '\Concrete\Core\Search\Pagination\View\ManagerServiceProvider',
        'core_manager_page_type' => '\Concrete\Core\Page\Type\ManagerServiceProvider',
        'core_manager_layout_preset_provider' => '\Concrete\Core\Area\Layout\Preset\Provider\ManagerServiceProvider',
        'core_manager_search_fields' => '\Concrete\Core\Search\Field\ManagerServiceProvider',
        'core_permissions' => '\Concrete\Core\Permission\PermissionServiceProvider',
        'core_database' => '\Concrete\Core\Database\DatabaseServiceProvider',
        'core_form' => '\Concrete\Core\Form\FormServiceProvider',
        'core_session' => '\Concrete\Core\Session\SessionServiceProvider',
        'core_cookie' => '\Concrete\Core\Cookie\CookieServiceProvider',
        'core_http' => '\Concrete\Core\Http\HttpServiceProvider',
        'core_events' => '\Concrete\Core\Events\EventsServiceProvider',
        'core_whoops' => '\Concrete\Core\Error\Provider\WhoopsServiceProvider',
        'core_logging' => '\Concrete\Core\Logging\LoggingServiceProvider',
        'core_notification' => '\Concrete\Core\Notification\NotificationServiceProvider',
        'core_cache' => '\Concrete\Core\Cache\CacheServiceProvider',
        'core_url' => '\Concrete\Core\Url\UrlServiceProvider',
        'core_devices' => '\Concrete\Core\Device\DeviceServiceProvider',
        'core_imageeditor' => '\Concrete\Core\ImageEditor\EditorServiceProvider',
        'core_user' => '\Concrete\Core\User\UserServiceProvider',
        'core_service_manager' => '\Concrete\Core\Service\Manager\ServiceManagerServiceProvider',
        'core_site' => '\Concrete\Core\Site\ServiceProvider',
        'core_search' => \Concrete\Core\Search\SearchServiceProvider::class,

        // Authentication
        'core_oauth' => '\Concrete\Core\Authentication\Type\OAuth\ServiceProvider',
        'core_auth_community' => '\Concrete\Core\Authentication\Type\Community\ServiceProvider',
        'core_auth_google' => '\Concrete\Core\Authentication\Type\Google\ServiceProvider',

        // Validator
        'core_validator' => '\Concrete\Core\Validator\ValidatorServiceProvider',
        'core_validator_password' => '\Concrete\Core\Validator\PasswordValidatorServiceProvider',

        // Express
        'core_attribute' => '\Concrete\Core\Attribute\AttributeServiceProvider',
        'core_express' => '\Concrete\Core\Express\ExpressServiceProvider',

        // Tracker
        'core_usagetracker' => '\Concrete\Core\Statistics\UsageTracker\ServiceProvider'
    ),

    /*
     * Core Facades
     */
    'facades' => array(
        'Core' => '\Concrete\Core\Support\Facade\Application',
        'Session' => '\Concrete\Core\Support\Facade\Session',
        'Cookie' => '\Concrete\Core\Support\Facade\Cookie',
        'Database' => '\Concrete\Core\Support\Facade\Database',
        'ORM' => '\Concrete\Core\Support\Facade\DatabaseORM',
        'Events' => '\Concrete\Core\Support\Facade\Events',
        'Express' => '\Concrete\Core\Support\Facade\Express',
        'Route' => '\Concrete\Core\Support\Facade\Route',
        'Site' => '\Concrete\Core\Support\Facade\Site',
        'UserInfo' => '\Concrete\Core\Support\Facade\UserInfo',
        'Log' => '\Concrete\Core\Support\Facade\Log',
        'Image' => '\Concrete\Core\Support\Facade\Image',
        'Config' => '\Concrete\Core\Support\Facade\Config',
        'URL' => '\Concrete\Core\Support\Facade\Url',
    ),

    'package_items' => array(
        'antispam_library',
        'attribute_key_category',
        'attribute_key',
        'attribute_set',
        'attribute_type',
        'authentication_type',
        'block_type',
        'block_type_set',
        'express_entity',
        'captcha_library',
        'content_editor_snippet',
        'conversation_rating_type',
        'group',
        'group_set',
        'job',
        'mail_importer',
        'permission_access_entity_type',
        'permission_key_category',
        'permission_key',
        'page_template',
        'site_type',
        'page_type',
        'page_type_composer_control_type',
        'page_type_publish_target_type',
        'single_page',
        'storage_location_type',
        'theme',
        'user_point_action',
        'workflow_progress_category',
        'workflow_type',
        'workflow',
    ),

    'importer_routines' => array(
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSiteTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportGroupsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSinglePageStructureRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportStacksStructureRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportBlockTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportBlockTypeSetsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportConversationEditorsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportConversationRatingTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportConversationFlagTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTypePublishTargetTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTypeComposerControlTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportBannedWordsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSocialLinksRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportTreesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportFileImportantThumbnailTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportFeaturesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportFeatureCategoriesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportGatheringDataSourcesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportGatheringItemTemplateTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportGatheringItemTemplatesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportAttributeCategoriesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportAttributeTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportWorkflowTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportWorkflowProgressCategoriesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportWorkflowsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportAttributesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportAttributeSetsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportExpressEntitiesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportExpressAssociationsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportExpressFormsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportExpressRelationsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportThemesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPermissionKeyCategoriesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPermissionAccessEntityTypesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPermissionsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportJobsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportJobSetsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTemplatesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTypesBaseRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageStructureRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageFeedsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTypeTargetsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageTypeDefaultsRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSinglePageContentRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportStacksContentRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPageContentRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportPackagesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportConfigValuesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSystemCaptchaLibrariesRoutine',
        'Concrete\Core\Backup\ContentImporter\Importer\Routine\ImportSystemContentEditorSnippetsRoutine',
    ),

    /*
     * Core Routes
     */
    'routes' => array(

        /*
         * Dialogs
         */
        "/ccm/system/dialogs/area/design/" => array('\Concrete\Controller\Dialog\Area\Design::view'),
        "/ccm/system/dialogs/area/design/reset" => array('\Concrete\Controller\Dialog\Area\Design::reset'),
        "/ccm/system/dialogs/area/design/submit" => array('\Concrete\Controller\Dialog\Area\Design::submit'),
        "/ccm/system/dialogs/area/layout/presets/manage/" => array('\Concrete\Controller\Dialog\Area\Layout\Presets\Manage::viewPresets'),
        "/ccm/system/dialogs/area/layout/presets/manage/delete" => array('\Concrete\Controller\Dialog\Area\Layout\Presets\Manage::delete'),
        "/ccm/system/dialogs/area/layout/presets/{arLayoutID}" => array('\Concrete\Controller\Dialog\Area\Layout\Presets::view'),
        "/ccm/system/dialogs/area/layout/presets/{arLayoutID}/submit" => array('\Concrete\Controller\Dialog\Area\Layout\Presets::submit'),
        "/ccm/system/dialogs/area/layout/presets/get/{cID}/{arLayoutPresetID}" => array('\Concrete\Controller\Dialog\Area\Layout\Presets::getPresetData'),

        "/ccm/system/dialogs/block/aliasing/" => array('\Concrete\Controller\Dialog\Block\Aliasing::view'),
        "/ccm/system/dialogs/block/aliasing/submit" => array('\Concrete\Controller\Dialog\Block\Aliasing::submit'),
        "/ccm/system/dialogs/block/edit/" => array('\Concrete\Controller\Dialog\Block\Edit::view'),
        "/ccm/system/dialogs/block/edit/submit/" => array('\Concrete\Controller\Dialog\Block\Edit::submit'),
        "/ccm/system/dialogs/block/cache/" => array('\Concrete\Controller\Dialog\Block\Cache::view'),
        "/ccm/system/dialogs/block/cache/submit" => array('\Concrete\Controller\Dialog\Block\Cache::submit'),
        "/ccm/system/dialogs/block/design/" => array('\Concrete\Controller\Dialog\Block\Design::view'),
        "/ccm/system/dialogs/block/design/reset" => array('\Concrete\Controller\Dialog\Block\Design::reset'),
        "/ccm/system/dialogs/block/design/submit" => array('\Concrete\Controller\Dialog\Block\Design::submit'),
        "/ccm/system/dialogs/block/permissions/detail/" => array('\Concrete\Controller\Dialog\Block\Permissions::viewDetail'),
        "/ccm/system/dialogs/block/permissions/guest_access/" => array('\Concrete\Controller\Dialog\Block\Permissions\GuestAccess::__construct'),
        "/ccm/system/dialogs/block/permissions/list/" => array('\Concrete\Controller\Dialog\Block\Permissions::viewList'),
        "/ccm/system/dialogs/block/delete/" => array('\Concrete\Controller\Dialog\Block\Delete::view'),
        "/ccm/system/dialogs/block/delete/submit/" => array('\Concrete\Controller\Dialog\Block\Delete::submit'),
        "/ccm/system/dialogs/block/delete/submit_all/" => array('\Concrete\Controller\Dialog\Block\Delete::submit_all'),

        "/ccm/system/dialogs/file/upload_complete" => array('\Concrete\Controller\Dialog\File\UploadComplete::view'),
        "/ccm/system/dialogs/file/bulk/delete" => array('\Concrete\Controller\Dialog\File\Bulk\Delete::view'),
        "/ccm/system/dialogs/file/bulk/delete/delete_files" => array('\Concrete\Controller\Dialog\File\Bulk\Delete::deleteFiles'),
        "/ccm/system/dialogs/file/bulk/properties" => array('\Concrete\Controller\Dialog\File\Bulk\Properties::view'),
        "/ccm/system/dialogs/file/bulk/sets" => array('\Concrete\Controller\Dialog\File\Bulk\Sets::view'),
        "/ccm/system/dialogs/file/bulk/sets/submit" => array('\Concrete\Controller\Dialog\File\Bulk\Sets::submit'),
        "/ccm/system/dialogs/file/bulk/properties/clear_attribute" => array('\Concrete\Controller\Dialog\File\Bulk\Properties::clearAttribute'),
        "/ccm/system/dialogs/file/bulk/properties/update_attribute" => array('\Concrete\Controller\Dialog\File\Bulk\Properties::updateAttribute'),
        "/ccm/system/dialogs/file/bulk/storage" => array('\Concrete\Controller\Dialog\File\Bulk\Storage::view'),
        "/ccm/system/dialogs/file/bulk/storage/submit" => array('\Concrete\Controller\Dialog\File\Bulk\Storage::submit'),
        "/ccm/system/dialogs/file/sets" => array('\Concrete\Controller\Dialog\File\Sets::view'),
        "/ccm/system/dialogs/file/sets/submit" => array('\Concrete\Controller\Dialog\File\Sets::submit'),
        "/ccm/system/dialogs/file/properties" => array('\Concrete\Controller\Dialog\File\Properties::view'),
        "/ccm/system/dialogs/file/advanced_search" => array('\Concrete\Controller\Dialog\File\AdvancedSearch::view'),
        "/ccm/system/dialogs/file/advanced_search/add_field" => array('\Concrete\Controller\Dialog\File\AdvancedSearch::addField'),
        "/ccm/system/dialogs/file/advanced_search/submit" => array('\Concrete\Controller\Dialog\File\AdvancedSearch::submit'),
        "/ccm/system/dialogs/file/advanced_search/save_preset" => array('\Concrete\Controller\Dialog\File\AdvancedSearch::savePreset'),
        "/ccm/system/dialogs/file/properties/clear_attribute" => array('\Concrete\Controller\Dialog\File\Properties::clear_attribute'),
        "/ccm/system/dialogs/file/properties/save" => array('\Concrete\Controller\Dialog\File\Properties::save'),
        "/ccm/system/dialogs/file/properties/update_attribute" => array('\Concrete\Controller\Dialog\File\Properties::update_attribute'),
        "/ccm/system/dialogs/file/search" => array('\Concrete\Controller\Dialog\File\Search::view'),
        "/ccm/system/dialogs/file/thumbnails" => array('\Concrete\Controller\Dialog\File\Thumbnails::view'),
        "/ccm/system/dialogs/file/thumbnails/edit" => array('\Concrete\Controller\Dialog\File\Thumbnails\Edit::view'),
        "/ccm/system/dialogs/file/usage/{fID}" => array('\Concrete\Controller\Dialog\File\Usage::view'),

        "/ccm/system/dialogs/group/search" => array('\Concrete\Controller\Dialog\Group\Search::view'),

        "/ccm/system/dialogs/page/add" => array('\Concrete\Controller\Dialog\Page\Add::view'),
        "/ccm/system/dialogs/page/add_block" => array('\Concrete\Controller\Dialog\Page\AddBlock::view'),
        "/ccm/system/dialogs/page/add_block/submit" => array('\Concrete\Controller\Dialog\Page\AddBlock::submit'),
        "/ccm/system/dialogs/page/add_block_list" => array('\Concrete\Controller\Dialog\Page\AddBlockList::view'),
        "/ccm/system/dialogs/page/add_external" => array('\Concrete\Controller\Dialog\Page\AddExternal::view'),
        "/ccm/system/dialogs/page/add_external/submit" => array('\Concrete\Controller\Dialog\Page\AddExternal::submit'),
        "/ccm/system/dialogs/page/add/compose/{ptID}/{cParentID}" => array('\Concrete\Controller\Dialog\Page\Add\Compose::view'),
        "/ccm/system/dialogs/page/add/compose/submit" => array('\Concrete\Controller\Dialog\Page\Add\Compose::submit'),
        "/ccm/system/dialogs/page/attributes" => array('\Concrete\Controller\Dialog\Page\Attributes::view'),
        "/ccm/system/dialogs/page/bulk/properties" => array('\Concrete\Controller\Dialog\Page\Bulk\Properties::view'),
        "/ccm/system/dialogs/page/bulk/properties/clear_attribute" => array('\Concrete\Controller\Dialog\Page\Bulk\Properties::clearAttribute'),
        "/ccm/system/dialogs/page/bulk/properties/update_attribute" => array('\Concrete\Controller\Dialog\Page\Bulk\Properties::updateAttribute'),
        "/ccm/system/dialogs/page/clipboard" => array('\Concrete\Controller\Dialog\Page\Clipboard::view'),
        "/ccm/system/dialogs/page/delete" => array('\Concrete\Controller\Dialog\Page\Delete::view'),
        "/ccm/system/dialogs/page/delete/submit" => array('\Concrete\Controller\Dialog\Page\Delete::submit'),
        "/ccm/system/dialogs/page/delete_alias" => array('\Concrete\Controller\Dialog\Page\DeleteAlias::view'),
        "/ccm/system/dialogs/page/delete_alias/submit" => array('\Concrete\Controller\Dialog\Page\DeleteAlias::submit'),
        "/ccm/system/dialogs/page/delete_from_sitemap" => array('\Concrete\Controller\Dialog\Page\Delete::viewFromSitemap'),
        "/ccm/system/dialogs/page/design" => array('\Concrete\Controller\Dialog\Page\Design::view'),
        "/ccm/system/dialogs/page/design/submit" => array('\Concrete\Controller\Dialog\Page\Design::submit'),
        "/ccm/system/dialogs/page/design/css" => array('\Concrete\Controller\Dialog\Page\Design\Css::view'),
        "/ccm/system/dialogs/page/design/css/submit" => array('\Concrete\Controller\Dialog\Page\Design\Css::submit'),
        "/ccm/system/dialogs/page/edit_external" => array('\Concrete\Controller\Dialog\Page\EditExternal::view'),
        "/ccm/system/dialogs/page/edit_external/submit" => array('\Concrete\Controller\Dialog\Page\EditExternal::submit'),
        "/ccm/system/dialogs/page/location" => array('\Concrete\Controller\Dialog\Page\Location::view'),
        "/ccm/system/dialogs/page/search" => array('\Concrete\Controller\Dialog\Page\Search::view'),
        "/ccm/system/dialogs/page/search/customize" => array('\Concrete\Controller\Dialog\Page\Search\Customize::view'),
        "/ccm/system/dialogs/page/search/customize/submit" => array('\Concrete\Controller\Dialog\Page\Search\Customize::submit'),
        "/ccm/system/dialogs/page/seo" => array('\Concrete\Controller\Dialog\Page\Seo::view'),

        "/ccm/system/dialogs/page/advanced_search" => array('\Concrete\Controller\Dialog\Page\AdvancedSearch::view'),
        "/ccm/system/dialogs/page/advanced_search/add_field" => array('\Concrete\Controller\Dialog\Page\AdvancedSearch::addField'),
        "/ccm/system/dialogs/page/advanced_search/submit" => array('\Concrete\Controller\Dialog\Page\AdvancedSearch::submit'),
        "/ccm/system/dialogs/page/advanced_search/save_preset" => array('\Concrete\Controller\Dialog\Page\AdvancedSearch::savePreset'),

        "/ccm/system/dialogs/user/bulk/properties" => array('\Concrete\Controller\Dialog\User\Bulk\Properties::view'),
        "/ccm/system/dialogs/user/bulk/properties/clear_attribute" => array('\Concrete\Controller\Dialog\User\Bulk\Properties::clearAttribute'),
        "/ccm/system/dialogs/user/bulk/properties/update_attribute" => array('\Concrete\Controller\Dialog\User\Bulk\Properties::updateAttribute'),
        "/ccm/system/dialogs/user/search" => array('\Concrete\Controller\Dialog\User\Search::view'),
        "/ccm/system/dialogs/user/search/customize" => array('\Concrete\Controller\Dialog\User\Search\Customize::view'),
        "/ccm/system/dialogs/user/search/customize/submit" => array('\Concrete\Controller\Dialog\User\Search\Customize::submit'),

        "/ccm/system/dialogs/user/advanced_search" => array('\Concrete\Controller\Dialog\User\AdvancedSearch::view'),
        "/ccm/system/dialogs/user/advanced_search/add_field" => array('\Concrete\Controller\Dialog\User\AdvancedSearch::addField'),
        "/ccm/system/dialogs/user/advanced_search/submit" => array('\Concrete\Controller\Dialog\User\AdvancedSearch::submit'),
        "/ccm/system/dialogs/user/advanced_search/save_preset" => array('\Concrete\Controller\Dialog\User\AdvancedSearch::savePreset'),

        /*
         * Conversations
         */
        "/ccm/system/dialogs/conversation/subscribe/{cnvID}" => array('\Concrete\Controller\Dialog\Conversation\Subscribe::view'),
        "/ccm/system/dialogs/conversation/subscribe/subscribe/{cnvID}" => array('\Concrete\Controller\Dialog\Conversation\Subscribe::subscribe'),
        "/ccm/system/dialogs/conversation/subscribe/unsubscribe/{cnvID}" => array('\Concrete\Controller\Dialog\Conversation\Subscribe::unsubscribe'),

        /*
         * Help
         */
        "/ccm/system/dialogs/help/introduction/" => array('\Concrete\Controller\Dialog\Help\Introduction::view'),

        /*
         * Files
         */
        "/ccm/system/file/approve_version" => array('\Concrete\Controller\Backend\File::approveVersion'),
        "/ccm/system/file/delete_version" => array('\Concrete\Controller\Backend\File::deleteVersion'),
        "/ccm/system/file/duplicate" => array('\Concrete\Controller\Backend\File::duplicate'),
        "/ccm/system/file/get_json" => array('\Concrete\Controller\Backend\File::getJSON'),
        "/ccm/system/file/rescan" => array('\Concrete\Controller\Backend\File::rescan'),
        "/ccm/system/file/rescan_multiple" => array('\Concrete\Controller\Backend\File::rescanMultiple'),
        "/ccm/system/file/star" => array('\Concrete\Controller\Backend\File::star'),
        "/ccm/system/file/upload" => array('\Concrete\Controller\Backend\File::upload'),
        "/ccm/system/file/folder/add" => array('\Concrete\Controller\Backend\File\Folder::add'),
        "/ccm/system/file/folder/contents" => array('\Concrete\Controller\Search\FileFolder::submit'),

        /*
         * Users
         */
        "/ccm/system/user/add_group" => array('\Concrete\Controller\Backend\User::addGroup'),
        "/ccm/system/user/remove_group" => array('\Concrete\Controller\Backend\User::removeGroup'),
        "/ccm/system/user/get_json" => array('\Concrete\Controller\Backend\User::getJSON'),

        /*
         * Page actions - non UI
         */
        "/ccm/system/page/arrange_blocks/" => array('\Concrete\Controller\Backend\Page\ArrangeBlocks::arrange'),
        "/ccm/system/page/check_in/{cID}/{token}" => array('\Concrete\Controller\Backend\Page::exitEditMode'),
        "/ccm/system/page/create/{ptID}" => array('\Concrete\Controller\Backend\Page::create'),
        "/ccm/system/page/create/{ptID}/{parentID}" => array('\Concrete\Controller\Backend\Page::create'),
        "/ccm/system/page/get_json" => array('\Concrete\Controller\Backend\Page::getJSON'),
        "/ccm/system/page/multilingual/assign" => array('\Concrete\Controller\Backend\Page\Multilingual::assign'),
        "/ccm/system/page/multilingual/create_new" => array('\Concrete\Controller\Backend\Page\Multilingual::create_new'),
        "/ccm/system/page/multilingual/ignore" => array('\Concrete\Controller\Backend\Page\Multilingual::ignore'),
        "/ccm/system/page/multilingual/unmap" => array('\Concrete\Controller\Backend\Page\Multilingual::unmap'),
        "/ccm/system/page/select_sitemap" => array('\Concrete\Controller\Backend\Page\SitemapSelector::view'),

        /*
         * Block actions - non UI
         */
        "/ccm/system/block/render/" => array('\Concrete\Controller\Backend\Block::render'),
        "/ccm/system/block/action/add/{cID}/{arHandle}/{btID}/{action}" => array('\Concrete\Controller\Backend\Block\Action::add'),
        "/ccm/system/block/action/edit/{cID}/{arHandle}/{bID}/{action}" => array('\Concrete\Controller\Backend\Block\Action::edit'),
        "/ccm/system/block/action/add_composer/{ptComposerFormLayoutSetControlID}/{action}" => array('\Concrete\Controller\Backend\Block\Action::add_composer'),
        "/ccm/system/block/action/edit_composer/{cID}/{arHandle}/{ptComposerFormLayoutSetControlID}/{action}" => array('\Concrete\Controller\Backend\Block\Action::edit_composer'),

        /*
         * Misc
         */
        "/ccm/system/css/layout/{arLayoutID}" => array('\Concrete\Controller\Frontend\Stylesheet::layout'),
        "/ccm/system/css/page/{cID}/{stylesheet}/{cvID}" => array('\Concrete\Controller\Frontend\Stylesheet::page_version'),
        "/ccm/system/css/page/{cID}/{stylesheet}" => array('\Concrete\Controller\Frontend\Stylesheet::page'),
        "/ccm/system/backend/editor_data/" => array('\Concrete\Controller\Backend\EditorData::view'),
        "/ccm/system/backend/get_remote_help/" => array('\Concrete\Controller\Backend\GetRemoteHelp::view'),
        "/ccm/system/backend/intelligent_search/" => array('\Concrete\Controller\Backend\IntelligentSearch::view'),
        "/ccm/system/jobs" => array('\Concrete\Controller\Frontend\Jobs::view'),
        "/ccm/system/jobs/run_single" => array('\Concrete\Controller\Frontend\Jobs::run_single'),
        "/ccm/system/jobs/check_queue" => array('\Concrete\Controller\Frontend\Jobs::check_queue'),
        // @TODO remove the line below
        "/tools/required/jobs" => array('\Concrete\Controller\Frontend\Jobs::view'),
        "/tools/required/jobs/check_queue" => array('\Concrete\Controller\Frontend\Jobs::check_queue'),
        "/tools/required/jobs/run_single" => array('\Concrete\Controller\Frontend\Jobs::run_single'),
        // end removing lines
        "/ccm/system/upgrade/" => array('\Concrete\Controller\Upgrade::view'),
        "/ccm/system/upgrade/submit" => array('\Concrete\Controller\Upgrade::submit'),

        /*
         * Notification
         */
        "/ccm/system/notification/alert/archive/" => array('\Concrete\Controller\Backend\Notification\Alert::archive'),

        /*
         * General Attribute
         */
        "/ccm/system/attribute/action/{action}" => array(
            '\Concrete\Controller\Backend\Attribute\Action::dispatch',
            'attribute_action',
            array('action' => ".+"),
        ),

        /*
         * Trees
         */
        "/ccm/system/tree/load" => array('\Concrete\Controller\Backend\Tree::load'),
        "/ccm/system/tree/node/load" => array('\Concrete\Controller\Backend\Tree\Node::load'),
        "/ccm/system/tree/node/load_starting" => array('\Concrete\Controller\Backend\Tree\Node::load_starting'),
        "/ccm/system/tree/node/drag_request" => array('\Concrete\Controller\Backend\Tree\Node\DragRequest::execute'),
        "/ccm/system/tree/node/duplicate" => array('\Concrete\Controller\Backend\Tree\Node\Duplicate::execute'),

        "/ccm/system/dialogs/tree/node/add/category" => array('\Concrete\Controller\Dialog\Tree\Node\Category\Add::view'),
        "/ccm/system/dialogs/tree/node/add/category/add_category_node" => array('\Concrete\Controller\Dialog\Tree\Node\Category\Add::add_category_node'),

        "/ccm/system/dialogs/tree/node/add/topic" => array('\Concrete\Controller\Dialog\Tree\Node\Topic\Add::view'),
        "/ccm/system/dialogs/tree/node/add/topic/add_topic_node" => array('\Concrete\Controller\Dialog\Tree\Node\Topic\Add::add_topic_node'),

        "/ccm/system/dialogs/tree/node/edit/topic" => array('\Concrete\Controller\Dialog\Tree\Node\Topic\Edit::view'),
        "/ccm/system/dialogs/tree/node/edit/topic/update_topic_node" => array('\Concrete\Controller\Dialog\Tree\Node\Topic\Edit::update_topic_node'),

        "/ccm/system/dialogs/tree/node/edit/category" => array('\Concrete\Controller\Dialog\Tree\Node\Category\Edit::view'),
        "/ccm/system/dialogs/tree/node/edit/category/update_category_node" => array('\Concrete\Controller\Dialog\Tree\Node\Category\Edit::update_category_node'),

        "/ccm/system/dialogs/tree/node/delete" => array('\Concrete\Controller\Dialog\Tree\Node\Delete::view'),
        "/ccm/system/dialogs/tree/node/delete/remove_tree_node" => array('\Concrete\Controller\Dialog\Tree\Node\Delete::remove_tree_node'),
        "/ccm/system/dialogs/tree/node/permissions" => array('\Concrete\Controller\Dialog\Tree\Node\Permissions::view'),

        /*
         * Marketplace
         */
        "/ccm/system/dialogs/marketplace/checkout" => array('\Concrete\Controller\Dialog\Marketplace\Checkout::view'),
        "/ccm/system/dialogs/marketplace/download" => array('\Concrete\Controller\Dialog\Marketplace\Download::view'),
        "/ccm/system/marketplace/connect" => array('\Concrete\Controller\Backend\Marketplace\Connect::view'),
        "/ccm/system/marketplace/search" => array('\Concrete\Controller\Backend\Marketplace\Search::view'),

        /*
         * Express
         */
        "/ccm/system/dialogs/express/entry/search" => array('\Concrete\Controller\Dialog\Express\Search::entries'),
        "/ccm/system/search/express/entries/submit/{entityID}" => array('\Concrete\Controller\Search\Express\Entries::submit'),
        "/ccm/system/express/entry/get_json" => array('\Concrete\Controller\Backend\Express\Entry::getJSON'),

        /*
         * Search Routes
         */
        "/ccm/system/search/files/basic" => array('\Concrete\Controller\Search\Files::searchBasic'),
        "/ccm/system/search/files/current" => array('\Concrete\Controller\Search\Files::searchCurrent'),
        "/ccm/system/search/files/preset/{presetID}" => array('\Concrete\Controller\Search\Files::searchPreset'),
        "/ccm/system/search/files/clear" => array('\Concrete\Controller\Search\Files::clearSearch'),
        "/ccm/system/search/pages/basic" => array('\Concrete\Controller\Search\Pages::searchBasic'),
        "/ccm/system/search/pages/current" => array('\Concrete\Controller\Search\Pages::searchCurrent'),
        "/ccm/system/search/pages/preset/{presetID}" => array('\Concrete\Controller\Search\Pages::searchPreset'),
        "/ccm/system/search/pages/clear" => array('\Concrete\Controller\Search\Pages::clearSearch'),


        "/ccm/system/search/users/basic" => array('\Concrete\Controller\Search\Users::searchBasic'),
        "/ccm/system/search/users/current" => array('\Concrete\Controller\Search\Users::searchCurrent'),
        "/ccm/system/search/users/preset/{presetID}" => array('\Concrete\Controller\Search\Users::searchPreset'),
        "/ccm/system/search/users/clear" => array('\Concrete\Controller\Search\Users::clearSearch'),


        "/ccm/system/search/groups/submit" => array('\Concrete\Controller\Search\Groups::submit'),

        /*
         * Panels - top level
         */
        "/ccm/system/panels/add" => array('\Concrete\Controller\Panel\Add::view'),
        "/ccm/system/panels/dashboard" => array('\Concrete\Controller\Panel\Dashboard::view'),
        "/ccm/system/panels/dashboard/add_favorite" => array('\Concrete\Controller\Panel\Dashboard::addFavorite'),
        "/ccm/system/panels/dashboard/remove_favorite" => array('\Concrete\Controller\Panel\Dashboard::removeFavorite'),
        "/ccm/system/panels/page/relations" => array('\Concrete\Controller\Panel\PageRelations::view'),
        "/ccm/system/panels/page" => array('\Concrete\Controller\Panel\Page::view'),
        "/ccm/system/panels/page/attributes" => array('\Concrete\Controller\Panel\Page\Attributes::view'),
        "/ccm/system/panels/page/check_in" => array('\Concrete\Controller\Panel\Page\CheckIn::__construct'),
        "/ccm/system/panels/page/check_in/submit" => array('\Concrete\Controller\Panel\Page\CheckIn::submit'),
        "/ccm/system/panels/page/design" => array('\Concrete\Controller\Panel\Page\Design::view'),
        "/ccm/system/panels/page/design/customize/reset_page_customizations" => array('\Concrete\Controller\Panel\Page\Design\Customize::reset_page_customizations'),
        "/ccm/system/panels/page/design/customize/apply_to_page/{pThemeID}" => array('\Concrete\Controller\Panel\Page\Design\Customize::apply_to_page'),
        "/ccm/system/panels/page/design/customize/apply_to_site/{pThemeID}" => array('\Concrete\Controller\Panel\Page\Design\Customize::apply_to_site'),
        "/ccm/system/panels/page/design/customize/preview/{pThemeID}" => array('\Concrete\Controller\Panel\Page\Design\Customize::preview'),
        "/ccm/system/panels/page/design/customize/reset_site_customizations/{pThemeID}" => array('\Concrete\Controller\Panel\Page\Design\Customize::reset_site_customizations'),
        "/ccm/system/panels/page/design/customize/{pThemeID}" => array('\Concrete\Controller\Panel\Page\Design\Customize::view'),
        "/ccm/system/panels/page/design/preview_contents" => array('\Concrete\Controller\Panel\Page\Design::preview_contents'),
        "/ccm/system/panels/page/design/submit" => array('\Concrete\Controller\Panel\Page\Design::submit'),
        "/ccm/system/panels/page/preview_as_user" => array('\Concrete\Controller\Panel\Page\PreviewAsUser::view'),
        "/ccm/system/panels/page/preview_as_user/preview" => array('\Concrete\Controller\Panel\Page\PreviewAsUser::frame_page'),
        "/ccm/system/panels/page/preview_as_user/render" => array('\Concrete\Controller\Panel\Page\PreviewAsUser::preview_page'),
        "/ccm/system/panels/page/versions" => array('\Concrete\Controller\Panel\Page\Versions::view'),
        "/ccm/system/panels/page/versions/get_json" => array('\Concrete\Controller\Panel\Page\Versions::get_json'),
        "/ccm/system/panels/page/versions/duplicate" => array('\Concrete\Controller\Panel\Page\Versions::duplicate'),
        "/ccm/system/panels/page/versions/new_page" => array('\Concrete\Controller\Panel\Page\Versions::new_page'),
        "/ccm/system/panels/page/versions/delete" => array('\Concrete\Controller\Panel\Page\Versions::delete'),
        "/ccm/system/panels/page/versions/approve" => array('\Concrete\Controller\Panel\Page\Versions::approve'),
        "/ccm/system/panels/page/devices" => array('\Concrete\Controller\Panel\Page\Devices::view'),
        "/ccm/system/panels/page/devices/preview" => array('\Concrete\Controller\Panel\Page\Devices::preview'),
        "/ccm/system/panels/sitemap" => array('\Concrete\Controller\Panel\Sitemap::view'),

        /*
         * Panel Details
         */
        "/ccm/system/panels/details/page/attributes" => array('\Concrete\Controller\Panel\Detail\Page\Attributes::view'),
        "/ccm/system/panels/details/page/attributes/add_attribute" => array('\Concrete\Controller\Panel\Detail\Page\Attributes::add_attribute'),
        "/ccm/system/panels/details/page/attributes/submit" => array('\Concrete\Controller\Panel\Detail\Page\Attributes::submit'),
        "/ccm/system/panels/details/page/caching" => array('\Concrete\Controller\Panel\Detail\Page\Caching::view'),
        "/ccm/system/panels/details/page/caching/purge" => array('\Concrete\Controller\Panel\Detail\Page\Caching::purge'),
        "/ccm/system/panels/details/page/caching/submit" => array('\Concrete\Controller\Panel\Detail\Page\Caching::submit'),
        "/ccm/system/panels/details/page/composer" => array('\Concrete\Controller\Panel\Detail\Page\Composer::view'),
        "/ccm/system/panels/details/page/composer/autosave" => array('\Concrete\Controller\Panel\Detail\Page\Composer::autosave'),
        "/ccm/system/panels/details/page/composer/discard" => array('\Concrete\Controller\Panel\Detail\Page\Composer::discard'),
        "/ccm/system/panels/details/page/composer/publish" => array('\Concrete\Controller\Panel\Detail\Page\Composer::publish'),
        "/ccm/system/panels/details/page/composer/save_and_exit" => array('\Concrete\Controller\Panel\Detail\Page\Composer::saveAndExit'),
        "/ccm/system/panels/details/page/location" => array('\Concrete\Controller\Panel\Detail\Page\Location::view'),
        "/ccm/system/panels/details/page/location/submit" => array('\Concrete\Controller\Panel\Detail\Page\Location::submit'),
        "/ccm/system/panels/details/page/permissions" => array('\Concrete\Controller\Panel\Detail\Page\Permissions::view'),
        "/ccm/system/panels/details/page/permissions/save_simple" => array('\Concrete\Controller\Panel\Detail\Page\Permissions::save_simple'),
        "/ccm/system/panels/details/page/preview" => array('\Concrete\Controller\Panel\Page\Design::preview'),
        "/ccm/system/panels/details/page/seo" => array('\Concrete\Controller\Panel\Detail\Page\Seo::view'),
        "/ccm/system/panels/details/page/seo/submit" => array('\Concrete\Controller\Panel\Detail\Page\Seo::submit'),
        "/ccm/system/panels/details/page/versions" => array('\Concrete\Controller\Panel\Detail\Page\Versions::view'),
        "/ccm/system/panels/details/page/devices" => array('\Concrete\Controller\Panel\Page\Devices::detail'),

        /*
         * RSS Feeds
         */
        "/rss/{identifier}" => array(
            '\Concrete\Controller\Feed::output',
            'rss',
            array('identifier' => '[A-Za-z0-9_/.]+'),
        ),

        /*
         * Special Dashboard
         */
        "/dashboard/blocks/stacks/list" => array('\Concrete\Controller\SinglePage\Dashboard\Blocks\Stacks::list_page'),

        /*
         * Assets localization
         */
        '/ccm/assets/localization/core/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getCoreJavascript'),
        '/ccm/assets/localization/select2/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getSelect2Javascript'),
        '/ccm/assets/localization/redactor/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getRedactorJavascript'),
        '/ccm/assets/localization/fancytree/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getFancytreeJavascript'),
        '/ccm/assets/localization/imageeditor/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getImageEditorJavascript'),
        '/ccm/assets/localization/jquery/ui/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getJQueryUIJavascript'),
        '/ccm/assets/localization/translator/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getTranslatorJavascript'),
        '/ccm/assets/localization/dropzone/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getDropzoneJavascript'),
        '/ccm/assets/localization/conversations/js' => array('\Concrete\Controller\Frontend\AssetsLocalization::getConversationsJavascript'),
    ),

    /*
     * Route themes
     */
    'theme_paths' => array(
        '/dashboard' => 'dashboard',
        '/dashboard/*' => 'dashboard',
        '/account' => VIEW_CORE_THEME,
        '/account/*' => VIEW_CORE_THEME,
        '/install' => VIEW_CORE_THEME,
        '/login' => array(
            VIEW_CORE_THEME,
            VIEW_CORE_THEME_TEMPLATE_BACKGROUND_IMAGE,
        ),
        '/register'         => VIEW_CORE_THEME,
        '/frontend/maintenance_mode' => VIEW_CORE_THEME,
        '/upgrade'          => VIEW_CORE_THEME
    ),

    /*
     * File Types
     */
    'file_types' => array(
        'JPEG' => array('jpg,jpeg,jpe', FileType::T_IMAGE, 'image', 'image', 'image'),
        'GIF' => array('gif', FileType::T_IMAGE, 'image', 'image', 'image'),
        'PNG' => array('png', FileType::T_IMAGE, 'image', 'image', 'image'),
        'Windows Bitmap' => array('bmp', FileType::T_IMAGE, 'image'),
        'TIFF' => array('tif,tiff', FileType::T_IMAGE, 'image'),
        'HTML' => array('htm,html', FileType::T_IMAGE),
        'Flash' => array('swf', FileType::T_IMAGE, 'image'),
        'Icon' => array('ico', FileType::T_IMAGE),
        'SVG' => array('svg', FileType::T_IMAGE),
        'Windows Video' => array('asf,wmv', FileType::T_VIDEO, false, 'video'),
        'Quicktime' => array('mov,qt', FileType::T_VIDEO, false, 'video'),
        'AVI' => array('avi', FileType::T_VIDEO, false, 'video'),
        '3GP' => array('3gp', FileType::T_VIDEO, false, 'video'),
        'Plain Text' => array('txt', FileType::T_TEXT, false, 'text'),
        'CSV' => array('csv', FileType::T_TEXT, false, 'text'),
        'XML' => array('xml', FileType::T_TEXT),
        'PHP' => array('php', FileType::T_TEXT),
        'MS Word' => array('doc,docx', FileType::T_DOCUMENT),
        'Stylesheet' => array('css', FileType::T_TEXT),
        'MP4' => array('mp4', FileType::T_VIDEO),
        'FLV' => array('flv', FileType::T_VIDEO, 'flv'),
        'MP3' => array('mp3', FileType::T_AUDIO, false, 'audio'),
        'MP4 Audio' => array('m4a', FileType::T_AUDIO, false, 'audio'),
        'Realaudio' => array('ra,ram', FileType::T_AUDIO),
        'Windows Audio' => array('wma', FileType::T_AUDIO),
        'Rich Text' => array('rtf', FileType::T_DOCUMENT),
        'JavaScript' => array('js', FileType::T_TEXT),
        'PDF' => array('pdf', FileType::T_DOCUMENT),
        'Photoshop' => array('psd', FileType::T_IMAGE),
        'MPEG' => array('mpeg,mpg', FileType::T_VIDEO),
        'MS Excel' => array('xla,xls,xlsx,xlt,xlw', FileType::T_DOCUMENT),
        'MS Powerpoint' => array('pps,ppt,pptx,pot', FileType::T_DOCUMENT),
        'TAR Archive' => array('tar', FileType::T_APPLICATION),
        'Zip Archive' => array('zip', FileType::T_APPLICATION),
        'GZip Archive' => array('gz,gzip', FileType::T_APPLICATION),
        'OGG' => array('ogg', FileType::T_AUDIO),
        'OGG Video' => array('ogv', FileType::T_VIDEO),
        'WebM' => array('webm', FileType::T_VIDEO),
    ),

    /*
     * Importer Attributes
     */
    'importer_attributes' => array(
        'width' => array('Width', 'NUMBER', false),
        'height' => array('Height', 'NUMBER', false),
        'duration' => array('Duration', 'NUMBER', false),
    ),

    /*
     * Assets
     */
    'assets' => array(

        'google-charts' => array(
            array(
                'javascript',
                'https://www.gstatic.com/charts/loader.js',
                array('local' => false),
            ),
        ),

        'jquery' => array(
            array(
                'javascript',
                'js/jquery.js',
                array('position' => Asset::ASSET_POSITION_HEADER, 'minify' => false, 'combine' => false),
            ),
        ),
        'jquery/ui' => array(
            array('javascript', 'js/jquery-ui.js', array('minify' => false, 'combine' => false)),
            array('javascript-localized', '/ccm/assets/localization/jquery/ui/js'),
            array('css', 'css/jquery-ui.css', array('minify' => false)),
        ),
        'jquery/visualize' => array(
            array('javascript', 'js/jquery-visualize.js', array('minify' => false, 'combine' => false)),
            array('css', 'css/jquery-visualize.css', array('minify' => false)),
        ),
        'jquery/touch-punch' => array(
            array('javascript', 'js/jquery-ui-touch-punch.js'),
        ),
        'jquery/tristate' => array(
            array('javascript', 'js/jquery-tristate.js'),
        ),
        'select2' => array(
            array('javascript', 'js/select2.js', array('minify' => false, 'combine' => false)),
            array('javascript-localized', '/ccm/assets/localization/select2/js'),
            array('css', 'css/select2.css', array('minify' => false)),
        ),
        'selectize' => array(
            array('javascript', 'js/selectize.js', array('minify' => false, 'combine' => false)),
            array('css', 'css/selectize.css', array('minify' => false)),
        ),
        'underscore' => array(
            array('javascript', 'js/underscore.js', array('minify' => false)),
        ),
        'backbone' => array(
            array('javascript', 'js/backbone.js', array('minify' => false)),
        ),
        'dropzone' => array(
            array('javascript', 'js/dropzone.js'),
            array('javascript-localized', '/ccm/assets/localization/dropzone/js'),
            array('css', 'css/dropzone.css', array('minify' => false)),
        ),
        'jquery/form' => array(
            array('javascript', 'js/jquery-form.js'),
        ),
        'picturefill' => array(
            array('javascript', 'js/picturefill.js', array('minify' => false)),
        ),
        'responsive-slides' => array(
            array('javascript', 'js/responsive-slides.js', array('minify' => false)),
            array('css', 'css/responsive-slides.css', array('minify' => false)),
        ),
        'html5-shiv' => array(
            array('javascript-conditional', 'js/ie/html5-shiv.js',
                array('conditional' => 'lt IE 9'),
            ),
        ),
        'respond' => array(
            array('javascript-conditional', 'js/ie/respond.js',
                array('conditional' => 'lt IE 9'),
            ),
        ),
        'spectrum' => array(
            array('javascript', 'js/spectrum.js', array('minify' => false)),
            array('css', 'css/spectrum.css', array('minify' => false)),
        ),
        'core/composer-save-coordinator' => array(
            array('javascript', 'js/composer-save-coordinator.js', array('minify' => false)),
        ),
        'font-awesome' => array(
            array('css', 'css/font-awesome.css', array('minify' => false)),
        ),
        'core/events' => array(
            array('javascript', 'js/events.js', array('minify' => false)),
        ),
        'core/style-customizer' => array(
            array('javascript', 'js/style-customizer.js', array('minify' => false)),
            array('css', 'css/style-customizer.css', array('minify' => false)),
        ),
        'core/localization' => array(
            array('javascript-localized', '/ccm/assets/localization/core/js'),
        ),
        'core/frontend/parallax-image' => array(
            array('javascript', 'js/frontend/parallax-image.js', array('minify' => false)),
        ),
        'core/imageeditor/control/position' => array(
            array('css', 'css/image-editor/controls/position.css'),
            array('javascript', 'js/image-editor/controls/position.js'),
        ),
        'core/imageeditor/control/filter' => array(
            array('css', 'css/image-editor/controls/filter.css'),
            array('javascript', 'js/image-editor/controls/filter.js'),
        ),
        'core/imageeditor/filter/gaussian_blur' => array(
            array('css', 'css/image-editor/filters/gaussian_blur.css'),
            array('javascript', 'js/image-editor/filters/gaussian_blur.js'),
        ),
        'core/imageeditor/filter/none' => array(
            array('css', 'css/image-editor/filters/none.css'),
            array('javascript', 'js/image-editor/filters/none.js'),
        ),
        'core/imageeditor/filter/sepia' => array(
            array('css', 'css/image-editor/filters/sepia.css'),
            array('javascript', 'js/image-editor/filters/sepia.js'),
        ),
        'core/imageeditor/filter/vignette' => array(
            array('css', 'css/image-editor/filters/vignette.css'),
            array('javascript', 'js/image-editor/filters/vignette.js'),
        ),
        'core/imageeditor/filter/grayscale' => array(
            array('css', 'css/image-editor/filters/grayscale.css'),
            array('javascript', 'js/image-editor/filters/grayscale.js'),
        ),
        'jquery/awesome-rating' => array(
            array('javascript', 'js/jquery-awesome-rating.js', array('minify' => false)),
            array('css', 'css/jquery-awesome-rating.css', array('minify' => false)),
        ),
        'jquery/fileupload' => array(
            array('javascript', 'js/jquery-fileupload.js'),
        ),
        'jquery/textcounter' => array(
            array('javascript', 'js/textcounter.js'),
        ),
        'swfobject' => array(
            array('javascript', 'js/swfobject.js'),
        ),
        'redactor' => array(
            array('javascript', 'js/redactor.js', array('minify' => false)),
            array('javascript-localized', '/ccm/assets/localization/redactor/js'),
            array('css', 'css/redactor.css'),
        ),
        'ace' => array(
            array('javascript', 'js/ace/ace.js', array('minify' => false)),
        ),
        'backstretch' => array(
            array('javascript', 'js/backstretch.js'),
        ),
        'background-check' => array(
            array('javascript', 'js/background-check.js'),
        ),
        /*
        'dynatree' => array(
            array('javascript', 'js/dynatree.js', array('minify' => false)),
            array('javascript-localized', '/ccm/assets/localization/dynatree/js', array('minify' => false)),
            array('css', 'css/dynatree.css', array('minify' => false)),
        ),
        */
        'fancytree' => array(
            array('javascript', 'js/fancytree.js', array('minify' => false, 'version' => '2.18.0')),
            array('javascript-localized', '/ccm/assets/localization/fancytree/js', array('minify' => false)),
            array('css', 'css/fancytree.css', array('minify' => false)),
        ),
        'bootstrap/dropdown' => array(
            array('javascript', 'js/bootstrap/dropdown.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/tooltip' => array(
            array('javascript', 'js/bootstrap/tooltip.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/popover' => array(
            array('javascript', 'js/bootstrap/popover.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/collapse' => array(
            array('javascript', 'js/bootstrap/collapse.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/alert' => array(
            array('javascript', 'js/bootstrap/alert.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/button' => array(
            array('javascript', 'js/bootstrap/button.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap/transition' => array(
            array('javascript', 'js/bootstrap/transition.js'),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap' => array(
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'core/app' => array(
            array('javascript', 'js/app.js', array('minify' => false, 'combine' => false)),
            array('css', 'css/app.css', array('minify' => false)),
        ),
        'bootstrap-editable' => array(
            array('javascript', 'js/bootstrap-editable.js', array('minify' => false)),
        ),
        'core/app/editable-fields' => array(
            array('css', 'css/editable-fields.css', array('minify' => false)),
        ),
        'kinetic' => array(
            array('javascript', 'js/kinetic.js'),
        ),
        'core/imageeditor' => array(
            array('javascript', 'js/image-editor.js'),
            array('javascript-localized', '/ccm/assets/localization/imageeditor/js'),
            array('css', 'css/image-editor.css'),
        ),
        'dashboard' => array(
            array('javascript', 'js/dashboard.js'),
        ),
        'core/frontend/captcha' => array(
            array('css', 'css/frontend/captcha.css'),
        ),
        'core/frontend/pagination' => array(
            array('css', 'css/frontend/pagination.css'),
        ),
        'core/frontend/errors' => array(
            array('css', 'css/frontend/errors.css'),
        ),
        'core/file-manager' => array(
            array('javascript', 'js/file-manager.js', array('minify' => false)),
            array('css', 'css/file-manager.css', array('minify' => false)),
        ),
        'core/express' => array(
            array('javascript', 'js/express.js', array('minify' => false)),
        ),
        'core/sitemap' => array(
            array('javascript', 'js/sitemap.js', array('minify' => false)),
            array('css', 'css/sitemap.css', array('minify' => false)),
        ),
        'core/users' => array(
            array('javascript', 'js/users.js', array('minify' => false)),
        ),
        'core/notification' => array(
            array('javascript', 'js/notification.js', array('minify' => false)),
        ),
        'core/tree' => array(
            array('javascript', 'js/tree.js', array('minify' => false)),
        ),
        'core/groups' => array(
            array('javascript', 'js/groups.js', array('minify' => false)),
        ),
        'core/gathering' => array(
            array('javascript', 'js/gathering.js'),
        ),
        'core/gathering/display' => array(
            array('css', 'css/gathering/display.css'),
        ),
        'core/gathering/base' => array(
            array('css', 'css/gathering/base.css'),
        ),
        'core/conversation' => array(
            array('javascript', 'js/conversations.js'),
            array('javascript-localized', '/ccm/assets/localization/conversations/js'),
            array('css', 'css/conversations.css'),
        ),
        'core/lightbox' => array(
            array('javascript', 'js/jquery-magnific-popup.js'),
            array('css', 'css/jquery-magnific-popup.css'),
        ),
        'core/lightbox/launcher' => array(
            array('javascript', 'js/lightbox.js'),
        ),
        'core/account' => array(
            array('javascript', 'js/account.js'),
            array('css', 'css/account.css'),
        ),
        'core/translator' => array(
            array('javascript', 'js/translator.js', array('minify' => false)),
            array('javascript-localized', '/ccm/assets/localization/translator/js'),
            array('css', 'css/translator.css', array('minify' => false)),
        ),
    ),
    'asset_groups' => array(

        'jquery/ui' => array(
            array(
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('css', 'jquery/ui'),
            ),
        ),
        'jquery/visualize' => array(
            array(
                array('javascript', 'jquery/visualize'),
                array('css', 'jquery/visualize'),
            ),
        ),
        /**
         * @deprecated
         */
        'select2' => array(
            array(
                array('javascript', 'select2'),
                array('javascript-localized', 'select2'),
                array('css', 'select2'),
            ),
        ),
        'selectize' => array(
            array(
                array('javascript', 'selectize'),
                array('css', 'selectize'),
            ),
        ),
        'dropzone' => array(
            array(
                array('javascript', 'dropzone'),
                array('javascript-localized', 'dropzone'),
                array('css', 'dropzone'),
            ),
        ),
        'responsive-slides' => array(
            array(
                array('javascript', 'responsive-slides'),
                array('css', 'responsive-slides'),
            ),
        ),
        'ace' => array(
            array(
                array('javascript', 'ace'),
            ),
        ),
        'core/notification' => array(
            array(
                array('javascript', 'core/notification'),
            ),
        ),
        'core/colorpicker' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'core/events'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'spectrum'),
                array('css', 'spectrum'),
            ),
        ),
        'font-awesome' => array(
            array(
                array('css', 'font-awesome'),
            ),
        ),
        'core/rating' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'jquery/awesome-rating'),
                array('css', 'font-awesome'),
                array('css', 'jquery/awesome-rating'),
            ),
        ),
        'core/style-customizer' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'core/colorpicker'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('javascript', 'jquery/fileupload'),
                array('javascript', 'core/file-manager'),
                array('javascript', 'core/style-customizer'),
                array('css', 'core/app'),
                array('css', 'core/file-manager'),
                array('css', 'jquery/ui'),
                array('css', 'core/colorpicker'),
                array('css', 'core/style-customizer'),
            ),
        ),
        'jquery/fileupload' => array(
            array(
                array('javascript', 'jquery/fileupload'),
            ),
        ),
        'swfobject' => array(
            array(
                array('javascript', 'swfobject'),
            ),
        ),
        'redactor' => array(
            array(
                array('javascript', 'redactor'),
                array('javascript-localized', 'redactor'),
                array('css', 'redactor'),
                array('css', 'font-awesome'),
            ),
        ),
        'fancytree' => array(
            array(
                array('javascript', 'fancytree'),
                array('javascript-localized', 'fancytree'),
                array('css', 'fancytree'),
            ),
        ),
        'core/app' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'bootstrap/dropdown'),
                array('javascript', 'bootstrap/tooltip'),
                array('javascript', 'bootstrap/popover'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('css', 'core/app'),
                array('css', 'font-awesome'),
                array('css', 'jquery/ui'),
            ),
        ),
        'core/app/editable-fields' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'bootstrap/dropdown'),
                array('javascript', 'bootstrap/tooltip'),
                array('javascript', 'bootstrap/popover'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('javascript', 'bootstrap-editable'),
                array('css', 'core/app/editable-fields'),
                array('javascript', 'jquery/fileupload'),
            ),
        ),
        'core/imageeditor' => array(
            array(
                array('javascript', 'kinetic'),
                array('javascript-localized', 'core/imageeditor'),
                array('javascript', 'core/imageeditor'),
                array('css', 'core/imageeditor'),
            ),
        ),
        'dashboard' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'jquery/touch-punch'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'dashboard'),
                array('javascript', 'core/events'),
                array('javascript', 'bootstrap/dropdown'),
                array('javascript', 'bootstrap/tooltip'),
                array('javascript', 'bootstrap/collapse'),
                array('javascript', 'bootstrap/popover'),
                array('javascript', 'bootstrap/transition'),
                array('javascript', 'bootstrap/alert'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('javascript', 'redactor'),
                array('javascript-localized', 'redactor'),
                array('javascript-conditional', 'respond'),
                array('javascript-conditional', 'html5-shiv'),
                array('css', 'core/app'),
                array('css', 'redactor'),
                array('css', 'jquery/ui'),
                array('css', 'font-awesome'),
            ),
        ),
        'core/file-manager' => array(
            array(
                array('css', 'core/app'),
                array('css', 'jquery/ui'),
                array('css', 'core/file-manager'),
                array('css', 'selectize'),
                array('javascript', 'core/events'),
                array('javascript', 'bootstrap/tooltip'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'selectize'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('javascript', 'jquery/fileupload'),
                array('javascript', 'core/tree'),
                array('javascript', 'core/file-manager'),
            ),
        ),
        'core/sitemap' => array(
            array(
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'fancytree'),
                array('javascript', 'selectize'),
                array('javascript-localized', 'fancytree'),
                array('javascript-localized', 'core/localization'),
                array('javascript', 'core/app'),
                array('javascript', 'core/sitemap'),
                array('css', 'fancytree'),
                array('css', 'selectize'),
                array('css', 'core/sitemap'),
            ),
        ),
        'core/users' => array(
            array(
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'core/users'),
            ),
        ),
        'core/express' => array(
            array(
                array('javascript', 'underscore'),
                array('javascript', 'backbone'),
                array('javascript', 'core/events'),
                array('javascript', 'bootstrap/tooltip'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'core/localization'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'core/app'),
                array('javascript', 'core/express'),
                array('css', 'core/app'),
                array('css', 'core/express'),
            ),
        ),
        'core/topics' => array(
            array(
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'fancytree'),
                array('javascript-localized', 'fancytree'),
                array('javascript', 'core/tree'),
                array('css', 'fancytree'),
            ),
        ),
        'core/tree' => array(
            array(
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'fancytree'),
                array('javascript-localized', 'fancytree'),
                array('javascript', 'core/tree'),
                array('css', 'fancytree'),
            ),
        ),
        'core/groups' => array(
            array(
                array('javascript', 'core/events'),
                array('javascript', 'underscore'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'fancytree'),
                array('javascript-localized', 'fancytree'),
                array('javascript', 'core/tree'),
                array('css', 'fancytree'),
            ),
        ),
        'core/gathering' => array(
            array(
                array('javascript', 'core/gathering'),
                array('javascript', 'redactor'),
                array('javascript-localized', 'redactor'),
                array('css', 'core/gathering/base'),
                array('css', 'core/conversation'),
                array('css', 'core/gathering/display'),
                array('css', 'redactor'),
            ),
        ),
        'core/conversation' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'jquery/ui'),
                array('javascript-localized', 'jquery/ui'),
                array('javascript', 'underscore'),
                array('javascript', 'core/lightbox'),
                array('javascript', 'dropzone'),
                array('javascript-localized', 'dropzone'),
                array('javascript', 'bootstrap/dropdown'),
                array('javascript', 'core/events'),
                array('javascript', 'core/conversation'),
                array('javascript-localized', 'core/conversation'),
                array('css', 'core/conversation'),
                array('css', 'core/frontend/errors'),
                array('css', 'font-awesome'),
                array('css', 'bootstrap/dropdown'),
                array('css', 'core/lightbox'),
                array('css', 'jquery/ui'),
            ),
            true,
        ),
        'core/lightbox' => array(
            array(
                array('javascript', 'jquery'),
                array('javascript', 'core/lightbox'),
                array('javascript', 'core/lightbox/launcher'),
                array('css', 'core/lightbox'),
            ),
        ),
        'core/account' => array(
            array(
                array('javascript', 'core/account'),
                array('javascript', 'bootstrap/dropdown'),
                array('css', 'bootstrap/dropdown'),
                array('css', 'core/account'),
            ),
        ),
        'core/translator' => array(
            array(
                array('javascript', 'core/translator'),
                array('javascript-localized', 'core/translator'),
                array('css', 'core/translator'),
            ),
        ),
        /* @deprecated keeping this around because certain themes reference it and we don't want to break them. */
        'core/legacy' => array(
            array(
            ),
        ),
    ),
    'curl' => array(
        'verifyPeer' => true,
        'connectionTimeout' => 5,
    ),

    // HTTP middleware for processing http requests
    'middleware' => [
        [
            'priority' => 1,
            'class' => \Concrete\Core\Http\Middleware\ApplicationMiddleware::class
        ],
        'core_cookie' => \Concrete\Core\Http\Middleware\CookieMiddleware::class,
        'core_xframeoptions' => \Concrete\Core\Http\Middleware\FrameOptionsMiddleware::class,
        'core_thumbnails' => \Concrete\Core\Http\Middleware\ThumbnailMiddleware::class
    ]
);
