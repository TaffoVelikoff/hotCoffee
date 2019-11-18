<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">@if(isset($customPageName)) {{ $customPageName }} @else {{ $pageName }} @endif</a>

    @if(config('hotcoffee.ui_search_bar') == true)
      <!-- Search -->
      <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="{{ route('hotcoffee.admin.search') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group mb-0">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" placeholder="{{ __('hotcoffee::admin.search') }}" type="text" name="keyword" style="color: white !important;" @if(isset(request()->keyword)) value="{{ request()->keyword }}" @endif>
          </div>
        </div>
      </form>
    @endif
  
    @if(config('hotcoffee.ui_secondary_menu') == true || config('hotcoffee.ui_user_dropdown') == true)
      <ul class="navbar-nav align-items-center d-none d-md-flex">

        @if(config('hotcoffee.ui_secondary_menu') == true)
          @include('hotcoffee::admin.sections.options')
        @endif

        @if(config('hotcoffee.ui_user_dropdown') == true)
          @include('hotcoffee::admin.sections.user')
        @endif

      </ul>
    @endif

  </div>
</nav>