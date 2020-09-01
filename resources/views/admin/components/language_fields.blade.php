@if(count(config('hotcoffee.languages')) > 1)
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-pills-circle" role="tablist" id="tabs_2">

            @foreach(config('hotcoffee.languages') as $langKey=>$langName)
                <li class="nav-item">
                    <a class="nav-link rounded-circle @if(config('app.locale') == $langKey) active @endif" id="{{ $langKey }}-{{ $rid }}" data-toggle="tab" href="#tab-{{ $langKey }}-{{ $rid }}" role="tab" aria-controls="{{ $langKey }}-{{ $rid }}" aria-selected="true">
                        <img src="{{ asset('vendor/hotcoffee/img/flags/'.$langKey.'.svg') }}" alt="{{ $langName }}" class="flag-img" />
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
@endif

<div class="card mb-4 mt-2 @if(count(config('hotcoffee.languages')) == 1) border-none @endif">
    <div class="card-body @if(count(config('hotcoffee.languages')) == 1) padding-none @endif">
        <div class="tab-content" id="lang-tabs">

            @foreach(config('hotcoffee.languages') as $langKey=>$langName)
                <div class="tab-pane fade @if(config('app.locale') == $langKey) active show @endif" id="tab-{{ $langKey }}-{{ $rid }}" role="tabpanel" aria-labelledby="tab-{{ $langKey }}-{{ $rid }}">
                    <div class="pl-lg-4">
                        <div class="row">

                            @if(count(config('hotcoffee.languages')) > 1)
                                <h6 class="heading-small text-muted mb-4">{{ $langName }}</h6>
                            @endif

                            @foreach($fields as $field => $attributes)

                                @if(isset($attributes['hr']) && $attributes['hr'] === true)
                                    <hr style="width: 100%;">
                                @endif

                                @if($attributes['type'] == 'text')

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-{{ $field }}-{{ $langKey }}">{{ $attributes['title'] }}@if(isset($attributes['required']) && $attributes['required'] === true)<span class="text-danger">*</span>@endif</label>
                                            <div class="@if(isset($errors) && $errors->has($field.'.'.$langKey)) has-danger @endif">
                                                <input type="text" name="{{ $field }}[{{ $langKey }}]" id="input-{{ $field }}-{{ $langKey }}" class="form-control form-control-alternative @if(isset($errors) && $errors->has($field.'.'.$langKey)) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.'.$field.'.'.$langKey) }}" @elseif(isset($edit)) value="{{ $edit->getTranslation($field, $langKey) }}" @endif @if(isset($attributes['required']) && $attributes['required'] === true) required="" @endif />
                                            </div>
                                        </div>
                                    </div>

                                @endif

                                @if($attributes['type'] == 'textarea')

                                    <div class="col-lg-12">
                                        <div class="form-group" id="div-{{ $field }}-{{ $langKey }}">
                                            <label class="form-control-label" for="input-{{ $field }}-{{ $langKey }}">{{ $attributes['title'] }}@if(isset($attributes['required']) && $attributes['required'] === true)<span class="text-danger">*</span>@endif</label>
                                            <div class="@if(isset($errors) && $errors->has($field.'.'.$langKey)) has-danger is-invalid-alt @endif">
                                                <textarea id="input-{{ $field }}-{{ $langKey }}" rows="@if(isset($attributes['rows'])) @attributes['rows'] @else 12 @endif" name="{{ $field }}[{{ $langKey }}]" class="form-control form-control-alternative @if(isset($attributes['class'])) {{ $attributes['class'] }} @endif" placeholder="" @if(isset($attributes['required']) && $attributes['required'] === true) required="" @endif>@if(session('post')){{ session('post.'.$field.'.'.$langKey) }}@elseif(isset($edit)){{ $edit->getTranslation($field, $langKey) }}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                                @if(isset($attributes['info']))
                                    <div class="col-lg-12 info-div @if(isset($attributes['info']['type'])) text-{{ $attributes['info']['type'] }} @endif">
                                        {{ $attributes['info']['content'] }}
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>