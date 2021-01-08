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
		// Normal fields
		$rules = [
			'name'      => 'required|min:3|max:18',
			'email'     => 'required|without_spaces|email',
			'city'      => 'max:32',
			'country'   => 'max:32',
			'company'   => 'max:48',
			'bio'       => 'max:64',
			'role'      => 'required',
		];

		if($this->edit && request()->edit == 1) {
			$rules['role'] = '';
		}

		if($this->edit) {
			$rules['password'] = 'sometimes|nullable|confirmed|min:6';
		}

		if(!$this->edit) {
			 $rules['password'] = 'required|confirmed|min:6';
		}

		if(!$this->edit) {
			$rules['email'] = 'unique:users,email|required|without_spaces|email';
		}

		if($this->edit) {
			$rules['email'] = Rule::unique('users')->ignore(request()->edit).'|email';
		}

		// Additional validation rules specified in the config files.
		$additional = array_merge(
			config('hotcoffee.users.validations.normal'), 
			language_validation_rules(
				config('hotcoffee.users.validations.translatable')
			)
		);

		// Merge all
		return array_merge($rules, $additional);
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
			'name.required'			=> __('hotcoffee::admin.err_user_name_req'),
			'name.min'				=> __('hotcoffee::admin.err_user_name_min'),
			'name.max'				=> __('hotcoffee::admin.err_user_name_max'),
			'email.required'		=> __('hotcoffee::admin.err_user_mail_req'),
			'email.without_spaces'	=> __('hotcoffee::admin.err_user_mail_space'),
			'email.email'			=> __('hotcoffee::admin.err_user_mail_email'),
			'city.max'				=> __('hotcoffee::admin.err_user_city_max'),
			'country.max'			=> __('hotcoffee::admin.err_user_cntry_max'),
			'company.max'			=> __('hotcoffee::admin.err_user_company_max'),
			'bio.max'				=> __('hotcoffee::admin.err_user_bio_max'),
			'role.required'			=> __('hotcoffee::admin.err_user_role_req'),
			'password.required'		=> __('hotcoffee::admin.err_user_pass_req'),
		];

		// Additional validation messages specified in the config files.
		$additional = array_merge(
			config('hotcoffee.users.messages.normal'), 
			language_validation_messages(
				config('hotcoffee.users.messages.translatable')
			)
		);

		// Merge all
		return array_merge($normal, $additional);

	}
}
