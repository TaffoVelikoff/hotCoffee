<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in the admin zone
    |
    | . Root
    | 1. Login
    | 2. Top Nav
    | 3. Navigation
    | 4. User roles
    | 0. Deleting and errors
    |
    */

    //===== Root
    'ok'                    => 'OK',
    'error'                 => 'Error',
    'success'               => 'Success',
    'edit'                  => 'Edit',
    'delete'                => 'Delete',
    'add'                   => 'Add',
    'update'                => 'Update',
    'quick_add'             => 'Quick Add',
    'title'                 => 'Title',
    'description'           => 'Description',
    'content'               => 'Content',
    'create'                => 'Create',
    'short_sweet'           => 'Something short and sweet',
    'save'                  => 'Save',
    'cancel'                => 'Cancel',
    'rotate'                => 'Rotate',
    'cache_cleared'         => 'System cache was cleared.',
    'pass'                  => 'Password',
    'rep_pass'              => 'Repeat Password',
    'email'                 => 'E-mail',
    'emails'                => 'E-mails',
    'admin'                 => 'Admin',
    'admin_area'            => 'Admin Area',
    'developed_by'          => 'Developed by',
    'key'                   => 'Key',
    'custom_url'            => 'Custom Url',
    'from'                  => 'from',
    'keyword'               => 'Keyword',
    'attach_images'         => 'Attach Images',
    'choose_files'          => 'Choose Files',
    'choose_files_nfo'      => 'File size should be less than 2MB.',
    'choose_files_nfo_2'    => 'Recommended image dimensions 1500x1500.',
    'choose_files_nfo_3'    => 'Allowed extentions: jpg, jpeg, png, gif, svg',
    'upload_one_more'       => 'Upload one or more files',
    'user_access'           => 'User access',
    'user_access_nfo'       => 'Do not select any roles if you want the page to be public to everyone (including not logged in users). Admins always have access to all pages.',
    'user_access_only'      => 'Only for users with roles:',
    'meta_desc'             => 'Meta description',
    'meta_desc_nfo'         => ' This is used when the page appears on social media & search engines. You can leave empty. The system will populate the "description" meta tag automatically, using the provided text in the content field.',
    'none'                  => 'NONE',
    'comma_sep'             => 'Comma seperated.',
    'see_all'               => 'see all',
    'view'                  => 'View',
    'pages'                 => 'Pages',
    'date'                  => 'Date',
    'name'                  => 'name',
    'time'                  => 'time',
    'no_nfo_yet'            => 'Nothing to show yet ...',
    'version'               => 'Version',
    'no_keyword'            => 'Please enter a term to search for.',
    'upload_images'         => 'Upload images',

    //===== Color
    'default'               => 'Default',
    'red'                   => 'Red',
    'orange'                => 'Orange',
    'black'                 => 'Black',
    'gray'                  => 'Gray',
    'blue'                  => 'Blue',
    'green'                 => 'Green',

    //===== Login
    'oops'                  => 'Oops!',
    'err_credentials'       => 'Login failed. Please check your credentials again.',
    'err_attempts'          => 'Too many login attempts! Please, wait for a while before you try again.',
    'welcome_msg'           => 'Hey! Welcome back to the :app_name admin panel.',
    'remember_me'           => 'Remember me',

    //===== Top Nav
    'welcome'               => 'Welcome',
    'my_profile'            => 'My Profile',
    'logout'                => 'Logout',
    'search'                => 'Search',
    'users'                 => 'Users',
    'settings'              => 'Settings',
    'clear_cache'           => 'Flush Cache',
    'xls_export'            => 'Export',
    'user_roles'            => 'Roles',

    //===== Navigation
    'dashboard'             => 'Dashboard',
    'infopages'             => 'Info Pages',
    'menus'                 => 'Menus',
    'filemanager'           => 'File Manager',

    //===== Dashboard
    'registered_users'      => 'Registered users',
    'registered_users_nfo'  => 'Total number of users',
    'latest_user'           => 'Latest user',
    'latest_user_nfo'       => 'Latest registered user',
    'login_log'             => 'Admin login history',
    'clear_history'         => 'Clear history',
    'clear_auth_sure'       => 'Are you sure you want to delete the whole login history?',
    'clear_auth_done'       => 'The auth history was succesfully deleted.',
    'timezone_nfo'          => 'Can be changed on the settings page.',

    //===== Menus
    'menus'                 => 'Menus',
    'menu'                  => 'Menu',
    'menu_create_suc'       => 'The menu was succesfully created.',
    'menu_update_suc'       => 'The menu was succesfully updated.',
    'menu_items'            => 'Menu items',

    //===== Menu Items
    'menu_item'             => 'Menu item',
    'menu_item_name_holder' => 'Element title',
    'url'                   => 'URL',
    'or_page'               => 'or link to a page',
    'new_window'            => 'open in new window',
    'icon_code'             => 'Icon code',
    'store_order'           => 'Always click the SAVE button to store the order of the menu items.',
    'example'               => 'Example',
    'url_nfo_1'             => 'Enter a full url, starting with "http://" or "https://" to link to an external website.',
    'url_nfo_2'             => 'This will create a link to any part of your website.',
    'url_nfo_3'             => 'For single page websites you can enter the name of the section (starting with "#") to scroll down to it.',
    'url_nfo_4'             => 'Leave empty if you don\'t want to link to anything and just use it for a title for a submenu.',
    'url_nfo_5'             => 'If you want to link to an external info page you can chose it from the drop down menu. In this case any URL entered in the field above will be ignored by the system.',
    'menu_create'           => 'Create a menu',
    'menu_edit'             => 'Edit menu',

    //===== Info Pages
    'infopage'              => 'Info Page',
    'page_nfo'              => 'Page Content',
    'content'               => 'Content',
    'page_group'            => 'Page Key (Group)',
    'nfo_page_group'        => 'You can add new page groups (keys) in config/app.php.',
    'page_create_suc'       => 'The info page was succesfully created.',
    'page_update_suc'       => 'The info page was succesfully updated.',
    'page_content_nfo'      => '',
    'page_roles_only'       => 'Only logged in users with these roles have access',
    'page_roles_all'        => 'All users have access to this page.',
    'sef_nfo'               => 'At least 3 charecters long. Valid symbols: 0-9, A-Z, a-z, _, -',
    'page_create'           => 'Create a new page',
    'page_edit'             => 'Edit info page',

    //===== Articles
    'articles'              => 'Articles',
    'tags'                  => 'Tags',
    'article_create_suc'    => 'The article was created successfully.',
    'article_update_suc'    => 'The article was updated succesfully.',
    'with_tag'              => 'with tag',
    'article_create'        => 'Create a new article',
    'article_edit'          => 'Edit article',

    //===== Users
    'user_create'           => 'Add a new user',
    'user_edit'             => 'Edit user',
    'user_create_suc'       => 'The user was succesfully created.',
    'user_update_suc'       => 'The user was succesfully updated.',
    'user_bio'              => 'A few words about the user ...',
    'user_about'            => 'About',
    'user_contact_info'     => 'Contact Information',
    'user_info'             => 'User information',
    'user_mail'             => 'E-mail address',
    'user_name'             => 'User name',
    'user_company'          => 'Company / organization',
    'user_org_job'          => 'Company & Job title',
    'user_job'              => 'Job Title',
    'user_fname'            => 'First name',
    'user_lname'            => 'Last name',
    'user_city'             => 'City',
    'user_country'          => 'Country',
    'user_role'             => 'Role',
    'user_language'         => 'User language',


    //===== User roles
    'role'                  => 'Role',
    'create_role'           => 'Create a new role',
    'role_edit'             => 'Edit role',
    'role_info'             => 'Role information',
    'role_root'             => 'You can not edit the admin role!',

    //===== File Manager
    'fm_images'                => 'images',
    'fm_files'                 => 'other files',

    //===== Settings
    'main_mail'             => 'Main e-mail',
    'nfo_main_mail'         => 'Your visitors will be able to contact you on this address.',
    'support_mail'          => 'Support mail',
    'contact_info'          => 'Contact Info',
    'seo_options'           => 'SEO Options',
    'website_name'          => 'Website name',
    'website_description'   => 'Website description',
    'nfo_website_desc'      => 'Will only be displayed if a page does not have it\'s own description.',
    'other_settings'        => 'Other Settings',
    'items_per_page'        => 'Items per page',
    'date_format'           => 'Date format',
    'nfo_date_format'       => 'Should be a valid date format string. For more details visit <a href="https://www.php.net/manual/en/datetime.formats.date.php" target="_blank">https://www.php.net/manual/en/datetime.formats.date.php</a>.',
    'timezone'              => 'Timezone',
    'header_color'          => 'Header color',

    //===== Export
    'export_what'           => 'What do you want to export?',
    'select_one'            => 'select one',

    //===== Icons
    'icons_made_by'         => 'Icons made by',
    'is_licensed_by'        => 'is licensed by',


    //===== Deleting & errors
    'suc_added'             => 'The item was succesfully created.',
    'suc_updated'           => 'The item was successfully updated.',
    'suc_deleted'           => 'The item was deleted succesfully.',
    'suc_settings_saved'    => 'Settings were saved succesfully.',
    'err_not_exist'         => 'Item does not exist.',
    'err_root_del'          => 'Root item can not be deleted.',
    'att_deleted'           => 'Attachment was removed successfully.',
    'att_del'               => 'Are you sure you want to delete this attachment?',
    'err_role'              => 'Select a role for the user.',
    'err_select_export'     => 'Please select something to export.',
    'req_att'               => 'Your attention is required',
    'are_you_sure'          => 'Are you sure about that?',
    'these_changes'         => 'These changes can not be restored.',
    'err_access_denied'     => 'Access denied.',

    'err_title_required'    => 'The title field for one of the languages (:lang) is required.',
    'err_content_required'  => 'The content field for one of the languages (:lang) is required.',
    'err_title_max'         => 'The title for one of the languages (:lang) is too long.',
    'err_content_max'       => 'The content for one of the languages (:lang) is long.',
    'err_title_min'         => 'The title for one of the languages (:lang) is too short.',
    'err_must_be_image'     => 'Trying to upload an invalid image file.',
    'err_image_upload'      => 'Problem with uploading one of the images. Check "upload_max_filesize" in your PHP settings.',
    'err_sef_req'           => 'The custom url is required.',
    'err_sef_min'           => 'Custom url should be at least 3 charecters long.',
    'err_sef_max'           => 'Custom url should be no more than 64 charecters long.',
    'err_sef_spaces'        => 'You can\'t have any empty spaces in the custom url link',
    'err_sef_alpha_dash'    => 'Some of the charecters in the custom url are invalid.',

    'err_keyword_required'  => 'The keyword is requried.',
    'err_keyword_min'       => 'Keyword should be at least 3 charecters long.',
    'err_keyword_max'       => 'Keyword is too long.',
    'err_keyword_spaces'    => 'Keyword should not contain any white spaces.',
    'err_keyword_unique'    => 'The keyword should be unique.',
    'err_title_menu_req'    => 'Title field is required.',
    'err_title_menu_req_lng'=> 'Title field for all languages is requried.',
    
];
