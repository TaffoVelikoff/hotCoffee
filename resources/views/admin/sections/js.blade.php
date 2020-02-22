<!-- plugins JS -->
<script src="{{ asset('vendor/hotcoffee/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/plugins/notify.min.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/plugins/croppie/croppie.min.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/plugins/exif.js') }}"></script>

<script src="{{ asset('vendor/hotcoffee/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/plugins/nested_sortable/jquery.mjs.nestedSortable.js') }}"></script>

<!-- JS -->
<script src="{{ asset('vendor/hotcoffee/js/admin/admin.js') }}"></script>
<script src="{{ asset('vendor/hotcoffee/js/admin/argon.js') }}"></script>

@foreach(config('hotcoffee.additional_js') as $js)
	<script src="{{ asset($js) }}"></script>
@endforeach

@yield('page_js')