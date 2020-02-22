<li class="nav-item dropdown">
  <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="{{ config('hotcoffee.secondary_menu_icon') }}"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
    @foreach(config('hotcoffee.secondary_menu') as $item)
      <a class="dropdown-item" href="{{ route($item['route']) }}">{{ __($item['name']) }}</a>

      @if(isset($item['divider']) && $item['divider'] == true)
        <div class="dropdown-divider"></div>
      @endif
    @endforeach
  </div>
</li>

@if(count(config('hotcoffee.admin_languages')) > 1)
  <li class="nav-item dropdown">
    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="{{ asset('vendor/hotcoffee/img/flags/'.app()->getLocale().'.svg') }}" class="menu-flag" />
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
      @foreach(config('hotcoffee.admin_languages') as $acronym=>$language)
        <a class="dropdown-item" href="{{ route('hotcoffee.admin.locale', $acronym) }}"><img src="{{ asset('vendor/hotcoffee/img/flags/'.$acronym.'.svg') }}" class="menu-flag"/> &nbsp; {{ $language }}</a>
      @endforeach
    </div>
  </li>
@endif