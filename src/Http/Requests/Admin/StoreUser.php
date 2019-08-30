<?php

namespace TaffoVelikoff\HotCoffee\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Flash post to session
        session()->flash('post', request()->except('file'));

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'name'      => 'required|min:3|max:18',
            'email'     => 'required|without_spaces|email',
            'city'      => 'max:32',
            'country'   => 'max:32',
            'company'   => 'max:48',
            'bio'       => 'max:64',
            'role'      => 'required',
        ];

        if(request()->edit && request()->edit == 1) {
            $rules['role'] = '';
        }

        if(request()->edit) {
            $rules['password'] = 'sometimes|nullable|confirmed|min:6';
        }

        if(!request()->edit) {
             $rules['password'] = 'required|confirmed|min:6';
        }

        if(!request()->edit) {
            $rules['email'] = 'unique:users,email|required|without_spaces|email';
        }

        if(request()->edit) {
            $rules['email'] = Rule::unique('users')->ignore(request()->edit).'|email';
        }

        return $rules;
    }
}
