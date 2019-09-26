 <?php

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

    'prefix'    => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Admin panel logo
    |--------------------------------------------------------------------------
    |
    | Want to use your own image as a logo in the admin panel? Just define a path 
    | to the image bellow. If null the default logo image will be used.
    |
    */

    'custom_logo_url'  => null,

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
    |
    */

    'languages' => [
        'en'    => 'English',
        'bg'    => 'Bulgarian',
    ],

    /*
    |--------------------------------------------------------------------------
    | Page groups
    |--------------------------------------------------------------------------
    |
    | Also called page key. You can use this to group your info pages.
    | For example you might want to create a submenu somewhere in your website,
    | like for a FAQ. You can then search for the related info page by key.
    |
    */

    'page_groups' => [
        'default' => 'default group / uncategorised',
    ],

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
    | == ICONS
    |   You can use font awesome icons or nucleo icons. 
    |   Either "ni ni-{icon_name}" or "fa fa-{icon_name}"
    |   Check these urls:
    |   https://fontawesome.com/icons?d=gallery&m=free
    |   https://demos.creative-tim.com/argon-dashboard/docs/foundation/icons.html
    |
    | == VIEWS
    |  The menu item will have a class of "active" whenever one of the given views are loaded.
    |
    | == HORIZONTAL LINE
    |   If 'hr' is true a horizontal line (divider) will be added after the menu item.
    |
    */

    'nav' => [

        'dashboard' => [
            'name'      => 'hotcoffee::admin.dashboard', 
            'route'     => 'hotcoffee.admin.dashboard',
            'views'     => ['hotcoffee::admin.dashboard'],
            'icon'      => 'ni ni-tv-2',
            'hr'        => false,
        ],

        'infopages' => [
            'name'      => 'hotcoffee::admin.infopages', 
            'route'     => 'hotcoffee.admin.infopages.index',
            'views'     => ['hotcoffee::admin.infopages', 'hotcoffee::admin.infopage'],
            'icon'      => 'ni ni-collection',
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

        // 'test' => [ // Custom export case
        //     'name'      => 'custom',
        //     'type'      => 'custom',
        //     'case'      => 'custom',
        //     'fields'    => ['id', 'name', 'email'],
        //     'file_name' => 'custom',
        //     'file_type' => 'xls',
        // ],

    ],
];