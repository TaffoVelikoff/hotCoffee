@extends('hotcoffee::_layouts._admin')

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

                    <div class="col-md-12 form-header text-uppercase">
                      {{ __('hotcoffee::admin.contact_info') }}
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-mail">{{ __('hotcoffee::admin.main_mail') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('mail')) has-danger is-invalid-alt @endif">

                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>

                            <input type="text" id="input-mail" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.mail') }}" @else value="{{ settings('mail') }}" @endif name="mail" required="">

                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12 info-div">
                        {{ __('hotcoffee::admin.nfo_main_mail') }}
                      </div>
                
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-support">{{ __('hotcoffee::admin.support_mail') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('support_mail')) has-danger is-invalid-alt @endif">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>

                            <input type="text" id="input-support" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.support_mail') }}" @else value="{{ settings('support_mail') }}" @endif name="support_mail">

                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-12 form-header text-uppercase">
                      {{ __('hotcoffee::admin.seo_options') }}
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-website">{{ __('hotcoffee::admin.website_name') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('website_name')) has-danger is-invalid-alt @endif">

                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-bold"></i></span>
                            </div>

                            <input type="text" id="input-website" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.website_name') }}" @else value="{{ settings('website_name') }}" @endif name="website_name">

                          </div>
                        </div>
                      </div>
                
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-website-description">{{ __('hotcoffee::admin.website_description') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('website_description')) has-danger is-invalid-alt @endif">

                            <textarea id="input-website-description" class="form-control form-control-alternative" name="website_description" rows="4">@if(session('post')){{ session('post.website_description') }}@else{{ settings('website_description') }}@endif</textarea>

                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12 info-div">
                        {{ __('hotcoffee::admin.nfo_website_desc') }}
                      </div>
                
                    </div>

                    <div class="col-md-12 form-header text-uppercase">
                      {{ __('hotcoffee::admin.other_settings') }}
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-paginate">{{ __('hotcoffee::admin.items_per_page') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('paginate')) has-danger is-invalid-alt @endif">

                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>

                            <input type="text" id="input-paginate" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.paginate') }}" @else value="{{ settings('paginate') }}" @endif name="paginate">

                          </div>
                        </div>
                      </div>
                
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-date_format">{{ __('hotcoffee::admin.date_format') }}</label>
                          <div class="input-group input-group-alternative mb-4 @if($errors->has('date_format')) has-danger is-invalid-alt @endif">

                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                            </div>

                            <input type="text" id="input-date_format" class="form-control form-control-alternative" @if(session('post')) value="{{ session('post.date_format') }}" @else value="{{ settings('date_format') }}" @endif name="date_format">

                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12 info-div">
                        {{ __('hotcoffee::admin.nfo_date_format') }} <a href="https://www.php.net/manual/en/datetime.formats.date.php" target="_blank">https://www.php.net/manual/en/datetime.formats.date.php</a>.
                      </div>
                
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-timezone">{{ __('hotcoffee::admin.timezone') }}</label>
                          <div class="input-group input-group-alternative mb-4">

                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-world-2"></i></span>
                            </div>

                            <select id="input-timezone" class="form-control form-control-alternative no-border-radius" name="timezone">
                              @foreach($timezones as $timezone)
                                <option value="{{ $timezone }}" @if(session('post.timezone') == $timezone) selected="" @elseif(!session('post') && $timezone == settings('timezone')) selected="" @endif>{{ $timezone }}</option>
                              @endforeach
                            </select>

                          </div>
                        </div>
                      </div>
                
                    </div>

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