<!DOCTYPE html>
<html>

<head>
  <title>{{ config('app.name') }}</title>
  @include('hotcoffee::admin.sections.meta')
  @include('hotcoffee::admin.sections.css')
</head>

<body>

  @include('hotcoffee::admin.sections.nav')

  <!-- Main content -->
  <div class="main-content">
    @include('hotcoffee::admin.sections.topnav')
    @include('hotcoffee::admin.sections.header')

    <!-- Page content -->
    <div class="container-fluid mt--7">

      <div class="row">
        @yield('content')
      </div>
     
    </div>
  </div>

  @include('hotcoffee::admin.sections.js')
  @include('hotcoffee::admin.sections.notify')
  
  @yield('page_js')

</body>

</html>