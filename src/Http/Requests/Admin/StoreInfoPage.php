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

        $normalRules = array(
            'images.*'  => 'image|max:2048',
        ); 
        
        $languageRules = language_validation_rules(array(
            'title'     => 'required|max:32|min:3',
            'content'   => 'min:69',
        ));

        if(!request()->edit) {
            $normalRules['keyword'] = 'required|min:3|max:64|without_spaces|alpha_dash|unique:sefs';
        } else {
            $normalRules['keyword'] = Rule::unique('sefs')->ignore(request()->keyword, 'keyword').'|required|min:3|max:64|without_spaces|alpha_dash';
        }

        return array_merge($normalRules, $languageRules);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        
        $normalMessages = array(
            'images.*.image'    => __('hotcoffee::admin.err_must_be_image'),
            'images.*.uploaded' => __('hotcoffee::admin.err_image_upload'),
            'sef.required'      => __('hotcoffee::admin.err_sef_req'),
            'sef.min'           => __('hotcoffee::admin.err_sef_min'),
            'sef.max'           => __('hotcoffee::admin.err_sef_max'),
            'sef.without_spaces'=> __('hotcoffee::admin.err_sef_spaces'),
            'sef.alpha_dash'    => __('hotcoffee::admin.err_sef_alpha_dash')
        );

        $languageMessages = language_validation_messages(array(
            'title.required'        => 'hotcoffee::admin.err_title_required',
            'title.max'             => 'hotcoffee::admin.err_title_max',
            'title.min'             => 'hotcoffee::admin.err_title_min',
            'content.min'           => 'hotcoffee::admin.err_content_required',
        ));

        return array_merge($normalMessages, $languageMessages);

    }
}