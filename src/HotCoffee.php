<?php

namespace TaffoVelikoff\HotCoffee;

use Str;
use File;
use Route;

class HotCoffee
{

	protected $info;
	protected $version;

	public function __construct() {
		$this->version = '1.1.0';
		$this->info = $this->infoFromComposer();
	}

	/**
	 * Load routes
	 *
	 * @return void
	 */
	public function routes()
    {
		require __DIR__.'/../routes/web.php';
    }

    /**
	 * Get a setting from the json file.
	 * @param string $key Key of the setting.
	 * @param string @default Default value, if key is not found.
	 *
	 * @return mixed[] Returns the value of the setting.
	 */
    public function settings($key = null, $default = null) {
    	$settings = \TaffoVelikoff\HotCoffee\Settings::make(storage_path('app/settings.json'));
		return $settings->get($key, $default);
    }

    /**
	 * Gets package info from composer.json
	 *
	 * @return Collection Returns a collection containing package information.
	 */
	public function infoFromComposer() {

		// Get info from composer or cache
		$info = \Cache::remember('hotcoffee_info', \Carbon\Carbon::now()->addDays(30), function () {
			$composerJson = json_decode(File::get(__DIR__.'/../composer.json'));
			$info = collect($composerJson)->only(['name', 'description', 'homepage', 'license']);
			
			foreach(get_object_vars($composerJson->authors[0]) as $key=>$value) {
				$info->put('author.'.$key, $composerJson->authors[0]->$key);
			}

			return $info;
		});

		// Also put version info
		$info->put('version', $this->version);
		
		return $info;
	}

    /**
     * Get package info field
     * @param string $field Info field.
     *
     * @return string Returns the value of the info field.
     */
    public function info($field) {
    	if(!isset($this->info[$field]))
    		return null;

    	return $this->info[$field];
    }

    /**
	 * Record current user's login in the database.
	 *
	 * @return void
	 */
    public function recordAuth() {
    	if(config('hotcoffee.auth_log') == true) {
			\TaffoVelikoff\HotCoffee\Login::create([
				'user_id' 		=> auth()->user()->id, 
				'user_name'		=> auth()->user()->name,
				'user_email' 	=> auth()->user()->email,
				'ip'			=> request()->ip()
			]);
		}
    }

    /**
	 * Used in the SearchController.
	 * @param string $string
	 *
	 * @return string
	 */
    public function fieldContentForSearch($string) {

		if(!is_numeric($string) && \TaffoVelikoff\HotCoffee\Facades\HotCoffee::isJson($string)) {
			$content = json_decode($string);
			$locale = app()->getLocale();
			return $content->$locale;
		}

		return $string;
	}

	/**
	 * Get a menu and it's elements by keyword
	 * @param string $keyword Keyword of the menu.
	 * @param string $type Type of menu or blade view to render.
	 *
	 * @return mixed[] Returns the menu, menu items or renders a template.
	 */
	public function menu($keyword, $type = 'ul') {
		$menu = \TaffoVelikoff\HotCoffee\Menu::where('keyword', $keyword)->first();
			
		// Check if menu exists
		if(!$menu)
			return null;

		// Get and cache items
		$items = \Cache::remember('hotcoffee_menu_'.$keyword, \Carbon\Carbon::now()->addDays(30), function () use ($menu) {

		    return $menu->items->where('parent', 0)->transform(function ($item) {

				// Generate the URL
				$item->link = $item->getRoute();

				// Get and count children elements
				$item->children_count = $item->children->count();
				$item->children = $item->children->transform(function ($child) {
					$child->link = $child->getRoute();
					return $child;
				});

				return $item;
		    });

		});

		switch ($type) {
			case 'collection':
				return $items;
				break;

			case 'json':
				return $items->toJson();
				break;

			case 'menu':
				return $menu;
				break;

			case 'bootstrap':
				return view()->make('hotcoffee::components.menu_bootstrap')->with('menuItems', $items);
				break;

			case 'material-kit':
				return view()->make('hotcoffee::components.menu_material')->with('menuItems', $items);
				break;

			case 'ul':
				return view()->make('hotcoffee::components.menu_ul')->with('menuItems', $items);
				break;
			
			default:
				return view()->make($type)->with('menuItems', $items);
				break;
		}

	}
	
