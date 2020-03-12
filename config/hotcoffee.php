 <?php

/**
 | hotCoffee package configuration
 | You can find related documentation on https://taffo.gitbook.io/hotcoffee
 |
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Admin panel prefix
    |--------------------------------------------------------------------------
    |
    | You can define the url prefix for the admin zone
    | https://yourapp.com/{prefix}
    |
    */

    'prefix'    => env('ADMIN_PREFIX', '/admin'),

    /*
    |--------------------------------------------------------------------------
    | Admin panel logo
    |--------------------------------------------------------------------------
    |
    | Want to use your own logo in the admin panel? Just define a path 
    | to the image bellow. If null the default logo image will be used.
    |
    */

    'custom_logo_url'  => null,

    /*
    |--------------------------------------------------------------------------
    | Starting Route
    |--------------------------------------------------------------------------
    |
    | The name of the default route where the admin users are redirected to when 
    | they login.
    |
    */

    'start_route'   => 'hotcoffee.admin.dashboard',

    /*
    |--------------------------------------------------------------------------
    | Additional CSS
    |--------------------------------------------------------------------------
    | You can add custom stylesheets that will be included in the hotCoffee admin panel. 
    | This way you can even create a whole new theme by adding your own custom stylesheet.
    | The resources should be placed in the "public" folder.
    |
    */

    'additional_css' => [
        //'css/admin/custom.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional JS
    |--------------------------------------------------------------------------
    | You can add custom JS files that will be included in the hotCoffee admin panel.
    |
    */

    'additional_js' => [
        //'js/admin/custom.js',
    ],


    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    |
    | Define all the languages your app is going to use:
    | 'acronym' => 'fullname',
    | hotCoffee will automatically create translatable fields in the admin panel
    | for each language. If you don't need multiple language support leave only the
    | locale your app is going to use. Read more on how to create your own translatable
    | models and translatable fields for the admin panel pages in the documentation.
    | The first language in the array is going to be the default one.
    |
    */

    'languages' => [
        'en'    => 'English',
        'bg'    => 'Български [Bulgarian]',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Zone Languages
    |--------------------------------------------------------------------------
    |
    | At this time hotCoffee comes with English and Bulgarian translations for 
    | it's admin zone interface. You can comment out the ones you don't need
    | from the array bellow. The first language in the array is going to be the 
    | default one.
    |
    */

    'admin_languages' => [
        'en'    => 'English',
        'bg'    => 'Български [Bulgarian]'
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth history
    |--------------------------------------------------------------------------
    |
    | Keep track of admin user logins.
    |
    | auth_log - True for enabled and False to disable
    | auth_log_count - How many recent logs to display in dashboard
    |
    */

    'auth_log'          => true,
    'auth_log_count'    => 10,

    /*
    |--------------------------------------------------------------------------
    | Admin panel navigation
    |--------------------------------------------------------------------------
    | == NAME:
    |   The name can either be a string, or a key of a translation string.
    |   'name' => 'file.key' or 'name' => 'Simple String'
    |
    | == ROUTE:
    |   For route use only route names.
    |
    | == PARAMS:
    |   Any additional parameters to the route name.
    |
    | == ICONS:
    |   You can use font awesome icons or nucleo icons. 
    |   Either "ni ni-{icon_name}" or "fa fa-{icon_name}"
    |   Check these urls:
    |   https://fontawesome.com/icons?d=gallery&m=free
    |   https://demos.creative-tim.com/argon-dashboard/docs/foundation/icons.html
    |
    | == VIEWS:
    |  The menu item will have a class of "active" whenever one of the given views are loaded.
    |
    | == HORIZONTAL LINE:
    |   If 'hr' is true a horizontal line (divider) will be added after the menu item.
    |
    | == COLOR:
    | Color for the icon. Example:
    | 'color'   => 'yellow'
    |
    */

    'nav' => [

        'dashboard' => [
            'name'      => 'hotcoffee::admin.dashboard', 
            'route'     => 'hotcoffee.admin.dashboard',
            'views'     => ['admin.dashboard'],
            'icon'      => 'ni ni-tv-2'
        ],

        'menus' => [
            'name'      => 'hotcoffee::admin.menus', 
            'route'     => 'hotcoffee.admin.menus.index',
            'views'     => ['hotcoffee::admin.menus', 'hotcoffee::admin.menu'],
            'icon'      => 'ni ni-bullet-list-67',
            'hr'        => false,
        ],

        'articles' => [
            'name'      => 'hotcoffee::admin.articles', 
            'route'     => 'hotcoffee.admin.articles.index',
            'views'     => ['hotcoffee::admin.articles', 'hotcoffee::admin.article'],
            'icon'      => 'ni ni-single-copy-04',
            'hr'        => false,
        ],

        'infopages' => [
            'name'      => 'hotcoffee::admin.infopages', 
            'route'     => 'hotcoffee.admin.infopages.index',
            'views'     => ['hotcoffee::admin.infopages', 'hotcoffee::admin.infopage'],
            'icon'      => 'ni ni-collection',
            'hr'        => false
        ],

        'filemanager' => [
            'name'      => 'hotcoffee::admin.filemanager', 
            'route'     => 'hotcoffee.admin.filemanager',
            'views'     => ['hotcoffee::admin.filemanager'],
            'icon'      => 'ni ni-folder-17',
            'hr'        => true,
        ],

        'users' => [
            'name'      => 'hotcoffee::admin.users',
            'route'     => 'hotcoffee.admin.users.index',
            'views'     => ['hotcoffee::admin.user', 'hotcoffee::admin.users'],
            'icon'      => 'ni ni-single-02',
        ],

        'roles' => [
            'name'      => 'hotcoffee::admin.user_roles',
            'route'     => 'hotcoffee.admin.roles.index',
            'views'     => ['hotcoffee::admin.role', 'hotcoffee::admin.roles'],
            'icon'      => 'ni ni-badge',
            'hr'        => true,
        ],

        'settings'  => [
            'name'      => 'hotcoffee::admin.settings',
            'route'     => 'hotcoffee.admin.settings.index',
            'views'     => ['hotcoffee::admin.settings'],
            'icon'      => 'ni ni-settings-gear-65',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Secondary menu
    |--------------------------------------------------------------------------
    | == NAME:
    |   The name can either be a string, or a key of a translation string.
    |   'name' => 'file.key' or 'name' => 'Simple String'
    |
    | == ROUTE:
    |   For route use only route names.
    |
    | == DIVIDER
    |   If 'divider' is true a horizontal line (divider) will be added after the menu item.
    |
    */

    'secondary_menu' => [
        
        'users' => [
            'name'      => 'hotcoffee::admin.users',
            'route'     => 'hotcoffee.admin.users.index',
        ],

        'roles' => [
            'name'      => 'hotcoffee::admin.user_roles',
            'route'     => 'hotcoffee.admin.roles.index',
        ],

        'settings' => [
            'name'      => 'hotcoffee::admin.settings',
            'route'     => 'hotcoffee.admin.settings.index',
            'divider'   => true
        ],

        'export' => [
            'name'      => 'hotcoffee::admin.xls_export',
            'route'     => 'hotcoffee.admin.export.index',
            'divider'   => true
        ],

        'flush' => [
            'name'      => 'hotcoffee::admin.clear_cache',
            'route'     => 'hotcoffee.admin.flush'
        ],

    ],

    'secondary_menu_icon'   => 'ni ni-settings-gear-65',

    /*
    |--------------------------------------------------------------------------
    | Visible UI parts
    |--------------------------------------------------------------------------
    |
    */

    'ui_search_bar'     => true,
    'ui_secondary_menu' => true,
    'ui_user_dropdown'  => true,

    /*
    |--------------------------------------------------------------------------
    | Tinymce Options
    |--------------------------------------------------------------------------
    | Below you can setup the tinymce integration (WYSIWYG editor for pages and articles).
    |
    */
    'tinymce_plugins' => 'textcolor preview importcss fullscreen image link media codesample table charmap hr insertdatetime advlist lists imagetools textpattern noneditable charmap',
    'tinymce_context' => 'link image imagetools table spellchecker',
    'tinymce_toolbar' => 'undo redo | alignleft aligncenter alignright alignjustify | bold italic underline strikethrough | outdent indent | fontselect fontsizeselect formatselect |  numlist bullist | forecolor backcolor | charmap | image media link codesample insertdatetime fullscreen',
    'tinymce_file_manager'  => true,

    /*
    |--------------------------------------------------------------------------
    | Disabled controllers
    |--------------------------------------------------------------------------
    | Some times you might want to disable access to some controllers if you don't plan
    | to use them or if you don't want your client to have access to sensitive settings and
    | some more advanced features (like adding or editing user roles). It's also recommended
    | that you remove any links to the disabled controllers from the navigation.
    |
    */

    'disabled_controllers' => [
        // 'TaffoVelikoff\HotCoffee\Http\Controllers\Admin\RoleController',
        // 'TaffoVelikoff\HotCoffee\Http\Controllers\Admin\FlushController'
    ],

    /*
    |--------------------------------------------------------------------------
    | Searchable models
    |--------------------------------------------------------------------------
    | These models will be included on the search page
    |
    | == LABEL:
    |   The label of the tab in results.
    |
    | == FIELDS:
    |   The database fields to search.
    |
    | == INDEX:
    |   Model properties to show in the results table.
    |
    | == ROUTE:
    |   The name of the route where admins will be redirected to when clicking 
    |   the "VIEW" button.
    |
    */

    'searchables' => [
        'users' => [
            'label'     => 'hotcoffee::admin.users',
            'fields'    => ['name', 'email'],
            'index'     => ['id', 'name', 'email'],
            'route'     => 'hotcoffee.admin.users.edit'
        ],
        'info_pages'    => [
            'label'     => 'hotcoffee::admin.pages',
            'fields'    => ['title', 'content'],
            'index'     => ['id', 'title'],
            'route'     => 'hotcoffee.admin.infopages.edit'
        ],
        'articles'  => [
            'label'     => 'hotcoffee::admin.articles',
            'fields'    => ['title', 'content'],
            'index'     => ['id', 'title'],
            'route'     => 'hotcoffee.admin.articles.edit'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Exportable models
    |--------------------------------------------------------------------------
    | These models will be included on the export page
    |
    */

    'exportables' => [

        'App\User' => [ // Model export
            'name'      => 'hotcoffee::admin.users',
            'type'      => 'model',
            'fields'    => ['name', 'email', 'created_at'],
            'file_name' => 'user_list',
            'file_type' => 'xls',
        ], 

        'emails' => [ // User e-mails
            'name'      => 'hotcoffee::admin.emails',
            'type'      => 'emails',
            'fields'    => ['email'],
            'file_name' => 'user_emails',
            'file_type' => 'csv',
        ],

        'test' => [ // Custom export case
            'name'      => 'custom',
            'type'      => 'custom',
            'case'      => 'custom',
            'fields'    => ['id', 'name', 'email'],
            'file_name' => 'custom',
            'file_type' => 'xls',
        ],

    ],

];