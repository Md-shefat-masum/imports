@extends('front_end.layouts.master')
@section('title','|Product')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}">
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
@endsection
@section('content')
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<ul>
						<li><a href="/">home</a></li>
						<li>SMS</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
    <section id="contact">
        <div class="contact-banner">
            <h1 class="text-center">SMS</h1>
        </div>

    </section>

</div>
<div class="container">
    <div class="contact_area">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="contact-form mt-5">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" style="width: 100%;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{-- <h4><i class="icon fa fa-check"></i> Alert!</h4> --}}
                        THANK YOU FOR CONTACTING US -  A FWI VPOS WILL CONTACT YOU WITHIN  ONE (1) BUSINESS DAY.
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-success alert-dismissible" style="width: 100%;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{-- <h4><i class="icon fa fa-check"></i> Alert!</h4> --}}
                        {{ Session::get('error') }}
                    </div>
                @endif
                <form method="post" action="{{ route('sms_test') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="number" class="form-control custom-form-control" name="phone" placeholder="Phone Number * " required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info custom-btn-info" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')

@endsection
