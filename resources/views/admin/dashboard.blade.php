@extends('hotcoffee::_layouts._admin')

@section('content')
	<div class="card-body">
		<div class="row">
        	<div class="col">
          		<div class="card shadow">
					<div class="card-body">
				
						<div class="row">

							<div class="col-xl-6 col-lg-12">
								<div class="card card-stats mb-4 mb-xl-0">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="card-title text-uppercase text-muted mb-0">{{ __('hotcoffee::admin.registered_users') }}</h5>
												<span class="h2 font-weight-bold mb-0">{{ $userCount }}</span>
											</div>
											<div class="col-auto">
												<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
													<i class="fas fa-users"></i>
												</div>
											</div>
										</div>
										<p class="mt-3 mb-0 text-muted text-sm">
											<span class="text-nowrap">{{ __('hotcoffee::admin.registered_users_nfo') }}</span>
										</p>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-12">
								<div class="card card-stats mb-4 mb-xl-0">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="card-title text-uppercase text-muted mb-0">{{ __('hotcoffee::admin.latest_user') }}</h5>
												<span class="h2 font-weight-bold mb-0">
													<a href="{{ route('hotcoffee.admin.users.edit', $latestUser) }}">{{ $latestUser->email }}</a>
												</span>
											</div>
											<div class="col-auto">
												<div class="icon icon-shape bg-success text-white rounded-circle shadow">
													<i class="fas fa-user"></i>
												</div>
											</div>
										</div>
										<p class="mt-3 mb-0 text-muted text-sm">
											<span class="text-nowrap">{{ __('hotcoffee::admin.latest_user') }}</span>
										</p>
									</div>
								</div>
							</div>

						</div>

						<div class="row mt-2">
							<div class="col-xl-6 col-lg-12">
								<div class="card card-stats mb-4 mb-xl-0">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="card-title text-uppercase text-muted mb-0">{{ __('hotcoffee::admin.timezone') }}</h5>
												<span class="h2 font-weight-bold mb-0">
													<a href="{{ route('hotcoffee.admin.settings.index') }}">{{ settings('timezone') }}</a>
												</span>
											</div>
											<div class="col-auto">
												<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
													<i class="fas fa-clock"></i>
												</div>
											</div>
										</div>
										<p class="mt-3 mb-0 text-muted text-sm">
											<span class="text-nowrap">{{ __('hotcoffee::admin.timezone_nfo') }}</span>
										</p>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-12">
								<div class="card card-stats mb-4 mb-xl-0">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="card-title text-uppercase text-muted mb-0">{{ $hotcoffee['name'] }}</h5>
												<span class="h2 font-weight-bold mb-0">
													{{ __('hotcoffee::admin.version') }} {{ $hotcoffee['version'] }}
												</span>
											</div>
											<div class="col-auto">
												<div class="icon icon-shape bg-info text-white rounded-circle shadow">
													<i class="fas fa-coffee"></i>
												</div>
											</div>
										</div>
										<p class="mt-3 mb-0 text-muted text-sm">
											<span class="text-nowrap"><a href="{{ $hotcoffee['url'] }}" target="_blank">{{ $hotcoffee['url'] }}</a></span>
										</p>
									</div>
								</div>
							</div>

						</div>

						@if(config('hotcoffee.auth_log') == true)
							<div class="row mt-3">
								<div class="col-xl-12">
									<div class="card shadow">
										<div class="card-header border-0">
											<div class="row align-items-center">
												<div class="col">
													<h3 class="mb-0">{{ __('hotcoffee::admin.login_log') }}</h3>
												</div>
												<div class="col text-right">
													<a href="{{ route('hotcoffee.admin.clearauth') }}" class="btn btn-danger btn-sm" onclick="confirm('{{ __('hotcoffee::admin.clear_auth_sure') }}')">
														{{ __('hotcoffee::admin.clear_history') }}
													</a>
												</div>
											</div>
										</div>
							
										<div class="table-responsive">
											<!-- Projects table -->
											<table class="table align-items-center table-flush">
												<thead class="thead-light">
													<tr>
														<th scope="col">{{ __('hotcoffee::admin.date') }}</th>
														<th scope="col">{{ __('hotcoffee::admin.time') }}</th>
														<th scope="col">{{ __('hotcoffee::admin.name') }}</th>
														<th scope="col">{{ __('hotcoffee::admin.email') }}</th>
														<th scope="col">IP</th>
													</tr>
												</thead>
												
												<tbody>
													@forelse ($authHistory as $auth)
														<tr>
															<th scope="row">
																{{ $auth->created_at->timezone(settings('timezone'))->format(settings('date_format')) }}
															</th>
															<td>
																{{ $auth->created_at->timezone(settings('timezone'))->format('H:i:s') }}
															</td>
															<td>
																{{ $auth->user->name }}
															</td>
															<td>
																{{ $auth->user->email }}
															</td>
															<td>
																{{ $auth->ip }}
															</td>
														</tr>
													@empty
														<tr>
															<td colspan="5">
																{{ __('hotcoffee::admin.no_nfo_yet') }}
															</td>
														</tr>
													@endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
