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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
    <div class="login-box" style="width: 90%;">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <h2 class="text-center">Update Profile</h2>
            <hr>
        @if(Session::has('error'))

            <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        {!! session('error') !!}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('update-profile') }}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group has-feedback">
                                    <label for="home_phone">Alternative Phone</label>
                                    <input id="home_phone" type="number" class="form-control{{ $errors->has('home_phone') ? ' is-invalid' : '' }}" name="home_phone" value="{{ $details->home_phone }}" required>

                                    @if ($errors->has('home_phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('home_phone') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="dop">Date of Birth</label>
                                    <input id="dop" type="date" class="form-control{{ $errors->has('dop') ? ' is-invalid' : '' }}" name="dop" value="{{ $details->dop }}" required>

                                    @if ($errors->has('dop'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dop') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $details->first_name }}" required>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $details->last_name }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="street_address">Street Address</label>
                                    <textarea name="address" id="street_address" cols="30" rows="5" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" required>{{ $details->address }}</textarea>


                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group has-feedback">
                                    <label for="apt">Apt/Suite</label>
                                    <input id="apt" type="text" class="form-control{{ $errors->has('apts') ? ' is-invalid' : '' }}" name="apts" value="{{ $details->apts }}">

                                    @if ($errors->has('apts'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apts') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="city">City</label>
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $details->city }}" required>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="states">States</label>
                                    <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}" name="states" value="{{ $details->states }}" required>

                                    @if ($errors->has('states'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('states') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="zip_code">Zip Code</label>
                                    <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code" value="{{ $details->zip_code }}" required>

                                    @if ($errors->has('zip_code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                    @endif
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>

                            </div>
                        </div>





                        <div class="row">
                            <div class="col-xs-4 offset-md-11">
                                <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Update</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-box-body -->

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
