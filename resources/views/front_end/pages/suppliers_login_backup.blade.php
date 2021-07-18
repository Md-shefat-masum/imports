@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
<link rel="stylesheet" href="{{asset('front_end/css/about.css')}}">
<style>
    .how-img img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
    }

    .supplier-login {
        border: 3px solid #ddd;
        padding: 25px;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        background-color: transparent;
        border-bottom: 3px solid #dd0000;
        border-right: none;
        border-left: none;
        border-top: none;
    }

    .enterpreuner-list ul,
    .enterpreuner-list ol {
        margin-left: 50px;
    }

    .enterpreuner-list {
        font-family: 'Lato', sans-serif !important;
    }
</style>
@endsection
@section('content')
<br><br>

<div class="container">
    <h3 class="text-center" style="background: #1C4D88;padding: 10px;color: #ffffff;border-radius: 5px;">SUPPLIER
        REGISTRATION SECTION</h3>
    <br><br>
    <div class="row">
        @php
        $supplier = DB::table('sub_com_forums')->get();
        @endphp
        <div class="col-md-6">
            <ul class="list-group enterpreuner-list">
                @foreach ($supplier as $value)
                <li class="list-group-item "> {!! $value->suppliers_item !!}</li>
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
                    @auth
                    <h4 class="login-box-msg" style="padding: 20px;">Please Logout Before Sign in</h4>
                    @endauth
                    @guest
                    <form action="{{ route('suppliersLogin') }}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </form>
                    <a href="{{ route('password.request') }}" style="margin-top: 8px;display: inline-block;">I forgot my
                        password</a><br>
                    <a href="#" style="margin-top: 8px;display: inline-block;">Resend Email Verification</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <section class=" " id="log_request_to_email">
        <div class="container">
            <h3 class="text-center"
                style="background: #1C4D88;padding: 10px;color: #ffffff;border-radius: 5px;text-transform: uppercase;">
                SUPPLIER REGISTRATION</h3>
            <br><br>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @auth
            <h4 class="login-box-msg" style="padding: 20px;text-align: center;">Please Logout Before Sign in</h4>
            @endauth
            @guest
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="nav nav-tabs link_active  text-center" role="tablist">
                                <a class="nav-item nav-link {{ ( session()->has('info') || session()->has('complete') || session()->has('email-verified') || session()->has('registration-complete') ) ? '' : 'active' }}"
                                    id="pop1-tab" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">1. EMAIL VERIFICATION</a>
                                <a class="nav-item nav-link {{ ( session()->has('info') || session()->has('email-verified') ) ? 'active' : '' }}"
                                    id="pop2-tab" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">2. PROVIDE SUPPLIER
                                    INFORMATION</a>
                                <a class="nav-item nav-link {{ session()->has('registration-complete')? 'active' : ''  }}"
                                    id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3"
                                    aria-selected="false">✔ COMPLETE REGISTRATION</a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="tab-pane  {{ ( session()->has('info') || session()->has('complete') || session()->has('email-verified') || session()->has('registration-complete') ) ? '' : 'active' }}"
                                        id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                                        <div class="pt-3"></div>
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <p>
                                                    <form action="{{ route('sendEmail') }}" method="post">
                                                        @if(session('email-exists'))
                                                        <p class="alert alert-danger text-center">
                                                            Your email address already exists
                                                        </p>
                                                        @endif
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="inputPassword"
                                                                class="col-sm-4 col-form-label">Enter Email
                                                                Address</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" name="email" class="form-control"
                                                                    id="inputPassword" placeholder="Verification Email">
                                                            </div>
                                                        </div>
                                                        <p class="text-center">
                                                            Please enter your email address to begin the Supplier
                                                            Registration process.
                                                        </p>
                                                        <br>
                                                        <input type="submit" class="btn btn-success" value="Send" />
                                                    </form>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="tab-pane fade show {{ ( session()->has('info') || session()->has('email-verified') ) ? 'active' : '' }}"
                                        id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                                        @if (session()->has('email-verified'))
                                        <div class="pt-3"></div>
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <form method="POST" action="{{ route('supplierRegister') }}"
                                                    style="text-align: left;">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <input type="hidden" name="email"
                                                                    value="{{ session()->get('email-verified') }}">
                                                                <label for="">First Name</label>
                                                                <input id="first_name" type="text"
                                                                    class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                                    name="first_name" value="{{ old('first_name') }}"
                                                                    required autofocus>

                                                                @if ($errors->has('first_name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="">Last Name</label>
                                                                <input id="last_name" type="text"
                                                                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                                    name="last_name" value="{{ old('last_name') }}"
                                                                    required autofocus>

                                                                @if ($errors->has('last_name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="email">Email</label>
                                                                <input class="form-control"
                                                                    value="{{ session()->get('email-verified') }}"
                                                                    disabled required>

                                                                @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
                                                                <span
                                                                    class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label for="">Confirm Password</label>
                                                                <input id="password-confirm" type="password"
                                                                    class="form-control" name="password_confirmation"
                                                                    required>
                                                                <span
                                                                    class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label for="phone">Phone Number</label>
                                                                <input id="phone" type="text"
                                                                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                                    name="phone" value="{{ old('phone') }}" required>

                                                                @if ($errors->has('phone'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="country">Country</label>
                                                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}"
                                                                name="states" value="{{ old('states') }}" required> --}}
                                                                <select
                                                                    class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}"
                                                                    name="country" id="country" required>
                                                                    <option>-- Select Country --</option>
                                                                    @php
                                                                    $countries = DB::table('countries')->select('id',
                                                                    'name')->get();
                                                                    @endphp
                                                                    @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('country'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('country') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="">City</label>
                                                                <input id="city" type="text"
                                                                    class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                                    name="city" value="{{ old('city') }}" required
                                                                    autofocus>

                                                                @if ($errors->has('city'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('city') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>


                                                            <div class="form-group has-feedback">
                                                                <label for="states">States</label>
                                                                {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}"
                                                                name="states" value="{{ old('states') }}" required> --}}
                                                                <select
                                                                    class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}"
                                                                    name="states" id="states" required>
                                                                    <option>-- Select State --</option>
                                                                </select>
                                                                @if ($errors->has('states'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('states') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="">Postal Code</label>
                                                                <input id="zip_code" type="text"
                                                                    class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                                                    name="zip_code" value="{{ old('zip_code') }}"
                                                                    required autofocus>

                                                                @if ($errors->has('zip_code'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>


                                                            <div class="form-group has-feedback">
                                                                <label for="">Address 1</label>
                                                                <input id="address_1" type="text"
                                                                    class="form-control{{ $errors->has('address_1') ? ' is-invalid' : '' }}"
                                                                    name="address_1" value="{{ old('address_1') }}"
                                                                    required autofocus>

                                                                @if ($errors->has('address_1'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('address_1') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label for="">Address 2</label>
                                                                <input id="address_2" type="text"
                                                                    class="form-control{{ $errors->has('address_2') ? ' is-invalid' : '' }}"
                                                                    name="address_2" value="{{ old('address_2') }}"
                                                                    required autofocus>

                                                                @if ($errors->has('address_2'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('address_2') }}</strong>
                                                                </span>
                                                                @endif
                                                                <span
                                                                    class="glyphicon glyphicon-user form-control-feedback"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="checkbox icheck">
                                                                <label>
                                                                    <input type="checkbox" required> I agree to the <a
                                                                        href="{{ route('frontTerms') }}">Terms &
                                                                        Conditions </a> <br>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-6">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block btn-flat">Register</button>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <br>
                                        <div class="alert alert-warning" style="text-algin: center;">
                                            A verification email will be sent to your inbox, please follow the
                                            instructions provided within this email.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="tab-pane fade show {{ session()->has('registration-complete')? 'active' : ''  }}" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                                        <div class="pt-3"></div>
                                        @if (session()->has('registration-complete'))
                                            <div class="alert alert-success">
                                                Congratulations you are successfully registered .
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                Registration is complete per verification email instructions
                                            </div>
                                        @endif
                                    </div>
                                </div>
                              </div>

                        </div>

                    </div>


                </div>
            </div>
            @endguest
        </div>
    </section>
    @endsection

    @if (session()->has('info'))

    <div class="confirmation_modal">
        <div class="body">
            <div class="confirm_close">x</div>
            <h2><i class="fa fa-envelope"></i>Check your email.</h2>
            <p>
                We sent an email to <strong> {{Session::get('user_new_email')}}</strong> with a link to confirm your
                email address. Follw the link to
                continue creating your account.
            </p>
            <div style="width: 20%; height: 2px;background: aqua;margin: 30px 0px;"></div>
            Didn't receive an email? <a href="{{route('resendEmail')}}" style="color: aqua">Resend</a><br>
            Or, <a class="text-info" id="use_another_mail" href="#log_request_to_email">use a different email
                address</a> <br>
            You can close this window if you're done.
        </div>
    </div>

    @push('customjs')
    <script>
        $('#myModal').modal('show');
    </script>
    @endpush

    @endif

    @section('scripts')

    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });

            $('.link_active a').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

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

            });
            $('.confirm_close').on('click',function(){
                $('.confirmation_modal').hide();
            });
            $('#use_another_mail').on('click',function(){
                $('.confirmation_modal').hide();
            });
        });

    </script>

    <style>
        .confirmation_modal {
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, .4);
            position: fixed;
            top: 0%;
            left: 0%;
            z-index: 9;
            font-family: sans-serif;
        }

        .confirmation_modal .body .confirm_close {
            position: absolute;
            right: 30px;
            top: 30px;
            cursor: pointer;
        }

        .confirmation_modal .body {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 500px;
            width: 500px;
            border: 1px solid gray;
            border-radius: 5px;
            background: white;
            z-index: 9;
            padding: 45px;
        }

        .confirmation_modal .body h2 i {
            color: aqua;
            display: inline-block;
            padding-right: 10px;
        }

        .confirmation_modal .body h2 {
            font-family: 'roboto', sans-serif;
            font-size: 22px;
            padding-bottom: 30px;
        }

        .confirmation_modal .body p,
        .confirmation_modal .body a {
            font-family: sans-serif;
        }
    </style>
    @endsection
