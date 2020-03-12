<?php

/*
|--------------------------------------------------------------------------
| Settings Page
|--------------------------------------------------------------------------
| You can easily edit the settings page sections and fields below.
|
*/

return [

    'fields'  => [

        // Contact info section
        'hotcoffee::admin.contact_info'  => [

            // Contact e-mail field
            [
                'name'          => 'mail',
                'label'         => 'hotcoffee::admin.main_mail',
                'field_type'    => 'text',
                'icon'          => 'ni ni-email-83',
                'info_text'     => 'hotcoffee::admin.nfo_main_mail',
                'required'      => true,
                'content'       => null,
            ],

        ],

        'Section name / header text' => [ // Text for the header
            [
                'name'          => 'my_setting', // the value of this setting will be called with settings('my_setting')
                'label'         => 'My Setting', // the lable for the field
                'field_type'    => 'radio', // the type of the field. Here 'text' will generate <input type="text" /> field in the front-end
                'icon'          => 'ni ni-email-83', // icon code for the field
                'info_text'     => 'This is my new setting.', // this text will appear bellow the field. Use it to explain where/how the setting is used
                'required'      => true, // true will add required attribute to the generated field
                'content'       => [
                    [
                        'value'    => 'asd',
                        'label'     => 'label'
                    ]
                ] // this can be used when adding a "select" type field. Content can be 
            ]
        ],

        // SEO options section
        'hotcoffee::admin.seo_options'  => [

            // Website name field
            [
                'name'          => 'website_name',
                'label'         => 'hotcoffee::admin.website_name',
                'field_type'    => 'text',
                'icon'          => 'ni ni-bold',
                'info_text'     => null,
                'required'      => true,
                'content'       => null,
            ],

            // Website description field
            [
                'name'          => 'website_description',
                'label'         => 'hotcoffee::admin.website_description',
                'field_type'    => 'textarea',
                'icon'          => 'ni ni-bold',
                'info_text'     => 'hotcoffee::admin.nfo_website_desc',
                'required'      => false,
                'content'       => null,
            ],

        ],

        // Other settings section
        'hotcoffee::admin.other_settings'  => [

            // Header color
            [
                'name'          => 'header_color',
                'label'         => 'hotcoffee::admin.header_color',
                'field_type'    => 'select',
                'icon'          => null,
                'info_text'     => false,
                'required'      => false,
                'content'       => [
                    'primary'   => 'hotcoffee::admin.default',
                    'info'      => 'hotcoffee::admin.blue',
                    'success'   => 'hotcoffee::admin.green',
                    'danger'    => 'hotcoffee::admin.red',
                    'warning'   => 'hotcoffee::admin.orange',
                    'light'     => 'hotcoffee::admin.gray',
                    'dark'      => 'hotcoffee::admin.black',
                ],
            ],

            // Items per page field
            [
                'name'          => 'paginate',
                'label'         => 'hotcoffee::admin.items_per_page',
                'field_type'    => 'text',
                'icon'          => 'ni ni-bullet-list-67',
                'info_text'     => false,
                'required'      => true,
                'content'       => null,
            ],

            // Date format field
            [
                'name'          => 'date_format',
                'label'         => 'hotcoffee::admin.date_format',
                'field_type'    => 'text',
                'icon'          => 'ni ni-watch-time',
                'info_text'     => 'hotcoffee::admin.nfo_date_format',
                'required'      => true,
                'content'       => null,
            ],

            // Timezone field
            [
                'name'          => 'timezone',
                'label'         => 'hotcoffee::admin.timezone',
                'field_type'    => 'select',
                'icon'          => null,
                'info_text'     => false,
                'required'      => false,
                'content'       => array_combine(DateTimeZone::listIdentifiers(DateTimeZone::ALL), DateTimeZone::listIdentifiers(DateTimeZone::ALL)),
            ],

        ],

    ],

    'validation_rules' => [
        'mail'                  => 'required|email',
        'support_mail'          => 'nullable|email',
        'website_name'          => 'required|max:48',
        'website_description'   => 'max:128',
        'paginate'              => 'required|numeric',
        'testfield'             => 'numeric',
    ],

    'validation_messages'  => [
        //'mail.required'           => 'admin.something_from_translation_file',
        //'mail.email'              => 'Or just a string.',
    ],
];