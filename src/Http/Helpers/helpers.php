<?php

	if (!function_exists('coffee_asset')) {
	   	function coffee_asset($asset) { 
	   		return TaffoVelikoff\HotCoffee\Facades\HotCoffee::asset($asset);
		}
	}

	if (!function_exists('coffee_info')) {
		function coffee_info($field) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::info($field);
		}
	}

	if (!function_exists('coffee_logo')) {
		function coffee_logo() {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::logo();
		}
	}

	if (!function_exists('settings')) {
		function settings($key = null, $default = null) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::settings($key, $default);
		}
	}

	if (!function_exists('menu')) {
		function menu($keyword, $type = 'ul') {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::menu($keyword, $type);
		}
	}


	if (!function_exists('language_validation_rules')) {
		function language_validation_rules($ruleLines = []) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::languageValidationRules($ruleLines);
		}
	}


	if (!function_exists('language_validation_messages')) {
		function language_validation_messages($messageLines) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::languageValidationMessages($messageLines);
		}
	}


	if (!function_exists('prepare_request')) {
		function prepare_request($request, array $translatables, array $special = null) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::prepareRequest($request, $translatables, $special);
		}
	}


	if (!function_exists('thumbnail')) {
		function thumbnail($filePath, $dimentions = '500', $fit = null, $source = 'public') {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::thumbnail($filePath, $dimentions, $fit, $source);
		}
	}

	if (!function_exists('is_json')) {
		function is_json($string) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::isJson($string);
		}
	}


	if (!function_exists('field_content_for_search')) {
		function field_content_for_search($string) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::fieldContentForSearch($string);
		}
	}


	if (!function_exists('language_fields')) {
		function language_fields($errors, $fields = [], $edit = null) {
			return TaffoVelikoff\HotCoffee\Facades\HotCoffee::languageFields($errors, $fields, $edit);
		}
	}