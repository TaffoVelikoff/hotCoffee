
<li class="nav-item dropdown">
  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="media align-items-center">
      <span class="avatar avatar-sm rounded-circle">
        <img alt="Image placeholder" src="@if(auth()->user()->attachmentsGroup('avatar')->isEmpty() == true) {{ asset('assets/img/admin/unknown.png') }} @else {{ auth()->user()->attachmentsGroup('avatar')->first()->url }} @endif">
      </span>
      <div class="media-body ml-2 d-none d-lg-block">
        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
      </div>
    </div>
  </a>
  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
      <h6 class="text-overflow m-0">{{ __('hotcoffee::admin.welcome') }}!</h6>
    </div>

    <a href="{{ route('hotcoffee.admin.users.edit', auth()->user()) }}" class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>{{ __('hotcoffee::admin.my_profile') }}</span>
    </a>

    <div class="dropdown-divider"></div>

    <a href="{{ route('hotcoffee.admin.logout') }}" class="dropdown-item">
      <i class="ni ni-user-run"></i>
      <span>{{ __('hotcoffee::admin.logout') }}</span>
    </a>
  </div>
</li>