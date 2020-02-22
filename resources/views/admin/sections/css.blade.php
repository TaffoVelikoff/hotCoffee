<!-- Favicon -->
<link href="{{ asset('vendor/hotcoffee/img/favicon.png') }}" rel="icon" type="image/png">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="{{ asset('vendor/hotcoffee/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/hotcoffee/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

<!-- Admin Dashboard CSS -->
<link type="text/css" href="{{ asset('vendor/hotcoffee/css/admin/argon.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/hotcoffee/css/admin/admin.css') }}" rel="stylesheet">

@foreach(config('hotcoffee.additional_css') as $css)
	<link type="text/css" href="{{ asset($css) }}" rel="stylesheet">
@endforeach

<!-- Vendor -->
<link type="text/css" href="{{ asset('vendor/hotcoffee/plugins/croppie/croppie.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/hotcoffee/plugins/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/hotcoffee/plugins/jquery-ui/jquery-ui.min.css') }}">