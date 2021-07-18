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
                        <li>Email</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="contact">
    <div class="contact-banner">
        <p class="text-center">
        We have sent a Verification Code to your email - Please check your email for this code. Please check all your email folders to include your SPAM folder for this message.
    </p>
    </div>

</section>

</div>
<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="contact-form mt-5">

                <form method="post" action="{{ route('email_otp_submit') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $_GET['token'] }}">
                    <div class="form-group">
                        <input type="number" class="form-control custom-form-control" name="otp" placeholder="Verification Code * " required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info custom-btn-info" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection
