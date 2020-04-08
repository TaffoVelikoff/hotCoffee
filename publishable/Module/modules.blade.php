@extends('hotcoffee::admin._layout')

@section('content')
    <div class="card-body">
        <div class="row">
        <div class="col">
          <div class="card shadow">

            <div class="card-header border-0">
              <div class="row align-items-center">

                <div class="col">
                  <h3 class="mb-0">Module Name</h3>
                </div>

                <div class="col text-right">
                  <a href="" class="btn btn-primary text-uppercase">
                    <i class="fas fa-plus-circle"></i> &nbsp; {{ __('hotcoffee::admin.create') }}
                  </a>
                </div>
              </div>

            </div>

            <div class="table-responsive" id="item-table">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                    {{--@foreach($modules as $info)
                            <tr id="tr-{{ $info->id }}">

                                <td>
                                    <a href="{{ route('route.name', $info) }}">{{ $info->title }}</a>
                                </td>

                                <td>
                                    {{ $info->key }}
                                </td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a href="{{ route('route.name', $info) }}" class="dropdown-item">
                                                <i class="fas fa-pencil-alt"></i> {{ __('hotcoffee::admin.edit') }}
                                            </a>
                                            
                                            <button class="dropdown-item btn-delete-conf" data-id="{{ $info->id }}" data-url="{{ route('route.name', $info) }}">
                                                <i class="fas fa-trash-alt"></i> {{ __('hotcoffee::admin.delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                    @endforeach--}}

                </tbody>
              </table>
            </div>

                <div class="card-footer py-4">
                    {{-- $infos->links() --}}
                </div>

          </div>
        </div>
      </div>
    </div>

    @include('hotcoffee::admin.modals.delete')

@endsection