<?php

	use TaffoVelikoff\HotCoffee\Settings;

	/**
	 * Get an asset from the package public folder
	 */
	if (! function_exists('coffee_asset')) {

	   	function coffee_asset($asset) { 
	   		if(!config('hotcoffee.load_published_assets') == false) {
	    		return asset('hotcoffee/'.$asset);
	    	}

	    	return url('coffee_assets/'.$asset);
		}
	}

	/**
	 * Get the admin panel logo
	 */
	if (! function_exists('coffee_logo')) {

	   	function coffee_logo() { 
	    	if(config('hotcoffee.custom_logo_url'))
	    		return config('hotcoffee.custom_logo_url');

	    	return coffee_asset('img/admin/logo.png');
		}
	}

	/**
	 * Get a setting from the json file
	 */
	if (! function_exists('settings')) {

		function settings($key = null, $default = null) {
			$settings = Settings::make(storage_path('app/settings.json'));
			return $settings->get($key, $default);
		}

	}

	/**
	 * Dynamically set validation rules for a translatable form request
	 */
	function language_validation_rules($ruleLines) {
		$rules = array();

        foreach(config('hotcoffee.languages') as $langKey => $langName) {
            foreach($ruleLines as $field=>$fieldRule) {
                $rules[$langKey.'.'.$field] = $fieldRule;
            }
        }

        return $rules;
	}

	/**
	 * Dynamically set validation messages for a translatable form request
	 */
	function language_validation_messages($messageLines) {

        $messages = array();
        
        foreach(config('hotcoffee.languages') as $langKey => $langName) {
        	foreach($messageLines as $fieldRule => $trans) {
        		$messages[$langKey.'.'.$fieldRule]	= trans($trans, ['lang' => $langName]);
        	}
        }

        return $messages;
	}

	/**
	 * Prepare the data in the translatable fields to be stored and merge with the rest if the request
	 * @param object $request
	 * @param array $trnslatables
	 * @param array $special
	 */
	function prepare_request($request, array $trnslatables, array $special = null) {

		$trans = array();
		if(!$special)
			$special = array();

        $mainFields = $request->except(array_keys($special));

        foreach(config('hotcoffee.languages') as $langKey => $langName) {
            foreach($trnslatables as $trnslatable) {
                $trans[$trnslatable][$langKey] = $request->$langKey[$trnslatable];
            }
            unset($mainFields[$langKey]);
        }

        return array_merge($mainFields, $trans, $special);
	}

	/**
	 * This will dynamically generate a thumbnail
	 */
	function thumbnail($filePath, $dimentions = null, $fit = null) {

		$dimentionsQuery = '';
		$fitQuery = '';

		(isset($dimentions)) ? $query = '?' : $query = '';

		if(isset($dimentions))
			(is_array($dimentions)) ? $dimentionsQuery = 'w='.$dimentions[0].'&h='.$dimentions[1] : $dimentionsQuery = 'w='.$dimentions.'&h='.$dimentions;

		if(isset($fit))
			$fitQuery = '&fit='.$fit;

		return url('img'.'/'.$filePath.$query.$dimentionsQuery.$fitQuery);
	}

	/**
	 * Dynamically create translatable fields in blade templates
	 */
	function language_fields($errors, $fields = array(), $edit = null) {

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