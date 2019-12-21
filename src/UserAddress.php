<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $guarded = [''];

    /**
     * Fields to appear on the user page in admin zone.
     */
    public static function fields() {
        return [
            'city' => [
                'type'          => 'text',
                'label'         => 'hotcoffee::admin.user_city',
            ],

            'country' => [
                'type'          => 'text',
                'label'         => 'hotcoffee::admin.user_country',
            ],

            'job_title' => [
                'type'          => 'text',
                'label'         => 'hotcoffee::admin.user_job',
            ],

            'company' => [
                'type'          => 'text',
                'label'         => 'hotcoffee::admin.user_company',
            ],

            'bio' => [
                'type'          => 'textarea',
                'label'         => 'hotcoffee::admin.user_about',
                'placeholder'   => 'hotcoffee::admin.user_bio',
            ],
        ];
    }
}
