<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content bg-gradient-danger">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-notification">{{ __('hotcoffee::admin.req_att') }}</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="py-3 text-center">
            <i class="fas fa-exclamation-triangle fa-3x"></i>
            <h4 class="heading mt-4">{{ __('hotcoffee::admin.are_you_sure') }}</h4>
            <p>{{ __('hotcoffee::admin.these_changes') }}</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white btn-delete" id="btn-delete" data-url="" data-id="">{{ __('hotcoffee::admin.delete') }}</button>
          <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">{{ __('hotcoffee::admin.cancel') }}</button>
        </div>
      </div>
    </div>
</div>