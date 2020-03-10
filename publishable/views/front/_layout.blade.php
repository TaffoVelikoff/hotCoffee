<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Fonts and icons -->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

		<!-- CSS -->
		<link rel="stylesheet" href="{{ asset('front/css/material-kit.min.css') }}">
		<link rel="stylesheet" href="{{ asset('front/css/front.css') }}">

		<title> {{ settings('website_name') }} @if(isset($metaTitle)) | {{ $metaTitle }} @endif</title>

		<!-- Meta -->
		<meta name="description" content="@if(isset($metaDesc)) {{ $metaDesc }} @else {{ settings('website_description') }} @endif">
		<meta property="og:title" content="{{ settings('website_name') }}" />
		<meta property="og:description" content="@if(isset($metaDesc)) {{ $metaDesc }} @else {{ settings('website_description') }} @endif">
		<meta property="og:url" content="{{ url()->current() }}" />

	</head>
	<body class="index-page sidebar-collapse">
		
		{!! menu('main_menu', 'material-kit') !!}

		@yield('header')

		<div class="main main-raised">
			<div class="section section-basic">
				<div class="container">
					@yield('content')
				</div>
			</div>
		</div>

		<footer class="footer" data-background-color="black">
			<div class="container">

				<div class="copyright">

					<div>
						<small>
							<a href="https://github.com/TaffoVelikoff/hotCoffee" target="_blank">
								{{ coffee_info('name') }}
							</a>
							- {{ coffee_info('description') }}
							Created by <a href="{{ coffee_info('author.homepage') }}" target="_blank">{{ coffee_info('author.name') }}</a> / TAVVO Ltd.
						</small>
					</div>

					<div>
						<small>
							<a href="https://www.creative-tim.com/product/material-kit" target="_blank">Material Kit</a> 
							&copy;
							<script>
								document.write(new Date().getFullYear())
							</script>, made with <i class="material-icons">favorite</i> by
							<a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.
						</small>
					</div>
				</div>

			</div>
		</footer>

		<!--   Core JS Files   -->
		<script src="{{ asset('front/js/core/jquery.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('front/js/core/popper.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('front/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('front/js/plugins/moment.min.js') }}"></script>

		<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
		<script src="{{ asset('front/js/material-kit.js?v=2.0.7') }}" type="text/javascript"></script>

		<script>
			function scrollToDownload() {
				if ($('.section-download').length != 0) {
					$("html, body").animate({
						scrollTop: $('.section-download').offset().top
					}, 1000);
				}
			}
		</script>
	</body>
</html>