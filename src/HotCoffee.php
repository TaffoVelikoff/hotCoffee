<?php

namespace TaffoVelikoff\HotCoffee;

use File;
use Route;

class HotCoffee
{

	protected $info;
	protected $author;

	public function __construct() {
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
		return \Cache::remember('hotcoffee_info', \Carbon\Carbon::now()->addDays(30), function () {
			$composerJson = json_decode(File::get(__DIR__.'/../composer.json'));
			$info = collect($composerJson)->only(['name', 'description', 'homepage', 'version', 'license']);
			
			foreach(get_object_vars($composerJson->authors[0]) as $key=>$value) {
				$info->put('author.'.$key, $composerJson->authors[0]->$key);
			}

			return $info;
		});
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
				'user_id' => auth()->user()->id, 
				'ip' => request()->ip()
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

		if(!is_numeric($string) && \HotCoffee::isJson($string)) {
			$content = json_decode($string);
			$locale = app()->getLocale();
			return $content->$locale;
		}

		return $string;
	}

	/**
	 * Get a menu and it's elements by keyword
	 * @param string $keyword Keyword of the menu.
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
				$item->children_count = $item->children()->count();
				$item->children = $item->children()->transform(function ($child) {
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
				view()->share('menuItems', $items);
				return view()->make('hotcoffee::components.menu_bootstrap');
				break;

			case 'ul':
				view()->share('menuItems', $items);
				return view()->make('hotcoffee::components.menu_ul');
				break;
			
			default:
				view()->share('menuItems', $items);
				return view()->make($type);
				break;
		}

	}

	/**
	 * Prepare the data in the translatable fields to be stored and merge with the rest fn the request.
	 * @param object $request All the fields that have to be stored/updated in the model's table.
	 * @param array $translatables All translatable fields should be placed in this array.
	 * @param array $special Anything that needs to be removed and not saved/updated.
	 *
	 * @return array Returns an array of fields and values to be stored in the database by an update() or create() method.
	 */
	public function prepareRequest($request, array $translatables, array $special = null) {

		$trans = [];
		if(!$special)
			$special = [];

		$mainFields = $request->except(array_keys($special));

		foreach(config('hotcoffee.languages') as $langKey => $langName) {
			foreach($translatables as $trnslatable) {
				$trans[$trnslatable][$langKey] = $request->$langKey[$trnslatable];
			}
			unset($mainFields[$langKey]);
		}

		return array_merge($mainFields, $trans, $special);
	}

	/**
	 * Get an asset from the package public folder.
	 * @param string $asset Path to the asset.
	 *
	 * @return string Returns a url to the asset.
	 */
	function asset($asset) { 
		if(!config('hotcoffee.load_published_assets') == false) {
			return asset('hotcoffee/'.$asset);
		}

		return url('coffee_assets/'.$asset);
	}

