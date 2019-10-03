<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="modal-item" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">

            <form role="form" id="item-form">

              <input type="hidden" id="input-menu-id" name="menu_id" value="{{ $edit->id }}">

              <div class="form-group">
                <label class="form-control-label" for="input-name">{{ __('hotcoffee::admin.name') }} <span class="text-danger">*</span></label>
                <input type="text" id="input-name" class="form-control form-control-alternative" name="name" required="" placeholder="{{ __('hotcoffee::admin.menu_item_name_holder') }}">
              </div>

              <div class="form-group">
                <label class="form-control-label" for="input-rul">{{ __('hotcoffee::admin.url') }} <a href="#" id="question-url"><i class="fas fa-question-circle"></i></a></label>
                <input type="text" id="input-url" class="form-control form-control-alternative" name="url" required="" placeholder="http://website.com">
              </div>

              <div class="form-group">
                <label class="form-control-label" for="input-rul">{{ __('hotcoffee::admin.or_page') }}</label>
                <select id="input-page" class="form-control form-control-alternative no-border-radius" name="page_id">
                  <option value="0">-- {{ __('hotcoffee::admin.none') }} --</option>
                  @foreach($infos as $info)
                    <option value="{{ $info->id }}">{{ $info->title }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="form-control-label" for="input-icon">{{ __('hotcoffee::admin.icon_code') }}</label>
                <input type="text" id="input-icon" class="form-control form-control-alternative" name="icon" required="" placeholder="<i class=&quot;fas fa-icons&quot;></i>">
              </div>

              <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                <input class="custom-control-input" id="new-window" type="checkbox" value="1" name="new_window">
                <label class="custom-control-label text-lowercase" for="new-window">{{ __('hotcoffee::admin.new_window') }}</label>
              </div>

              <div class="text-center">
                <button type="button" class="btn btn-primary my-4 btn-save">{{ __('hotcoffee::admin.save') }}</button>
                <button type="button" class="btn btn-primary my-4 btn-update">{{ __('hotcoffee::admin.update') }}</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-question" tabindex="-1" role="dialog" aria-labelledby="modal-question" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">

            <small>
              {{ __('hotcoffee::admin.url_nfo_1') }}<br/>
              <strong>{{ __('hotcoffee::admin.example') }}: https://google.com/</strong><br/><br/>
              {{ __('hotcoffee::admin.url_nfo_2') }}
              <strong>{{ __('hotcoffee::admin.example') }}: home</strong><br/><br/>
              {{ __('hotcoffee::admin.url_nfo_3') }}
              <strong>{{ __('hotcoffee::admin.example') }}: #about</strong>
              <br/><br/>
              {{ __('hotcoffee::admin.url_nfo_5') }}
              <br/><br/>
              {{ __('hotcoffee::admin.url_nfo_4') }}
            </small>

            <br/>
            <br/>
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('hotcoffee::admin.ok') }}</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>