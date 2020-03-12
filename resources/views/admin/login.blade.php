<!DOCTYPE html>
<html>

<head>
  <title>{{ config('app.app_name') }}</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">

  <!-- Favicon -->
  <link href="{{ asset('vendor/hotcoffee/img/favicon.png') }}" rel="icon" type="image/png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Icons -->
  <link href="{{ asset('vendor/hotcoffee/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet">

  <!-- CSS -->
  <link type="text/css" href="{{ asset('vendor/hotcoffee/css/admin/argon.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('vendor/hotcoffee/css/admin/admin.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('vendor/hotcoffee/plugins/animate.css') }}" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <h1 class="text-center mb-4">{{ config('app.name') }} Admin Zone</h1>
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>ADMIN AREA</small>
              </div>
              <form role="form" action="{{ route('hotcoffee.admin.auth') }}" method="post">
                
                {{ csrf_field() }}

                <div class="form-group mb-3 @if($errors->get('email')) has-danger @endif">
                  <div class="input-group input-group-alternative @if($errors->get('email')) is-invalid-alt @endif">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email" required="" @if(session()->get('post')) value="{{ session()->get('post.email') }}" @endif>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" required="">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckLogin" type="checkbox" name="remember" value="1" @if(session()->get('post') && session()->get('post.remember') == 1) checked="" @endif>
                  <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary my-4" value="Sign In">
                </div>
              </form>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12 text-center">
              <small>hotCoffee Admin. Developed by <a href="{{ coffee_info('author.homepage') }}" target="_blank">{{ coffee_info('author.name') }}</a>
              <br/>
              TAVVO Ltd.</small>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('vendor/hotcoffee/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/hotcoffee/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/hotcoffee/plugins/notify.min.js') }}"></script>
  <script src="{{ asset('vendor/hotcoffee/plugins/jquery-ui.js') }}"></script>

  <script src="{{ asset('vendor/hotcoffee/js/admin/argon.js') }}"></script>

  @include('hotcoffee::admin.sections.notify')

</body>

</html>