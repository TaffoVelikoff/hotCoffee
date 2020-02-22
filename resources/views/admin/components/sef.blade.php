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