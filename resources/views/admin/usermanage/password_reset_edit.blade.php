@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <form onsubmit="return confirm('Are you sure you want to submit?')"
            action="{{ route('passwordResetUpdate', $item->id) }}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Password Reset</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">
                            <a href="{{url('/password-reset')}}" class="btn"><i class="fa fa-reply"
                                    aria-hidden="true"></i>
                                Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <script>
                        swal({
							  title: "Successfully!",
							  text: "Updated Information.",
							  timer: 5000,
							  icon: "success",
						  });
  
                    </script>
                    @endif
                    @if(Session::has('error'))
                    <script>
                        swal({
							  title: "Opps!",
							  text: "Updated Failed.",
							  timer: 5000,
							  icon: "warning",
						  });
  
                    </script>
                    @endif



                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" value="" name="password" placeholder="password" class="form-control"
                                id="password">
                        </div>
                    </div>
                   

                </div>

            </div>
            <div class="card-footer header-part text-center">
                <button type="submit" class="btn btn-info">Submit</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            </div>
    </div>
    </form>
</div>

@section('scripts') @endsection
@endsection