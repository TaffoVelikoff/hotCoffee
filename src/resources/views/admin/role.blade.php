@extends('hotcoffee::_layouts._admin')

@section('content')

	<div class="card-body">
		<div class="row">
        
	        <div class="col order-xl-1">
	          	<div class="card bg-secondary shadow">

		            <div class="card-body">

						<form @if(isset($edit)) action="{{ route('hotcoffee.admin.roles.edit', $edit) }}" @else action="{{ route('hotcoffee.admin.roles.store') }}" @endif method="post">

							{{ csrf_field() }}

							<h6 class="heading-small text-muted mb-4">{{ __('hotcoffee::admin.role_info') }}</h6>

							<div class="pl-lg-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="input-name">{{ __('hotcoffee::admin.name') }}</label>
											<div @if($errors->has('name')) class="has-danger" @endif>
												<input type="text" id="input-name" class="form-control form-control-alternative @if($errors->has('name')) is-invalid-alt @endif" placeholder="role_name" @if(session('post')) value="{{ session('post.name') }}" @elseif(isset($edit)) value="{{ $edit->name }}" @endif name="name" required="" @if(isset($edit)) readonly="" @endif>
											</div>
										</div>
									</div>
							
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="input-description"> {{ __('hotcoffee::admin.description') }} </label>
											<div @if($errors->has('description')) class="has-danger" @endif>
												<input type="text" id="input-description" class="form-control form-control-alternative @if($errors->has('description')) is-invalid-alt @endif" placeholder="{{ __('hotcoffee::admin.short_sweet') }}" @if(session('post')) value="{{ session('post.description') }}" @elseif(isset($edit)) value="{{ $edit->description }}" @endif name="description" required="">
											</div>
										</div>
									</div>
								</div>

								<hr/>

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
@endsection