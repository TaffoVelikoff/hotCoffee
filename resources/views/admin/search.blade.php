@extends('hotcoffee::_layouts._admin')

@section('content')
  <div class="col-xl-12 mb-5 mb-xl-0">
    <div class="card-body">
      <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            @foreach($results as $key=>$res)
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 @if($key == array_key_first($results)) active @endif" id="tabs-icons-text-{{ $key }}-tab" data-toggle="tab" href="#tabs-icons-text-{{ $key }}" role="tab" aria-controls="tabs-icons-text-{{ $key }}" aria-selected="true">
                    {{ __($searchables[$key]['label']) }}
                  </a>
              </li>
            @endforeach
        </ul>
      </div>
      <div class="card shadow">
          <div class="card-body">
              <div class="tab-content">

                  @foreach($results as $key=>$res)<div class="tab-pane fade show @if($key == array_key_first($results)) active @endif" id="tabs-icons-text-{{ $key }}" role="tabpanel" aria-labelledby="tabs-icons-text-{{ $key }}-tab">
                      
                        <div class="table-responsive" id="item-table">
                          <table class="table align-items-center table-flush">
                            
                            <thead class="thead-light">
                              <tr>
                                @foreach($searchables[$key]['index'] as $index)
                                  <th scope="col" @if($index == 'id') style="width: 5%;" @endif>{{ $index }}</th>
                                @endforeach
                                <th scope="col" style="width: 5%;"></th>
                              </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($res as $rs)
                                  <tr>
                                      @foreach($searchables[$key]['index'] as $index)
                                        <td>
                                          {{ field_content_for_search($rs->$index) }}
                                        </td>
                                      @endforeach
                                      <td>
                                        <a href="{{ route($searchables[$key]['route'], $rs->id) }}" class="btn btn-md btn-default">
                                          {{ __('hotcoffee::admin.view') }}
                                        </a>
                                      </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      

                  </div>@endforeach

              </div>
          </div>
      </div>
    </div>
  </div>
@endsection