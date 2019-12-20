<!-- Vendor JS -->
<script src="{{ coffee_asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ coffee_asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ coffee_asset('vendor/notify.min.js') }}"></script>
<script src="{{ coffee_asset('vendor/croppie/croppie.min.js') }}"></script>
<script src="{{ coffee_asset('vendor/exif.js') }}"></script>
<script src="{{ coffee_asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ coffee_asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>
<script src="{{ coffee_asset('vendor/jquery-ui.js') }}"></script>
<script src="{{ coffee_asset('plugins/nested_sortable/jquery.mjs.nestedSortable.js') }}"></script>

<!-- JS -->
<script src="{{ coffee_asset('js/admin/admin.js') }}"></script>
<script src="{{ coffee_asset('js/admin/argon.js') }}"></script>

@foreach(config('hotcoffee.additional_js') as $js)
	<script src="{{ asset($js) }}"></script>
@endforeach

@yield('page_js')