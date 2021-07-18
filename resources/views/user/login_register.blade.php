@extends('front_end.layouts.master')
@section('title','|User Registration')
@section('content')

<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">


<!-- Google Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<body class="hold-transition login-page" style="background: #fff;">
    <div class="login-box" style="width: 90%;">

        <!-- /.login-logo -->
        <div class="login-box-body" style="background: #f5f5f9;">
            @auth
            <h4 class="login-box-msg" style="padding: 20px;">Please Logout Before Registration</h4>
            @endauth
            @guest
            <h2 class="text-center">FreeWorldImports Member Registration</h2>
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
                <form method="POST" action="{{ route('user_register') }}">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $_GET['token'] }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label for="">Cell Phone</label>
                                <input id="name" type="number"
                                    class="form-control{{ $errors->has('cell_phone') ? ' is-invalid' : '' }}"
                                    name="cell_phone" value="{{ Session::get('phone') }}" required disabled>

                                @if ($errors->has('cell_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cell_phone') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="home_phone">Alternate Phone</label>
                                <input id="home_phone" type="number"
                                    class="form-control{{ $errors->has('home_phone') ? ' is-invalid' : '' }}"
                                    name="home_phone" value="{{ old('home_phone') }}" required>

                                @if ($errors->has('home_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_phone') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>


                            <div class="form-group has-feedback">
                                <label for="email">Email</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ Session::get('email') }}" disabled required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text"
                                    class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                    name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text"
                                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                    name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="dop">Date of Birth</label>
                                <input id="dop" type="date"
                                    class="form-control{{ $errors->has('dop') ? ' is-invalid' : '' }}" name="dop"
                                    value="{{ old('dop') }}" required>

                                @if ($errors->has('dop'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dop') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="street_address">Street Address</label>
                                <textarea name="address" id="street_address" cols="30" rows="5"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    required>{{ old('dop') }}</textarea>
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
                                <input id="apt" type="text"
                                    class="form-control{{ $errors->has('apts') ? ' is-invalid' : '' }}" name="apts"
                                    value="{{ old('apts') }}" required>

                                @if ($errors->has('apts'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apts') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="city">City</label>
                                <input id="city" type="text"
                                    class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
                                    value="{{ old('city') }}" required>

                                @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="country">Country</label>
                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}"
                                name="states" value="{{ old('states') }}" required> --}}
                                <select class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}"
                                    name="country" id="country" required>
                                    <option>-- Select Country --</option>
                                    @php
                                    $countries = DB::table('countries')->select('id', 'name')->get();
                                    @endphp
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('states'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('states') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="states">States</label>
                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}"
                                name="states" value="{{ old('states') }}" required> --}}
                                <select class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}"
                                    name="states" id="states" required>
                                    <option>-- Select State --</option>
                                </select>
                                @if ($errors->has('states'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('states') }}</strong>
                                </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>


                            <div class="form-group has-feedback">
                                <label for="zip_code">Zip Code</label>
                                <input id="zip_code" type="text"
                                    class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                    name="zip_code" value="{{ old('zip_code') }}" required>

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
                        <div class="col-md-4 col-xs-12" style="padding-top: 35px;">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" required> I agree to the <a href="{{url('/terms')}}"
                                        style="color: #007bff;">Terms & Conditions</a> <br>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LdlEmAaAAAAAPsZMkkEkUwLEkkYjC8LKaLE4wDj"
                                data-callback="enableBtn"></div>
                            </div>
                            <button type="submit" id="button1" disabled="disabled" class="btn btn-primary">Register</button>
                        </div>
                        <div class="col-md-4">
                            <p style="padding-top: 30px;font-weight: bold" ;>
                                <a href="https://vrdusa.com/gcardsignup.php" target="_blank">
                                    Apply for a Genie Platinum Card and a Checking Account to simplify your shopping
                                    experience with FreeWorldImports
                                </a>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <a href="https://vrdusa.com/gcardsignup.php" target="_blank">
                                <img style="width: 40%" src="https://vrdusa.com/img/try_genie_card.jpg" alt="IMAGE">
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            @endguest
        </div>
    </div>
</body>

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
$(document).ready(function () {
        $("#country").change( function () {
            var classId = $(this).val();
            $.ajax({
                type:'POST',
                url:'/statesName',
                data: {
                    id : classId,
                    _token: "{{ csrf_token() }}",
                },
                datatype: 'html',
                success:function(response){
                    //console.log(response);
                    $('#states').html(response);
                }
            });

        } );
    });
</script>
<script>
    function enableBtn(){
       document.getElementById("button1").disabled = false;
     }
</script>
@endsection
