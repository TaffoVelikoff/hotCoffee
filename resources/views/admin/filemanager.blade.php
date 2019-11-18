@extends('hotcoffee::_layouts._admin')

@section('content')
	<div class="col-xl-12 mb-5 mb-xl-0">
		<div class="card-body">

			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn-switch btn btn-default btn-md text-uppercase" id="images" data-type="Images">
						<i class="fas fa-images"></i> 
						{{ __('hotcoffee::admin.fm_images') }}
					</button>
					<button type="button" class="btn-switch btn btn-primary btn-md text-uppercase" id="files" data-type="Files">
						<i class="fas fa-file-word"></i>
						{{ __('hotcoffee::admin.fm_files') }}
					</button>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-md-12">
					<iframe id="manager" src="{{ url('') }}/laravel-filemanager?type=Images" style="width: 100%; height: 680px; overflow: hidden; border: none;"></iframe>
				</div>
			</div>

		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		$( ".btn-switch" ).click(function() {
			var type = $(this).data("type");

			if(type == 'Images') {
				$('#images').removeClass('btn-primary').addClass('btn-default');
				$('#files').removeClass('btn-default').addClass('btn-primary');
			} else {
				$('#files').removeClass('btn-primary').addClass('btn-default');
				$('#images').removeClass('btn-default').addClass('btn-primary');
			}

			url = '{{ url("laravel-filemanager?type=") }}' + type;

		    var iframe = $('#manager');
		    if (iframe.length) {
		        iframe.attr('src',url);   
		        return false;
		    }

		    return true;
		});

		function loadIframe(iframeName, url) {
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-default');

		    var $iframe = $('#' + iframeName);
		    if ( $iframe.length ) {
		        $iframe.attr('src',url);   
		        return false;
		    }
		    return true;
		}
	</script>
@endsection