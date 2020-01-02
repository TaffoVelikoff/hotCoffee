@extends('hotcoffee::_layouts._admin')

@section('content')
<div class="container-fluid">
      <div class="row">

        @if(isset($edit))
          <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <img src="@if($avatar == null) {{ coffee_asset('img/admin/unknown.png') }} @else {{ $avatar->url }} @endif" class="rounded-circle">
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

              </div>
              <div class="card-body pt-0 pt-md-4">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                      
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h3>
                    {{ $edit->name }}
                  </h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>
                    {{ $edit->address->city }}@if(!empty($edit->address->country) && !empty($edit->address->city)), @endif
                    {{ $edit->address->country }}
                  </div>
                  <div class="h5 mt-4">
                    @if(!empty($edit->address->job_title) || !empty($edit->address->company))
                      <i class="ni business_briefcase-24 mr-2"></i> {{ __('hotcoffee::admin.user_org_job') }}
                    @endif
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>{{ $edit->address->job_title }} @if(!empty($edit->address->job_title) && !empty($edit->address->company)) @ @endif {{ $edit->address->company }}
                  </div>
                  <hr class="my-4">
                  <p>{{ $edit->address->bio }}</p>
                </div>
              </div>
            </div>
          </div>
        @endif
        <div class="@if(isset($edit)) col-xl-8 @else col @endif order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-body">

              <form @if(isset($edit)) action="{{ route('hotcoffee.admin.users.edit', $edit) }}" @else action="{{ route('hotcoffee.admin.users.store') }}" @endif method="post" enctype="multipart/form-data" id="croppie-form">

                {{ csrf_field() }}

                @if(isset($edit)) <input type="hidden" value="{{ $edit->id }}" name="edit" /> @endif

                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_info') }}</h6>

                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">{{ __('hotcoffee::admin.user_name') }}</label>
                        <div @if($errors->has('name')) class="has-danger" @endif>
                          <input type="text" name="name" id="input-first-name" class="form-control form-control-alternative @if($errors->has('name')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.name') }}" @elseif(isset($edit)) value="{{ $edit->name }}" @endif>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">{{ __('hotcoffee::admin.user_mail') }}</label>
                        <div @if($errors->has('email')) class="has-danger" @endif>
                          <input type="email" name="email" id="input-email" class="form-control form-control-alternative @if($errors->has('email')) is-invalid-alt @endif" placeholder="me@mail.com" @if(session('post')) value="{{ session('post.email') }}" @elseif(isset($edit)) value="{{ $edit->email }}" @endif>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <hr class="my-4">
                <!-- Address -->

                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_contact_info') }}</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    {{--@foreach($userAddressFields as $field=>$properties)
                      @switch($properties['type'])

                        @case('text')
                          <div class="col-lg-6">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-city">{{ __($properties['label']) }}</label>
                              <div @if($errors->has($field)) class="has-danger" @endif>
                                <input type="text" name="{{ $field }}" id="input-{{ $field }}" class="form-control form-control-alternative @if($errors->has($field)) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.'.$field) }}" @elseif(isset($edit)) value="{{ $edit->address->$field }}" @endif @if(isset($properties['placeholder'])) placeholder="{{ __($properties['placeholder']) }}" @endif>
                              </div>
                            </div>
                          </div>
                          @break

                        @case('textarea')
                          <div class="col-lg-12">
                            <div class="form-group focused">
                              <label class="form-control-label" for="input-city">{{ __($properties['label']) }}</label>
                              <div @if($errors->has($field)) class="has-danger" @endif>
                                <textarea rows="4" maxlength="64" name="{{ $field }}" class="form-control form-control-alternative @if($errors->has($field)) is-invalid-alt @endif" @if(isset($properties['placeholder'])) placeholder="{{ __($properties['placeholder']) }}" @endif>@if(session('post')){{ session('post.'.$field) }}@elseif(isset($edit)){{ $edit->address->$field }}@endif</textarea>
                              </div>
                            </div>
                          </div>
                          @break


                      @endswitch
                    @endforeach --}}

                    @yield('custom')

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">{{ __('hotcoffee::admin.user_city') }}</label>
                        <div @if($errors->has('city')) class="has-danger" @endif>
                          <input type="text" name="city" id="input-city" class="form-control form-control-alternative @if($errors->has('city')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.city') }}" @elseif(isset($edit)) value="{{ $edit->address->city }}" @endif>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">{{ __('hotcoffee::admin.user_country') }}</label>
                        <div @if($errors->has('country')) class="has-danger" @endif>
                          <input type="text" name="country" id="input-country" class="form-control form-control-alternative @if($errors->has('country')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.country') }}" @elseif(isset($edit)) value="{{ $edit->address->country }}" @endif>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">{{ __('hotcoffee::admin.user_company') }}</label>
                        <div @if($errors->has('company')) class="has-danger" @endif>
                          <input type="text" name="company" id="input-last-name" class="form-control form-control-alternative @if($errors->has('company')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.company') }}" @elseif(isset($edit)) value="{{ $edit->address->company }}" @endif>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">{{ __('hotcoffee::admin.user_job') }}</label>
                        <div @if($errors->has('job_title')) class="has-danger" @endif>
                          <input type="text" name="job_title" id="input-last-name" class="form-control form-control-alternative @if($errors->has('job_title')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.job_title') }}" @elseif(isset($edit)) value="{{ $edit->address->job_title }}" @endif>
                        </div>
                      </div>
                    </div>


                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">{{ __('hotcoffee::admin.user_about') }}</label>
                        <div @if($errors->has('bio')) class="has-danger" @endif>
                          <textarea rows="4" maxlength="64" name="bio" class="form-control form-control-alternative @if($errors->has('bio')) is-invalid-alt @endif" placeholder="{{ __('hotcoffee::admin.user_bio') }}">@if(session('post')){{ session('post.bio') }}@elseif(isset($edit)){{ $edit->address->bio }}@endif</textarea>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              
                @if(count(config('hotcoffee.admin_languages')) > 1)
                  <hr class="my-4"/>

                  <!-- Description -->
                  <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_language') }}</h6>
                  <div class="pl-lg-4">
                    <div class="form-group focused">
                      <select id="input-locale" class="form-control form-control-alternative no-border-radius" name="locale">
                          @foreach(config('hotcoffee.admin_languages') as $acronym=>$language)
                            <option value="{{ $acronym }}"  @if( (session('post') && session('post.locale') == $acronym) || (isset($edit) && $edit->locale == $acronym) ) selected @endif>{{ $language }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                @endif

                <hr class="my-4"/>

                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_role') }}</h6>
                <div class="row">

                  @foreach($roles as $role)
                  <div class="col">

                    <div class="custom-control custom-radio mb-3">
                      <input class="custom-control-input role-radio" id="role-{{ $role->id }}" type="radio" name="role" value="{{ $role->id }}" @if(isset($edit) && $edit->hasRole($role->name)) checked="checked" @endif 
                      @if(isset($edit) && $edit->id == 1) disabled @endif>
                      <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                    </div>

                  </div>
                  @endforeach

                </div>

                @if($errors->has('role'))
                  <div class="row" id="role-error">
                    <div class="col">
                      <div class="alert alert-danger" role="alert">
                        {{ __('hotcoffee::admin.err_role') }}
                      </div>
                    </div>
                  </div>
                @endif

                <hr class="my-4">

                <!-- Profile picture -->
                <div>
                  <h6 class="heading-small text-muted mb-4">Profile picture</h6>
                  <div class="col text-center" id="attachment">

                    <div id="main-cropper"></div>
                    
                    <a class="button actionUpload">
                      <input type="file" id="upload" value="Choose Image" accept="image/*" name="file" class="btn btn-primary">
                    </a>

                    <input type="hidden" id="imagebase64" name="imagebase64">

                    <br/><br/>
                    @if(isset($avatar) && $avatar != null) 
                      <a href="{{ route('hotcoffee.admin.attachments.destroy', $avatar->id) }}" class="btn btn-danger attDel" onclick="return confirm('{{ __('hotcoffee::admin.att_del') }}');">
                        <i class="fas fa-trash-alt"></i> &nbsp; {{ __('hotcoffee::admin.delete') }}
                      </a> 
                    @endif
                    <a href="#!" class="attRotate btn btn-primary" @if(!isset($avatar) || $avatar == null) style="display:none;" @endif><i class="fas fa-sync-alt"></i> &nbsp; {{ __('hotcoffee::admin.rotate') }}</a>
                    <button class="btn btn-outline-warning attCancel"><i class="fas fa-ban"></i> &nbsp; {{ __('hotcoffee::admin.cancel') }}</button>
                  </div>
                </div>

                <hr class="my-4"/>

                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.pass') }}</h6>
                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">{{ __('hotcoffee::admin.pass') }}</label>
                        <div @if($errors->has('password')) class="has-danger" @endif>
                          <input type="password" name="password" id="input-first-name" class="form-control form-control-alternative @if($errors->has('password')) is-invalid-alt @endif">
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">{{ __('hotcoffee::admin.rep_pass') }}</label>
                        <div @if($errors->has('password')) class="has-danger" @endif>
                          <input type="password" name="password_confirmation" id="input-first-name" class="form-control form-control-alternative @if($errors->has('password')) is-invalid-alt @endif">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <hr class="my-4"/>

                <div class="row">
                  <div class="col text-center">
                    <input type="submit" class="upload-result btn btn-success" value="{{ __('hotcoffee::admin.save') }}">
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer"></footer>

    </div>
@endsection

@section('page_js')
  
  <!-- Croppie -->
  <script type="text/javascript">
    var basic = $('#main-cropper').croppie({
      viewport: { width: 500, height: 500 },
      boundary: { width: 500, height: 500 },
      showZoomer: true,
      mouseWheelZoom: true,
      enableOrientation: true,
      @if(!isset($avatar) || $avatar == null) url: '{{ coffee_asset('img/admin/unknown.png') }}' @else url: '{{ $avatar->url }}' @endif
    });

    var swapUrl = @if(!isset($avatar)) '{{ coffee_asset('img/admin/unknown.png') }}'; @else '{{ $avatar->url }}'; @endif
    hasPic = @if(isset($avatar)) 1; @else 0; @endif

    // Press S to submit form
    window.onkeydown = function(event) {
      //alert(event.keyCode);
        if (event.keyCode === 13) {
          window.submitCroppieForm();
        }
    };

  </script>
@endsection