	/**
	 * Get the admin panel logo
	 *
	 * @return string Returns the path to the logo.
	 */
	public function logo() { 
		if(config('hotcoffee.custom_logo_url'))
			return config('hotcoffee.custom_logo_url');

		return asset('vendor/hotcoffee/img/admin/logo.png');
	}


	/**
	 * Check if string is JSON.
	 * @param string $string String to be checked.
	 */
	public function isJson($string) {
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	/**
	 * Dynamically generate validation rules for a translatable field for all languages defined in hotcoffee.php config file.
	 * @param array Array of Laravel validations (example: ['title' => 'required|unique:posts|max:255', 'content' => 'required|min:32']).
	 *
	 * @return array Returns an array of validation rules.
	 */
	public function languageValidationRules($ruleLines = []) {
		$rules = [];

		foreach(config('hotcoffee.languages') as $langKey => $langName) {
			foreach($ruleLines as $field=>$fieldRule) {
				$rules[$field.'.'.$langKey] = $fieldRule;
			}
		}

		return $rules;
	}

	/**
	 * Dynamically generate validation messages for a translatable field for every languages defined in hotcoffee.php config file.
	 * @param array $messageLines (example: ['title.required' => __('admin.something_from_translation_file'), 'title.required' => 'Or just a string.']).
	 *
	 * @return array Returns an array of validation messages.
	 */
	public function languageValidationMessages($messageLines) {

		$messages = [];

		foreach(config('hotcoffee.languages') as $langKey => $langName) {
			foreach($messageLines as $fieldRule => $trans) {
				$splitRule = explode('.', $fieldRule);
				$messages[$splitRule[0].'.'.$langKey.'.'.$splitRule[1]]	= trans($trans, ['lang' => $langName]);
			}
		}
		return $messages;
	}

	/**
	 * Dynamically generates a thumbnail for an image, stores it in the cache and renders it.
	 * @param string $filePath Path to an image file.
	 * @param mixed $dimensions String or array of dimensions. For example [300, 400] will create a thumbnail with width of 300px and height of 400px and '300' will create a square image of 300px.
	 * @param string $fit Sets how the image is fitted to its target dimensions.
	 */
	public function thumbnail($filePath, $dimentions, $fit = null, $source = null) {
		if(!isset($dimentions))
			return null;

		$dimentionsQuery = '';
		$sourceQuery = '';
		$fitQuery = '';

		if(isset($dimentions))
			(is_array($dimentions)) ? $dimentionsQuery = 'w='.$dimentions[0].'&h='.$dimentions[1] : $dimentionsQuery = 'w='.$dimentions.'&h='.$dimentions;

		if(isset($fit))
			$fitQuery = '&fit='.$fit;

		if(isset($source))
			$sourceQuery = '&source='.$source;

		return url('img'.'/'.$filePath.'?'.$dimentionsQuery.$fitQuery.$sourceQuery);
	}

	/**
	 * Used for the Settings page to add any unchecked checkboxes/toggle fields to the request with value of null.
	 *
	 * @return array Returns an array of any unchecked checkboxes/toggles from the settings page.
	 */

	public function grabEmptyCheckboxes() {

		$empty = [];

		foreach(config('hotcoffee.settings.fields') as $group) {
			foreach($group as $setting) {
				if(($setting['field_type'] == 'checkbox' || $setting['field_type'] == 'toggle') && !array_key_exists($setting['name'], request()->except('_token'))) {
					$empty[$setting['name']] = null;
				}
			}
		}

		return $empty;

	}

	/**
	 * Automatically generates fields for the translatable attributes.
	 * @param array $fields HTML fields.
	 * @param mixed $edit Model to be updated.
	 */

	public function languageFields($fields = [], $edit = null) {
		return view()->make('hotcoffee::admin.components.language_fields')
			->with('fields', $fields)
			->with('rid', Str::random(16)) // Random id to make it possible to have multiple groups of tabs on same page
			->with('edit', $edit);
	}

	/**
	 * Generates field for the SEF keyword (for search engine friendly URLs).
	 * @param mixed $edit Model to be updated.
	 */
	public function sefField($edit = null) {
		return view()->make('hotcoffee::admin.components.sef')->with('edit', $edit);
	}

	/**
	 * Generates an upload field for the image attachments.
	 * @param mixed $edit Model to be updated.
	 */
	public function imageAttachmentsField($edit = null) {
		return view()->make('hotcoffee::admin.components.imgatt')->with('edit', $edit);
	}

}