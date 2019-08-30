<?php

namespace TaffoVelikoff\HotCoffee\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
            'name' => 'required|without_spaces|min:3|max:18',
            'description' => 'required|max:64',
        ];
    }

}
