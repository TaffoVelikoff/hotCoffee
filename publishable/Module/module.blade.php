@extends('hotcoffee::admin._layout')

@section('content')
<div class="container-fluid">
  <div class="row">

    <div class="col order-xl-1">
      <div class="card bg-secondary shadow">
        <div class="card-body">

          <form method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <h6 class="heading-small text-muted mb-4">Module Create/Edit</h6>

            <hr class="my-4"/>

            <!-- SUBMIT BUTTON -->
            <div class="row">
              <div class="col text-center">
                <input type="submit" class="upload-result btn btn-success" value="{{ __('hotcoffee::admin.save') }}">
              </div>
            </div>
            <!-- END SUBMIT BUTTON -->

          </form>

        </div>
      </div>
    </div>
  </div>
      
</div>
@endsection