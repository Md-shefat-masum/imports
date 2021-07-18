@extends('front_end.layouts.master')
@section('title','|User Registration')
@section('content')

<body class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center" style="margin-top: 50px;">
                    <h2  style="background: #1C4D88;padding: 10px;color: #ffffff;border-radius: 5px;text-transform: uppercase;">BECOME A FWI ONLINE ENTREPRENEUR</h2>
                </div>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item "> Manage all of your account settings</li>
                    <li class="list-group-item"> Check your messages from Trading Partners</li>
                    <li class="list-group-item">Upload new products and manage your Listings</li>
                    <li class="list-group-item">Add suppliers and products to your Favorites List</li>
                    <li class="list-group-item">Create product alerts customized to your request</li>
                    <li class="list-group-item">Update your Profile</li>
                    <li class="list-group-item">Customize your email preferences</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="login-box" style="width: 100%;margin:0;">

                    <!-- /.login-logo -->
                    <div class="login-box-body">
                        <p class="login-box-msg">Entrepreneurs Registration Form</p>
                            @if(Session::has('error'))
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                    {!! session('error') !!}
                                </div>
                            @endif
                            @if(Session::has('email-exists'))
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                    {!! session('email-exists') !!}
                                </div>
                            @endif
                            
                            @if (isset(Auth::user()->id))
                                <h4 class="login-box-msg" style="padding: 20px;text-align: center;">Please Logout Before Sign in</h4>
                            @else
                                <form method="POST" action="{{ route('entrepreneursPost') }}">
                                    @csrf
                                    <div class="row">
                                      @if (isset($_GET["ref"]))
                                        <input type="hidden" name="reference" value="{{ $_GET["ref"] }}">
                                      @endif

                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <label for="first_name">Full Name</label>
                                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                                @if ($errors->has('first_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            </div>
                                            <input type="hidden" name="last_name" value="">
                                            <div class="form-group has-feedback">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Session::get('email') }}" disabled required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <label for="password">Password</label>
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="password-confirm">Confirm Password</label>
                                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <label for="cell_phone">Phone Number</label>
                                                <input id="cell_phone" type="text" class="form-control{{ $errors->has('cell_phone') ? ' is-invalid' : '' }}" name="cell_phone" value="{{ Session::get('phone') }}" disabled required>

                                                @if ($errors->has('cell_phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('cell_phone') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <input type="hidden" name="home_phone" value="">
                                            <input type="hidden" name="dop" value="">
                                            <input type="hidden" name="apts" value="">
                                            <input type="hidden" name="zip_code" value="">
                                            <input type="hidden" name="city" value="">
                                            <input type="hidden" name="group_id" value="5">
                                            <input type="hidden" name="user_type" value="Entrepreneur">
                                            <div class="form-group has-feedback">
                                                <label for="country">Country</label>
                                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}" name="states" value="{{ old('states') }}" required> --}}
                                                <select class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" id="country" required>
                                                    <option>-- Select Country --</option>
                                                    @php
                                                    $countries = DB::table('countries')->select('id', 'name')->get();
                                                    @endphp
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('country') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <label for="states">States</label>
                                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}" name="states" value="{{ old('states') }}" required> --}}
                                                <select class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}" name="states" id="states" required>
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
                                                <label for="address">Street Address</label>
                                                <textarea name="address" id="address" cols="30" rows="5" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" required>{{ old('address') }}</textarea>


                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>

                                            <div class="col-xs-8">
                                                <div class="checkbox icheck">
                                                    <label>
                                                        <input type="checkbox" required> I agree to the <a href="{{ url('/terms') }}" style="color:#1664c1;">terms & Condition</a> <br>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.col -->

                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="6LdlEmAaAAAAAPsZMkkEkUwLEkkYjC8LKaLE4wDj"
                                                data-callback="enableBtn"></div>
                                            </div>
                                            <div class="col-xs-4">
                                                <button type="submit" id="button1" disabled="disabled" class="btn btn-primary">Register</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <div class="col-md-12">

                                        </div>
                                    </div>

                                    <div class="row">

                                    </div>
                                </form>
                            @endif


                            <!--
                            <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group row">
<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

@if ($errors->has('password'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group row">
<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

<div class="col-md-6">
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
</div>
</div>

<div class="form-group row mb-0">
<div class="col-md-6 offset-md-4">
<button type="submit" class="btn btn-primary">
{{ __('Register') }}
</button>
</div>
</div>
</form>
-->
<!-- /.social-auth-links -->




</div>
<!-- /.login-box-body -->

</div>
<!-- /.login-box -->
</div>
</div>

</div>
<script>
    function enableBtn(){
       document.getElementById("button1").disabled = false;
     }
</script>

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
@endsection
