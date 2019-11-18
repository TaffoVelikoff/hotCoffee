<hr class="my-4"/>

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