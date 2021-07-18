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
        <h3 class="text-center">Enter Your Email Address to Begin : </h3>
    </div>

</section>

</div>
<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="contact-form mt-5">

                <form method="post" action="{{ route('email_otp_send') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" class="form-control custom-form-control" name="email" placeholder="Email * " required>
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
