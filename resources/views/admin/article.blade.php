@extends('hotcoffee::_layouts._admin')

@section('content')
<div class="container-fluid">
      <div class="row">

        <div class="col order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-body">

              <form @if(isset($edit)) action="{{ route('hotcoffee.admin.articles.edit', $edit) }}" @else action="{{ route('hotcoffee.admin.articles.store') }}" @endif method="post" enctype="multipart/form-data" id="croppie-form">

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
                ]) !!}
                <!-- END TRANSLATABLE FIELDS -->

                <hr class="my-4"/>

                <!-- TAGS -->
                <h6 class="heading-small text-muted mb-4">
                  {{ __('hotcoffee::admin.tags') }}
                </h6>

                <div class="pl-lg-4">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div @if($errors->has('tags')) class="has-danger" @endif>
                          <input type="text" name="tags" id="tags" class="form-control form-control-alternative @if($errors->has('tags')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.tags') }}" @elseif(isset($edit)) value="{{ $tags }}" @endif>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-lg-12 info-div">
                      {{ __('hotcoffee::admin.comma_sep') }}
                    </div>
                  </div>

                </div>
                <!-- END TAGS -->

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
                <!-- END CUSTOM URL -->

                @if(config('hotcoffee.article_image_atts') == true)
                  @include('hotcoffee::admin.sections.imgatt')
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
<script>
  $( function() {
    var availableTags = [
      @foreach($allTags as $atag)
        "{{ $atag->name }}",
      @endforeach
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
</script>

@endsection