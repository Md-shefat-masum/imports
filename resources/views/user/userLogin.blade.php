@extends('front_end.layouts.master')
@section('title','|User Registration')
@section('content')

<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- customer login start -->
<div class="login_page_bg">
    <div class="container">
        <div class="customer_login">
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form login">
                        @if (Auth::user() != null)
                        <h4 class="login-box-msg" style="padding: 20px;">Log Out Before sign in</h4>
                        @else
                   
                        @if(Session::has('error'))
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                {!! session('error') !!}
                            </div>
                            @endif
                            <h2>Sign in to start your session</h2>
                            <form action="{{url('/user-login')}}" method="post">
                                {{csrf_field()}}
                                <p>
                                    <label>Email <span>*</span></label>
                                    <input type="email" class="form-control" name="email">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </p>
                                <p>
                                    <label>Passwords <span>*</span></label>
                                    <input type="password" class="form-control" name="password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </p>
                                <div class="login_submit checkbox icheck">
                                    <a href="{{ route('password.request') }}" style="padding: 0px 30px 0px 0px">I forgot my password</a>  
                                    <a href="/login-register" class="text-center">Register a new membership</a>
                                    <label for="remember">
                                        <input id="remember" type="checkbox">
                                        Remember me
                                    </label>
                                    <button type="submit">Sign In</button>

                                </div>

                            </form>
                        </div>
                        @endif
                    </div>
                    <!--login area start-->


                </div>
            </div>
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});
    </script>
    @endsection