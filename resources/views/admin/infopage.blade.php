@extends('hotcoffee::_layouts._admin')

@section('content')
<div class="container-fluid">
      <div class="row">

        <div class="col order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-body">

              <form @if(isset($edit)) action="{{ route('hotcoffee.admin.infopages.edit', $edit) }}" @else action="{{ route('hotcoffee.admin.infopages.store') }}" @endif method="post" enctype="multipart/form-data" id="croppie-form">

                @if(isset($edit))
                  <input type="hidden" name="edit" value="{{ $edit->id }}" />
                @endif

                {{ csrf_field() }}

                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.page_nfo') }}</h6>

                <!-- TRANSLATABLE FIELDS -->
                {!! language_fields($errors, [
                  'title' => ['type' => 'text', 'title' => __('hotcoffee::admin.title')],
                  'content' => ['type' => 'textarea', 'title' => 'Content', 'class' => 'tinymce', 'info' => ['type' => 'warning', 'content' => __('hotcoffee::admin.page_content_nfo')]],
                  'meta_desc' => ['type' => 'textarea', 'title' => __('hotcoffee::admin.meta_desc'), 'info' => ['content' => __('hotcoffee::admin.meta_desc_nfo')], 'rows' => '4']
                ], $edit ?? null) !!}
                <!-- END TRANSLATABLE FIELDS -->

                <hr class="my-4"/>

                <!-- CUSTOM URL -->
                <h6 class="heading-small text-muted mb-4">
                  {{ __('hotcoffee::admin.custom_url') }}
                  <span class="text-danger">*</span>
                </h6>

                <div class="pl-lg-4">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div @if($errors->has('keyword')) class="has-danger" @endif>
                          <input type="text" name="keyword" id="keyword" class="form-control form-control-alternative @if($errors->has('keyword')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.keyword') }}" @elseif(isset($edit)) value="{{ $edit->keyword() }}" @endif>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-lg-12 info-div">
                      {{ __('hotcoffee::admin.sef_nfo') }}
                    </div>
                  </div>

                </div>
                <!-- CUSTOM URL -->
                
                <hr class="my-4"/>

                <!-- PAGE GROUP -->
                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.page_group') }}</h6>

                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">

                        <div class="input-group input-group-alternative mb-4">

                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                          </div>

                          <select id="input-key" class="form-control form-control-alternative no-border-radius" name="key">
                            @foreach(config('hotcoffee.page_groups') as $groupName => $groupDescription)
                              <option value="{{ $groupName }}" @if( (session('post') && session('post.key') == $groupName) || (isset($edit) && $edit->key == $groupName) ) selected @endif>{{ $groupDescription }}</option>
                            @endforeach
                          </select>

                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-12 info-div">
                      {{ __('hotcoffee::admin.nfo_page_group') }}
                    </div>
                  </div>
            
                </div>
                <!-- END PAGE GROUP -->

                <hr class="my-4"/>

                <!-- ROLES -->
                <h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_access') }}</h6>

                <div class="pl-lg-4">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">{{ __('hotcoffee::admin.user_access_only')}}</label>
                          
                          <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="role-admin" type="checkbox" disabled="">
                            <label class="custom-control-label text-lowercase" for="admin">{{ __('hotcoffee::admin.admin') }}</label>
                          </div>

                          <div id="roles">
                            @foreach($roles as $role)
                              @if($role->id != 1)
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                  <input class="custom-control-input role" id="role-{{ $role->id }}" type="checkbox" data-role="{{ $role->name }}" value="{{ $role->name }}" name="roles[]" @if(session('post.roles') && in_array($role->name, session('post.roles'))) checked @endif @if(isset($edit->roles) && in_array($role->name, $edit->roles)) checked @endif>
                                  <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                              @endif
                            @endforeach
                          </div>

                      </div>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-lg-12 info-div text-primary" id="access-nfo">
                      @if(session('post') && session('post.roles'))
                        {{ __('hotcoffee::admin.page_roles_only') }}: 
                        <strong>
                          admin,
                          @foreach(session('post.roles') as $step => $postRole)
                            {{ $postRole }}@if($step+1 < count(session('post.roles'))), @endif 
                          @endforeach
                        </strong>
                      @elseif(isset($edit->roles))
                        {{ __('hotcoffee::admin.page_roles_only') }}: 
                        <strong>
                          admin,
                          @foreach($edit->roles as $step => $postRole)
                            {{ $postRole }}@if($step+1 < count($edit->roles)), @endif 
                          @endforeach
                        </strong>
                      @else
                        {{ __('hotcoffee::admin.page_roles_all') }}
                      @endif
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-lg-12 info-div">
                      {{ __('hotcoffee::admin.user_access_nfo') }}
                    </div>
                  </div>
            
                </div>
                <!-- END ROLES -->

                @if(config('hotcoffee.info_image_atts') == true)
                  <hr/>

                  <!-- IMAGE ATTACHMENTS -->
                  <h6 class="heading-small text-muted mb-1">{{ __('hotcoffee::admin.attach_images') }}</h6>

                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">

                          @if(isset($edit) && $edit->attachmentsGroup('images')->isEmpty() == false)
                            <div class="row">
                              @foreach($edit->attachmentsGroup('images') as $att)
                                <div class="col-lg-3">

                                  <div class="row">
                                    <div class="col">
                                      <a href="{{ thumbnail($att->filepath) }}" target="_blank" >
                                        <img src="{{ thumbnail($att->filepath, 400, 'crop') }}" class="attachment-image" />
                                      </a>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col text-center att-btns">
                                      <a href="{{ $att->url }}" class="btn-att">
                                        <i class="fas fa-download"></i>
                                      </a>
                                      <a href="{{ route('hotcoffee.admin.attachments.destroy', ['id' => $att->id]) }}" class="btn-att">
                                        <i class="fas fa-trash-alt"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            </div>
                          @endif

                          <br/>

                          <label class="form-control-label" for="input-key">Upload images</label>
                          <div class="row col-md-12">
                            <div class="file-field">
                              <div class="btn btn-primary btn-sm">
                                <span>{{ __('hotcoffee::admin.choose_files') }}</span>
                                <input type="file" multiple name="images[]">
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="{{ __('hotcoffee::admin.upload_one_more') }}">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12 info-div mt-2">
                              {{ __('hotcoffee::admin.choose_files_nfo') }}<br/>
                              {{ __('hotcoffee::admin.choose_files_nfo_2') }}<br/>
                              {{ __('hotcoffee::admin.choose_files_nfo_3') }}
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END IMAGE ATTACHMENTS -->
                @endif

                <hr class="my-4"/>

                <!-- SUBMIT BUTTON -->
                <div class="row">
                  <div class="col text-center">
                    <input type="submit" class="upload-result btn btn-success" value="{{ __('hotcoffee::admin.save') }}">
                  </div>
                </div>
                <!-- END SUBMIT BUTTON -->

              </form>

            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer"></footer>

    </div>

    @include('hotcoffee::admin.sections.tinymce')
@endsection

@section('page_js')
  <script type="text/javascript">
    $('.role').change(function() {
        var selectedRoles = '';

        $('#roles :checked').each(function() {
          selectedRoles += $(this).val();
          if($(this)[0] != $('#roles :checked').last()[0]) {
            selectedRoles += ', ';
          }
        });

        if ($("#roles input:checkbox:checked").length > 0) {
          $('#access-nfo').html('{{ __('hotcoffee::admin.page_roles_only') }}: <strong>admin, ' + selectedRoles + '</strong>');
          $('#role-admin').prop( "checked", true );
        } else {
          $('#access-nfo').html('{{ __('hotcoffee::admin.page_roles_all') }}');
          $('#role-admin').prop( "checked", false );
        } 
    });
  </script>
@endsection