	/**
	 * Get the admin panel logo
	 *
	 * @return string Returns the path to the logo.
	 */
	public function logo() { 
		if(config('hotcoffee.custom_logo_url'))
			return config('hotcoffee.custom_logo_url');

		return coffee_asset('img/admin/logo.png');
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
	 * Dynamically generate validation rules for a translatable field for every languages defined in hotcoffee.php config file.
	 * @param array Array of Laravel validations (example: ['title' => 'required|unique:posts|max:255', 'content' => 'required|min:32']).
	 *
	 * @return array Returns an array of validation rules.
	 */
	public function languageValidationRules($ruleLines = []) {
		$rules = [];

		foreach(config('hotcoffee.languages') as $langKey => $langName) {
			foreach($ruleLines as $field=>$fieldRule) {
				$rules[$langKey.'.'.$field] = $fieldRule;
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
				$messages[$langKey.'.'.$fieldRule]	= trans($trans, ['lang' => $langName]);
			}
		}

		return $messages;
	}

	/**
	 * This will dynamically generate a thumbnail for an image from the public folder.
	 * @param string $filePath Path to an image file.
	 * @param mixed $dimensions String or array of dimensions. For example [300, 400] will create a thumbnail with width of 300px and height of 400px and '300' will create a square image of 300px.
	 * @param bool $fit
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

		foreach(config('hotcoffee.settings') as $group) {
			foreach($group as $setting) {
				if(($setting['field_type'] == 'checkbox' || $setting['field_type'] == 'toggle') && !array_key_exists($setting['name'], request()->except('_token'))) {
					$empty[$setting['name']] = null;
				}
			}
		}

		return $empty;

	}

	/**
	 * Dynamically generate translatable fields in blade templates.
	 */
	public function languageFields($errors, $fields = [], $edit = null) {

		$languageFields = '';
		$languageFieldsContent = '';

		if(count(config('hotcoffee.languages')) > 1) {
          $languageFields .= '
			<div class="nav-wrapper">
              
				<ul class="nav nav-pills nav-pills-circle" role="tablist" id="tabs_2">';

					foreach(config('hotcoffee.languages') as $langKey=>$langName){
						(config('app.locale') == $langKey) ? $active = 'active' : $active = '';
						$languageFields .= '
						<li class="nav-item">
							<a class="nav-link rounded-circle '.$active.'" id="'.$langKey.'" data-toggle="tab" href="#tab-'.$langKey.'" role="tab" aria-controls="'.$langKey.'" aria-selected="true">
						    	<img src="'.coffee_asset('img/flags/'.$langKey.'.svg').'" alt="'.$langName.'" class="flag-img" />
							</a>
						</li>';
					}

				$languageFields .= '
				</ul>

			</div>';
        }

        if(count(config('hotcoffee.languages')) == 1) {
        	$borderNone = 'border-none';
        	$paddingNone = 'padding-none';
        } else {
        	$borderNone = '';
        	$paddingNone = '';
        }

        $languageFields .= '
        <div class="card mb-4 mt-2 '.$borderNone.'">
			<div class="card-body '.$paddingNone.'">
				<div class="tab-content" id="lang-tabs">';

			    foreach(config('hotcoffee.languages') as $langKey=>$langName) {
			    	foreach($fields as $field => $attributes) {

			    		if(session('post')){
							$value = session('post.'.$langKey.'.'.$field);
						} elseif (isset($edit)) {
							$value = $edit->getTranslation($field, $langKey);
						} else {
							$value = '';
						}

						if(isset($errors) && $errors->has($langKey.'.'.$field)) {
							$hasDanger = 'has-danger';
							$isInvalid = 'is-invalid-alt';
						} else {
							$hasDanger = '';
							$isInvalid = '';
						}

						if(isset($attributes['hr']) && $attributes['hr'] === true)
							$languageFieldsContent .= '<hr style="width: 100%;">';

						if($attributes['type'] == 'text') {

							$languageFieldsContent .= '
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label" for="input-'.$field.'-'.$langKey.'">'.$attributes['title'].'</label>
									<div class="'.$hasDanger.'">
										<input type="text" name="'.$langKey.'['.$field.']" id="input-'.$field.'-'.$langKey.'" class="form-control form-control-alternative '.$isInvalid.'" value="'.$value.'">
									</div>
								</div>
							</div>';

							if(isset($attributes['info'])) {
								
								(isset($attributes['info']['type'])) ? $infoType = 'text-'.$attributes['info']['type'] : $infoType = '';

								$languageFieldsContent .= '
									<div class="col-lg-12 info-div '.$infoType.'">
										'.$attributes['info']['content'].'
									</div>';
							}
						}

						if($attributes['type'] == 'textarea') {

							(isset($attributes['class'])) ? $class = $attributes['class'] : $class = ''; 
							(isset($attributes['rows'])) ? $rows = $attributes['rows'] : $rows = '12';

							$languageFieldsContent .= '<div class="col-lg-12">
								<div class="form-group" id="div-'.$field.'-'.$langKey.'">
									<label class="form-control-label" for="input-'.$field.'-'.$langKey.'">'.$attributes['title'].'</label>';
									$languageFieldsContent .= '
									<div class="'.$hasDanger.' '.$isInvalid.'">
										<textarea id="input-'.$field.'-'.$langKey.'" rows="'.$rows.'" name="'.$langKey.'['.$field.']" class="form-control form-control-alternative '.$class.'" placeholder="">'.$value.'</textarea>
									</div>
								</div>
							</div>';

							if(isset($attributes['info'])) {
								
								(isset($attributes['info']['type'])) ? $infoType = 'text-'.$attributes['info']['type'] : $infoType = '';

								$languageFieldsContent .= '
									<div class="col-lg-12 info-div '.$infoType.'">
										'.$attributes['info']['content'].'
									</div>';
							}
						}

					}

					/*  */
			    	(config('app.locale') == $langKey) ? $active = 'show active' : $active = '';
			    	(count(config('hotcoffee.languages')) > 1) ? $sectionTitle = '<h6 class="heading-small text-muted mb-4">'.$langName.'</h6>' : $sectionTitle = '';

			    	$languageFields .= '
			        <div class="tab-pane fade '.$active.'" id="tab-'.$langKey.'" role="tabpanel" aria-labelledby="tab-'.$langKey.'">
			           <div class="pl-lg-4">
			            <div class="row">

			              '.$sectionTitle.$languageFieldsContent;

			            	$languageFields .= '
			            </div>
			          </div>
			        </div>';

			        $languageFieldsContent = '';
			    }

				$languageFields .= '
				</div>
			</div>
		</div>';

        return $languageFields;

	}

	public function additionalAdminRotes($routes) {
		foreach($routes as $route) {
			return $route;
		}
	}

}

//Route::get('/dashboard', 'Admin\DashboardController@index')->name('hotcoffee.admin.dashboard');