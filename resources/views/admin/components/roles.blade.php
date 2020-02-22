<h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.user_access') }}</h6>

<div class="pl-lg-4">

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label">{{ __('hotcoffee::admin.user_access_only')}}</label>

          <div class="custom-control custom-control-alternative custom-checkbox mb-3">
            <input class="custom-control-input" id="role-admin" type="checkbox" disabled="" @if(session('post.roles')) checked @endif @if(isset($edit) && !session('post') && !$edit->access_roles->isEmpty()) checked @endif>
            <label class="custom-control-label text-lowercase" for="admin">{{ __('hotcoffee::admin.admin') }}</label>
          </div>

          <div id="roles">
            @foreach($roles as $role)
              @if($role->id != 1)
                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                  <input class="custom-control-input role" id="role-{{ $role->id }}" type="checkbox" data-role="{{ $role->name }}" value="{{ $role->id }}" name="roles[]" @if(session('post.roles') && in_array($role->id, session('post.roles'))) checked @endif @if(isset($edit) && !session('post') && $edit->access_roles->contains($role->id)) checked @endif>
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
            {{ $roles->where('id', $postRole)->first()->name }}@if($step+1 < count(session('post.roles'))), @endif 
          @endforeach
        </strong>
      @elseif(isset($edit) && !$edit->access_roles->isEmpty() && !session('post'))
        {{ __('hotcoffee::admin.page_roles_only') }}: 
        <strong>
          admin,
          @foreach($edit->access_roles as $step => $postRole)
            {{ $postRole->name }}@if($step+1 < $edit->access_roles->count()), @endif 
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

@section('page_js')
  @include('hotcoffee::admin.components.roles_js')
@endsection