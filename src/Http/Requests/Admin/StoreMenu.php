<?php

namespace TaffoVelikoff\HotCoffee\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Flash post to session
        session()->flash('post', request()->all());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $normalRules = [
            'keyword'     => 'sometimes|required|unique:menus|max:16|min:3|without_spaces'
        ]; 

        $languageRules = [];

        return array_merge($normalRules, $languageRules);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        
        $normalMessages = [
            'keyword.required'        => __('hotcoffee::admin.err_keyword_required'),
            'keyword.max'             => __('hotcoffee::admin.err_keyword_max'),
            'keyword.min'             => __('hotcoffee::admin.err_keyword_min'),
            'keyword.without_spaces'  => __('hotcoffee::admin.err_keyword_spaces'),
            'keyword.unique'            => __('hotcoffee::admin.err_keyword_unique'),
        ];

        $languageMessages = [];

        return array_merge($normalMessages, $languageMessages);

    }
}