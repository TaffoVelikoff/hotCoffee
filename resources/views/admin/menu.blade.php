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
												<input type="text" id="input-keyword" class="form-control form-control-alternative @if($errors->has('keyword')) is-invalid-alt @endif" @if(session('post.keyword')) value="{{ session('post.keyword') }}" @elseif(isset($edit)) value="{{ $edit->keyword }}" @endif name="keyword" required="" @if(isset($edit)) disabled="" @endif>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label" for="input-description">{{ __('hotcoffee::admin.description') }}</label>
											<div @if($errors->has('description')) class="has-danger" @endif>
												<input type="text" name="description" class="form-control form-control-alternative @if($errors->has('description')) is-invalid-alt @endif" value="@if(session('post')){{ session('post.description') }}@elseif(isset($edit)){{ $edit->description }}@endif" />
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

												<div class="float-right">
													<button type="button" class="btn btn-default btn-sm btn-add">
														<i class="fas fa-plus-circle"></i> {{ __('hotcoffee::admin.add') }}
													</button>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<small>{{ __('hotcoffee::admin.store_order') }}</small>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<ol class="sortable">
															@foreach($items as $item)
																@if($item->parent == 0)
																	<li id="item-{{ $item->id }}">
																		<div>
																			<i class="fas fa-arrows-alt"></i> &nbsp; <span id="item-name-{{ $item->id }}">{{ $item->name }}</span>
																			
																			<a class="float-right btn btn-sm btn-danger btn-delete-conf btn-menu-actions" data-id="{{ $item->id }}" data-url="{{ route('hotcoffee.admin.menuitems.destroy', $item) }}">
																				<i class="fas fa-trash-alt"></i>
																			</a>

																			<a class="float-right btn btn-sm btn-success btn-menu-actions btn-menu-edit" data-id="{{ $item->id }}">
																				<i class="fas fa-pencil-alt"></i>
																			</a>
																		</div>
																		<ol>
																			@foreach($item->children as $child)
																				<li id="item-{{ $child->id }}">
																					<div>
																						<i class="fas fa-arrows-alt"></i> &nbsp; <span id="item-name-{{ $child->id }}">{{ $child->name }}</span>
																						<a class="float-right btn btn-sm btn-danger btn-delete-conf" data-id="{{ $child->id }}" data-url="{{ route('hotcoffee.admin.menuitems.destroy', $child) }}">
																							<i class="fas fa-trash-alt"></i>
																						</a>
																						<a class="float-right btn btn-sm btn-success btn-menu-actions btn-menu-edit" data-id="{{ $child->id }}">
																							<i class="fas fa-pencil-alt"></i>
																						</a>
																					</div>
																				</li>
																			@endforeach
																		</ol>
																	</li>
																@endif
															@endforeach
														</ol>
													</div>
												</div>

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

	@if(isset($edit)) @include('hotcoffee::admin.modals.item_copy') @endif
	@include('hotcoffee::admin.modals.delete')
@endsection

@section('page_js')
	<script type="text/javascript">

		$(document).on('click','.btn-add',function() {
			$('.btn-save').show();
			$('.btn-update').hide();
		});

		$(document).on('click','.btn-menu-edit',function() {
			var endpoint = '{{ url(config('hotcoffee.prefix').'/menuitems') }}' + '/' + $(this).data('id');

			$.ajax({
				type: 'GET',
				url: endpoint,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(e){

					@foreach(config('hotcoffee.languages') as $langKey=>$langName)
						$('#input-name-{{ $langKey }}').val(e.name.{{ $langKey }});
					@endforeach

					$('#input-url').val(e.url);
					$('#input-icon').val(e.icon);

					if(e.new_window == 1) {
						$('#new-window').prop('checked', true);
					} else {
						$('#new-window').prop('checked', false);
					}

					if(e.page_id != 0) {
						$("#input-page").val(e.page_id);
					} else {
						$("#input-page").val(0);
					}

					$('.btn-update').data("id", e.id);

					$('.btn-update').show();
					$('.btn-save').hide();

					$('#modal-item').modal('show');
				},
				error: function(){ 
		        	alert('Something went wrong...');
				}

			});
		});

		$(document).on('click','.btn-save',function() {

			var reqlength = $('.input-name').length;
			var value = $('.input-name').filter(function () {
			    return this.value != '';
			});

			if (value.length>=0 && (value.length !== reqlength)) {
					
				@if(count(config('hotcoffee.languages')) > 1)
					alert('{{ __('hotcoffee::admin.err_title_menu_req_lng') }}');
				@else
					alert('{{ __('hotcoffee::admin.err_title_menu_req') }}');
				@endif

			} else {

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
					    $('.sortable').prepend('<li id="item-' + e.id + '"><div class="ui-sortable-handle"><i class="fas fa-arrows-alt"></i> &nbsp; ' + e.name + '<a class="float-right btn btn-sm btn-danger btn-delete-conf" data-id="' + e.id + '" data-url="' + e.del + '"><i class="fas fa-trash-alt"></i></a><a class="float-right btn btn-sm btn-success btn-menu-actions btn-menu-edit" data-id="' + e.id + '"><i class="fas fa-pencil-alt"></i></a></div></li>');

					    var result = $(".sortable").nestedSortable().sortable("serialize");
	            		$("#order").val(result);
					},
					error: function(){ 
			        	notify('Ooops!', 'Something went wrong.', 'danger', 'top', 'right');
					}

				});

			}

		});

		$(document).on('click','.btn-update',function() {

			var endpoint = '{{ url(config('hotcoffee.prefix').'/menuitems') }}' + '/' + $(this).data('id');

			var reqlength = $('.input-name').length;
			var value = $('.input-name').filter(function () {
			    return this.value != '';
			});

			if (value.length>=0 && (value.length !== reqlength)) {
					
				@if(count(config('hotcoffee.languages')) > 1)
					alert('{{ __('hotcoffee::admin.err_title_menu_req_lng') }}');
				@else
					alert('{{ __('hotcoffee::admin.err_title_menu_req') }}');
				@endif

			} else {

				var data = $('#item-form').serialize();
				$('#modal-item').modal('hide');

			    $.ajax({
					type: 'POST',
					url: endpoint,
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

					    $('#item-name-' + e.id).html(e.name);
					},
					error: function(){ 
			        	notify('Ooops!', 'Something went wrong.', 'danger', 'top', 'right');
					}

				});

			}

		});

	</script>
@endsection