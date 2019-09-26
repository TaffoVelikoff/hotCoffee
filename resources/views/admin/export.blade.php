@extends('hotcoffee::_layouts._admin')

@section('content')
	<div class="card-body">
		<div class="row">
        
			<div class="col order-xl-1">
				<div class="card bg-secondary shadow">

					<div class="card-body">

						<form action="{{ route('hotcoffee.admin.export.export') }}" method="post">

							{{ csrf_field() }}

							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label" for="input-export">{{ __('hotcoffee::admin.export_what') }}</label>
										<div class="input-group input-group-alternative mb-4">

											<div class="input-group-prepend">
												<span class="input-group-text"><i class="ni ni-box-2"></i></span>
											</div>

											<select id="input-export" class="form-control form-control-alternative no-border-radius" name="export">
												<option value="">-- {{ __('hotcoffee::admin.select_one') }} --</option>
												@foreach(config('hotcoffee.exportables') as $exportable => $values)
													<option value="{{ $exportable }}">{{ __($values['name']) }}</option>
												@endforeach
											</select>

										</div>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col text-center">
									<input type="submit" class="btn btn-success" value="{{ __('hotcoffee::admin.save') }}" />
								</div>
							</div>

						</form>

					</div>

				</div>
			</div>

		</div>
	</div>
@endsection
