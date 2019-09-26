@extends('hotcoffee::_layouts._admin')

@section('content')
	<div class="card-body">
		<div class="row">
        <div class="col">
          <div class="card shadow">

            <div class="card-header border-0">
              <div class="row align-items-center">

                <div class="col">
                  <h3 class="mb-0">{{ __('hotcoffee::admin.user_roles') }}</h3>
                </div>

                <div class="col text-right">
                  <a href="{{ route('hotcoffee.admin.roles.create') }}" class="btn btn-primary text-uppercase">
                  	<i class="fas fa-plus-circle"></i> &nbsp; {{ __('hotcoffee::admin.add') }}
                  </a>
                </div>
              </div>

            </div>

            <div class="table-responsive" id="item-table">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Role</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                	@foreach($roles as $role)
						<tr id="tr-{{ $role->id }}">

							<td>
								<a href="{{ route('hotcoffee.admin.roles.edit', $role) }}" @if($role->id == 1) class="text-warning" @endif>
									{{ $role->name }}
								</a>
							</td>

							<td>
								{{ $role->description }}
							</td>

							<td class="text-right">
								<div class="dropdown">
									<a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-edit"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="{{ route('hotcoffee.admin.roles.edit', $role) }}" class="dropdown-item">
											<i class="fas fa-pencil-alt"></i> {{ __('hotcoffee::admin.edit') }}
										</a>
										
										@if($role->id != 1)
											<button class="dropdown-item btn-delete-conf" data-id="{{ $role->id }}" data-url="{{ route('hotcoffee.admin.roles.destroy', $role) }}">
												<i class="fas fa-trash-alt"></i> {{ __('hotcoffee::admin.delete') }}
											</button>
										@endif
									</div>
								</div>
		                    </td>

						</tr>
                	@endforeach

                </tbody>
              </table>
            </div>

			<div class="card-footer py-4">
				{{ $roles->links() }}
			</div>

          </div>
        </div>
      </div>
	</div>

	@include('hotcoffee::admin.modals.delete')
@endsection