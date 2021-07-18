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

            @if (session('message'))
                <div class="alert alert-success" id="message">
                    <h2>{{ session('message') }}</h2>
                </div>
            @else
                <div class="alert alert-success">
                    <h2>No Order has been placed yet.</h2>
                </div>
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

</script>
@endsection
