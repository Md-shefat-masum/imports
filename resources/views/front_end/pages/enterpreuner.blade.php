@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('front_end/css/about.css')}}">
    <style>
    .how-img img{
        height: 200px;
        width: 200px;
        border-radius: 50%;
    }
    .supplier-login{
        border: 3px solid #ddd;
        padding: 25px;
    }
    .enterpreuner-list ul, .enterpreuner-list ol {
        margin-left: 25px;
    }
    .enterpreuner-list {
        font-family: 'Lato', sans-serif !important;
    }
</style>
@endsection
@section('content')
    <br><br>

    <div class="container">
        <h3 class="text-center" style="background: #1C4D88;padding: 10px;color: #ffffff;border-radius: 5px;text-transform: uppercase;">BECOME A FREEWORLDIMPORTS AFFILIATE</h3>
        <br><br>
        <div class="row">
            @php
                $enterpriner = DB::table('enter_com_forums')->get();
            @endphp
            <div class="col-md-6">
                <ul class="list-group enterpreuner-list">
                    @foreach ($enterpriner as $value)
                        <li class="list-group-item "> {!! $value->enterpreuner_item !!}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <div class="supplier-login">
                    @if(Session::has('error'))
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! session('error') !!}
                        </div>
                    @endif
                    @if(Session::has('success'))
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! session('success') !!}
                        </div>
                    @endif
                    @auth
                        <h4 class="login-box-msg" style="padding: 20px;text-align: center;">Please Logout Before Sign in</h4>
                    @endauth
                    @guest
                        <form action="{{ route('enterpreunerLogin') }}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign In</button> <span>Or</span>  <a href="{{url('/entrepreneur/register')}}" class="text-info">Register</a>
                        </form>
                        <a href="{{ route('password.request') }}" style="margin-top: 8px;display: inline-block;">I forgot my password</a><br>
                        <a href="#" style="margin-top: 8px;display: inline-block;">Resend Email Verification </a>
                    @endguest

                </div>
            </div>
        </div>
    </div>
@endsection
