@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
<style media="screen">
    #messageSuccess {
        display: none;
    }
</style>
@endsection
@section('content')
<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="alert alert-success" id="messageSuccess">
                <h2> Thank you. You will be required to respond to a text message or E-Mail to complete this payment.
                </h2>
            </div>
        </div>

        @if (session('message'))
        <div class="col-lg-12 col-md-6">
            <div class="alert alert-success" id="message">
                <h2>{{ session('message') }}</h2>
            </div>
        </div>
        @else
        <div class="col-lg-12 col-md-6">
            <div class="alert alert-success">
                <h2>No Order has been placed yet.</h2>
            </div>
        </div>
        @endif
        @if (session('url'))
        <iframe id="iframe" src="{{ session('url') }}" width="100%" height="660" frameBorder="0"></iframe>
        @endif

        <div class="col-12 text-center">
            <a href="/product" class="btn btn-primary">Continue</a>
            <a href="/" class="btn btn-primary">Dismis</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $("#message").hide();
            $("#iframe").hide();
        }, 15000);
        setTimeout(function(){
            $("#messageSuccess").show();
        }, 15000);

        //var test = document.getElementById('iframe').contentWindow.document.write('content');
        //console.log(test);
    });
</script>
@endsection