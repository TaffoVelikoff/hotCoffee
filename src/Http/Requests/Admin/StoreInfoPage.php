<?php

namespace TaffoVelikoff\HotCoffee\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInfoPage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Flash post to session
        session()->flash('post', request()->except('images'));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        // For non-translatable (or normal) fields
        $normal = [
            'images.*'  => 'image|max:2048',
        ]; 
        
        // For translatable fields
        $trnslatable = language_validation_rules([
            'title'     => 'required|max:32|min:3',
            'content'   => 'required',
        ]);

        // Validate SEF keyword
        $normal['keyword'] = Rule::unique('sefs')->ignore(request()->keyword, 'keyword').'|required|min:3|max:64|without_spaces|alpha_dash';
        if(!request()->edit) {
            $normal['keyword'] = 'required|min:3|max:64|without_spaces|alpha_dash|unique:sefs';
        }

        // Additional validation rules specified in the config files.
        $additional = array_merge(
            config('hotcoffee.infopages.validations.normal'), 
            language_validation_rules(
                config('hotcoffee.infopages.validations.translatable')
            )
        );

        // Merge all
        return array_merge($normal, $trnslatable, $additional);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        
        // For non-translatable (or normal) fields
        $normal = [
            'images.*.image'    => __('hotcoffee::admin.err_must_be_image'),
            'images.*.uploaded' => __('hotcoffee::admin.err_image_upload'),
            'sef.required'      => __('hotcoffee::admin.err_sef_req'),
            'sef.min'           => __('hotcoffee::admin.err_sef_min'),
            'sef.max'           => __('hotcoffee::admin.err_sef_max'),
            'sef.without_spaces'=> __('hotcoffee::admin.err_sef_spaces'),
            'sef.alpha_dash'    => __('hotcoffee::admin.err_sef_alpha_dash')
        ];

        // For translatable fields
        $translatable = language_validation_messages([
            'title.required'        => 'hotcoffee::admin.err_title_required',
            'title.max'             => 'hotcoffee::admin.err_title_max',
            'title.min'             => 'hotcoffee::admin.err_title_min',
            'content.req'           => 'hotcoffee::admin.err_content_required',
        ]);

        // Additional validation messages specified in the config files.
        $additional = array_merge(
            config('hotcoffee.infopages.messages.normal'), 
            language_validation_messages(
                config('hotcoffee.infopages.messages.translatable')
            )
        );

        // Merge all
        return array_merge($normal, $translatable, $additional);

    }
}