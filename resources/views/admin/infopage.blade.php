@extends('hotcoffee::admin._layout')

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
                {!! language_fields([
                  'title' => ['type' => 'text', 'title' => __('hotcoffee::admin.title')],
                  'content' => ['type' => 'textarea', 'title' => 'Content', 'class' => 'tinymce'],
                  'meta_desc' => ['type' => 'textarea', 'title' => __('hotcoffee::admin.meta_desc'), 'info' => ['content' => __('hotcoffee::admin.meta_desc_nfo')], 'rows' => '4']
                ], $edit ?? null) !!}
                <!-- END TRANSLATABLE FIELDS -->

                <hr class="my-4"/>

                <!-- CUSTOM URL -->
                @include('hotcoffee::admin.components.sef')
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
                            @foreach(config('hotcoffee.infopages.groups') as $groupName => $groupDescription)
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
                @include('hotcoffee::admin.components.roles')
                <!-- END ROLES -->

                @if(config('hotcoffee.infopages.image_attachments') == true)
                  @include('hotcoffee::admin.components.imgatt')
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
      
    </div>

    @include('hotcoffee::admin.components.tinymce')
@endsection