<!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('hotcoffee.admin.dashboard') }}">
        <img src="{{ coffee_logo() }}" />
      </a>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">

        @include('hotcoffee::admin.sections.options')
        @include('hotcoffee::admin.sections.user')

      </ul>

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="{{ coffee_asset('img/admin/logo.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        @if(config('hotcoffee.ui_search_bar') == true)
          <form class="mt-4 mb-3 d-md-none" action="" method="post">
            <div class="input-group input-group-rounded input-group-merge">
              <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('hotcoffee::admin.search') }}" aria-label="{{ __('hotcoffee::admin.search') }}">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-search"></span>
                </div>
              </div>
            </div>
          </form>
        @endif

        @foreach(config('hotcoffee.nav') as $item)
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link @if(in_array($viewName, $item['views'])) active @endif" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif href="@if(\Route::has($item['route'])) @if(!isset($item['params'])) {{ route($item['route']) }} @else {{ route($item['route'], $item['params']) }} @endif @else {{ $item['route'] }} @endif">
                <i class="{{ $item['icon'] }} text-primary"></i> {{ __($item['name']) }}
              </a>
            </li>
          </ul>

          @if(isset($item['hr']) && $item['hr'] == true)
            <hr class="my-3">
          @endif
        @endforeach

      </div>
    </div>
  </nav>