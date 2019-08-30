<?php

namespace TaffoVelikoff\HotCoffee\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettings extends FormRequest
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
        return [
            'mail'                  => 'required|email',
            'support_mail'          => 'nullable|email',
            'website_name'          => 'required|max:48',
            'website_description'   => 'max:128',
            'paginate'              => 'required|numeric',
        ];
    }
}
