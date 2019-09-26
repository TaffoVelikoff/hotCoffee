@extends('hotcoffee::_layouts._admin')

@section('content')

	<div class="card-body">
		<div class="row">
        
	        <div class="col order-xl-1">
	          	<div class="card bg-secondary shadow">

		            <div class="card-body">

						<form @if(isset($edit)) action="{{ route('hotcoffee.admin.menus.edit', $edit) }}" @else action="{{ route('hotcoffee.admin.menus.store') }}" @endif method="post">

							{{ csrf_field() }}

							<h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.menu') }}</h6>

							<div class="pl-lg-4">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label" for="input-keyword">{{ __('hotcoffee::admin.keyword') }}</label>
											<div @if($errors->has('keyword')) class="has-danger" @endif>
												<input type="text" id="input-keyword" class="form-control form-control-alternative @if($errors->has('keyword')) is-invalid-alt @endif" @if(session('post')) value="{{ session('post.keyword') }}" @elseif(isset($edit)) value="{{ $edit->keyword }}" @endif name="keyword" required="" @if(isset($edit)) disabled="" @endif>
											</div>
										</div>
									</div>
							
								</div>

								<hr/>

								@if(isset($edit))
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label class="form-control-label" for="input-keyword">{{ __('hotcoffee::admin.menu_items') }}</label>

												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-item">add</button>

												<ol class="sortable">
													@foreach($items as $item)
														<li id="item-{{ $item->id }}">
															<div>
																<i class="fas fa-arrows-alt"></i> &nbsp; {{ $item->name }} 
																<a href="{{ route('hotcoffee.admin.menuitems.destroy', $item) }}" class="float-right btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
															</div>
														</li>
													@endforeach
												</ol>

												{{-- <ol class="sortable">
													<li id="item-1">
														<div><i class="fas fa-arrows-alt"></i> &nbsp; Item 1</div>
													</li>
													<li id="item-2">
														<div><i class="fas fa-arrows-alt"></i> &nbsp; Item 2</div>
													</li>
													<li id="item-3">
														<div><i class="fas fa-arrows-alt"></i> &nbsp; Item 3</div>
													</li>
													<li id="item-4">
														<div><i class="fas fa-arrows-alt"></i> &nbsp; Item 4</div>
														<ol>
															<li id="item-5">
																<div><i class="fas fa-arrows-alt"></i> &nbsp; Some sub-item content</div>
															</li>
															<li id="item-6">
																<div><i class="fas fa-arrows-alt"></i> &nbsp; Some sub-item content</div>
															</li>
														</ol>
													</li>
												</ol> --}}
											</div>
										</div>
									</div>

									<input type="hidden" name="order" value="" id="order" />

									<hr/>
								@endif

								<div class="row">
									<div class="col text-center">
										<input type="submit" class="btn btn-success" value="@if(isset($edit)) {{ __('hotcoffee::admin.save') }} @else {{ __('hotcoffee::admin.create') }} @endif" />
									</div>
								</div>
							</div>

						</form>

					</div>
				</div>
	        </div>

      	</div>
	</div>

	@if(isset($edit)) @include('hotcoffee::admin.modals.item') @endif
	@include('hotcoffee::admin.modals.delete')
@endsection

@section('page_js')
	<script type="text/javascript">
		
		// Deleting
		$(document).on('click','.btn-save',function(){

			var data = $('#item-form').serialize();
			$('#modal-item').modal('hide');

		    $.ajax({
				type: 'POST',
				url: '{{ route('hotcoffee.admin.menuitems.store') }}',
				data: data,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(e){
					$.notify({
				        title: "<strong>Success</strong>",
				        icon: 'glyphicon glyphicon-star',
				        message: e.message
				      },{
				        type: e.type,
				        animate: {
				          enter: 'animated fadeInDown',
				          exit: 'animated fadeOutRight'
				        },
				        placement: {
				          from: 'top',
				          align: 'right'
				        },
				        offset: 20,
				        spacing: 10,
				        z_index: 1031,
				    });
				    $('.sortable').prepend('<li id="item-90"><div class="ui-sortable-handle"><i class="fas fa-arrows-alt"></i> &nbsp; ' + e.name + '</div></li>');
				},
				error: function(){ 
		        	notify('Ooops!', 'Something went wrong.', 'danger', 'top', 'right');
				}

			});

		});

	</script>
@endsection