<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="modal-item" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">

            <form role="form" id="item-form">

              <input type="hidden" name="menu_id" value="{{ $edit->id }}">

              <div class="form-group">
                <label class="form-control-label" for="input-name">{{ __('hotcoffee::admin.name') }}</label>
                <input type="text" id="input-name" class="form-control form-control-alternative" name="name" required="" placeholder="{{ __('hotcoffee::admin.menu_item_name_holder') }}">
              </div>

              <div class="form-group">
                <label class="form-control-label" for="input-rul">{{ __('hotcoffee::admin.url') }}</label>
                <input type="text" id="input-url" class="form-control form-control-alternative" name="url" required="" placeholder="http://website.com">
              </div>

              <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                <input class="custom-control-input" id="new-window" type="checkbox" value="1" name="new_window">
                <label class="custom-control-label text-lowercase" for="new-window">{{ __('hotcoffee::admin.new_window') }}</label>
              </div>

              <div class="text-center">
                <button type="button" class="btn btn-primary my-4 btn-save">{{ __('hotcoffee::admin.save') }}</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>