@extends('front_end.layouts.master')
@section('title','|Product')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}">
    <style>

    .contact-banner{
        background:#173b67;
        height:200px;
    }
    .contact-banner h1{
        color:#fff;
        top:33%;
        position:relative;
    }
    .bar{
        height: 4px;
        width: 130px;
        background: #1C4D88;
        display: inline-block;
        color: #1C4D88;
    }
    .custom-form-control{
        border:1px solid #1C4D88;
        border-radius:0px;
    }
    .custom-btn-info{
        background: #1C4D88;
        border-radius: 0px;
        padding: 15px 40px;
        font-weight: 700;
    }
    .contactIcon{
        padding: 0px 8px;
        font-size: 20px;
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
						<li>Contact</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
    <section id="contact">
        <div class="contact-banner">
            <h1 class="text-center">Contact Us</h1>
        </div>

    </section>

    <div class="container-fluid">

        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3058.8551687888175!2d-74.9547577845686!3d39.94462917942278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c1353bae3eb205%3A0xd31e60a0b11c0e51!2s309+Fellowship+Rd+%23200%2C+Mt+Laurel%2C+NJ+08054%2C+USA!5e0!3m2!1sen!2sbd!4v1543872355896" width="100%" height="420" frameborder="0" style="border:0" allowfullscreen></iframe>

        </div>

    </div>

</div>
<div class="container">
    <div class="contact_area">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            @foreach($contact as $data)
            <div class="contact_message content">
                <div class="contact-info mt-5">
                    <h3 style="pading: 0px 0px 20px 0px;">{{$data->title}}</h3>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>


                <ul>
                    <li><i class="fa fa-fax"></i> Address : {{$data->address1}} <br>{{$data->address2}} </li>

                    <li><i class="fa fa-phone"></i> <a href="#">{{$data->email1}} <br>{{$data->email2}} </a></li>
                    <li><i class="fa fa-envelope-o"></i> {{$data->phone1}} <br>{{$data->phone2}}</li>
                    <li><i class="fa fa-globe" aria-hidden="true"></i> {{$data->website1}} <br>{{$data->website2}}</li>
                </ul>
            </div>
            @endforeach
        </div>

        <div class="col-md-6">

            <div class="contact-info mt-5">
                <h3>Send Message</h3>
                <span class="bar"></span>
            </div>

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
                <form method="post" action="{{url('frontEndContact')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control custom-form-control" name="full_name" placeholder="Full Name * " required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control custom-form-control" name="email" placeholder="Your Email *" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control custom-form-control" name="phone" placeholder="Your Phone *" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control custom-form-control" name="message" rows="5" cols="10" placeholder="Message" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdlEmAaAAAAAPsZMkkEkUwLEkkYjC8LKaLE4wDj"
                        data-callback="enableBtn"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit"  id="button1" disabled="disabled" class="btn btn-info custom-btn-info" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
    <script>
        function enableBtn(){
           document.getElementById("button1").disabled = false;
         }
    </script>
@endsection
