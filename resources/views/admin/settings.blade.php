@extends('hotcoffee::admin._layout')

@section('content')
  <div class="card-body">
    <div class="row">
          <div class="col order-xl-1">
              <div class="card bg-secondary shadow">

                <div class="card-body">

                <form action="{{ route('hotcoffee.admin.settings.update') }}" method="post">

                  {{ csrf_field() }}

                  <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.settings') }}</h6>

                  <div class="pl-lg-4">

                    <div class="alert alert-default" role="alert">
                      <strong>How to use?</strong> To get the value of any setting you can call <strong>settings('field')</strong> anywhere in your code.
                    </div>

                    @foreach(config('hotcoffee.settings.fields') as $settingKey=>$settings)

                      <div class="col-md-12 form-header text-uppercase">
                        {{ __($settingKey) }}
                      </div>

                      @foreach($settings as $setting)
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">

                              @if($setting['field_type'])
                                <label class="form-control-label" for="input-{{ $setting['name'] }}">
                                  {{ __($setting['label']) }}
                                  @if(isset($setting['required']) && $setting['required'] == true) <span class="text-danger">*</span> @endif 
                                  <small class="text-primary">setting('{{ $setting['name'] }}')</small>
                                </label>
                              @endif
                              
                              @switch($setting['field_type'])

                                @case('text')
                                  <div class="input-group input-group-alternative mb-4 @if($errors->has($setting['name'])) has-danger is-invalid-alt @endif">

                                    @if(isset($settings['icon']) && $setting['icon'] != null)
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="{{ $setting['icon'] }}"></i></span>
                                      </div>
                                    @endif

                                    <input type="text" id="input-{{ $setting['name'] }}" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.'.$setting['name']) }}" @else value="{{ settings($setting['name']) }}" @endif name="{{ $setting['name'] }}" @if(isset($settings['required']) && $setting['required'] == true) required="" @endif>

                                  </div>
                                  @break

                                @case('textarea')
                                  <div class="input-group input-group-alternative mb-4 @if($errors->has($setting['name'])) has-danger is-invalid-alt @endif">

                                    <textarea id="input-{{ $setting['name'] }}" class="form-control form-control-alternative" name="{{ $setting['name'] }}" rows="4">@if(session('post')){{ session('post.'.$setting['name']) }}@else{{ settings($setting['name']) }}@endif</textarea>

                                  </div>
                                  @break

                                @case('select')
                                  <select id="input-{{ $setting['name'] }}" class="form-control form-control-alternative no-border-radius" name="{{ $setting['name'] }}">
                                    @foreach($setting['content'] as $key=>$value)
                                      <option value="{{ $key }}" @if(session('post.'.$setting['name']) == $key) selected="" @elseif(!session('post') && $key == settings($setting['name'])) selected="" @endif>{{ __($value) }}</option>
                                    @endforeach
                                  </select>
                                  @break

                                @case('checkbox')
                                  <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                    <input class="custom-control-input" id="{{ $setting['name'] }}" type="checkbox" value="{{ $setting['content'] }}" name="{{ $setting['name'] }}" @if(session('post.'.$setting['name'])) checked="checked" @elseif(settings($setting['name']) == $setting['content']) checked="checked" @endif>
                                    <label class="custom-control-label text-lowercase" for="{{ $setting['name'] }}">{{ __($setting['label']) }}</label>
                                  </div>
                                  @break

                                @case('radio')
                                  <div class="row">
                                    @foreach($setting['content'] as $item)
                                      <div class="col">

                                        <div class="custom-control custom-radio mb-3">
                                          <input class="custom-control-input role-radio" id="{{ $setting['name'] }}-{{ $item['value'] }}" type="radio" name="{{ $setting['name'] }}" value="{{ $item['value'] }}" @if(session('post') && session('post.'.$setting['name']) == $item['value']) checked="checked" @elseif(settings($setting['name']) == $item['value']) checked="checked" @endif @if(isset($setting['required']) && $setting['required'] == true) required="" @endif>
                                          <label class="custom-control-label" for="{{ $setting['name'] }}-{{ $item['value'] }}">{{ $item['label'] }}</label>
                                        </div>

                                      </div>
                                    @endforeach
                                  </div>
                                  @break

                                @case('number')
                                  <div class="input-group input-group-alternative mb-4 @if($errors->has($setting['name'])) has-danger is-invalid-alt @endif">

                                    @if($setting['icon'] != null)
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="{{ $setting['icon'] }}"></i></span>
                                      </div>
                                    @endif

                                    <input type="number" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" id="input-{{ $setting['name'] }}" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.'.$setting['name']) }}" @else value="{{ settings($setting['name']) }}" @endif name="{{ $setting['name'] }}" @if($setting['required'] == true) required="" @endif>

                                  </div>
                                  @break

                                @case('toggle')
                                <span class="clearfix"></span>
                                  <label class="custom-toggle">
                                    <input id="{{ $setting['name'] }}" type="checkbox" value="{{ $setting['content'] }}" name="{{ $setting['name'] }}" @if(session('post.'.$setting['name'])) checked="checked" @elseif(settings($setting['name']) == $setting['content']) checked="checked" @endif>
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                  </label>
                                  @break

                              @endswitch

                            </div>
                          </div>

                          @if(isset($setting['info_text']))
                            <div class="col-lg-12 info-div">
                              {!! __($setting['info_text']) !!}
                            </div>
                          @endif
                    
                        </div>
                      @endforeach

                    @endforeach

                    <hr/>

                    <div class="row">
                      <div class="col text-center">
                        <input type="submit" class="btn btn-success" value="{{ __('hotcoffee::admin.save') }}" />
                      </div>
                    </div>
                  </div>

                </form>

              </div>
            </div>
          </div>

        </div>
  </div>
@endsection