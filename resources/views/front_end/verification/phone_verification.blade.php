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
                        <li>Phone</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="contact">
    <div class="contact-banner">
        <h3 class="text-center">Phone</h3>
    </div>

</section>

</div>
<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="contact-form" style="margin-top: 15px;">

                <form method="post" action="{{ route('phone_otp_send') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $_GET['token'] }}">
                    <div class="form-group">
                        @php
                            $country_list = DB::table('phone_code')->select('id', 'nicename', 'phonecode')->get();
                        @endphp
                        <select class="form-control" name="country_name" id="country_name">
                            @foreach ($country_list as $item)
                                <option value="{{ $item->phonecode }}">{{ $item->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">+93</span>
                         </div>
                        <input type="number" class="form-control custom-form-control" name="phone" placeholder="Phone Number * " required>
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#country_name").on("change", "", function (e) {
            var value_type = '+'+$(this).val();
            $('#basic-addon1').html(value_type);
        });
    });
</script>
@endsection
