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
                        <form method="POST" action="{{ route('supplierRegister') }}" style="text-align: left;">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <input type="hidden" name="email" value="{{ session()->get('email-verified') }}">
                                        <label for="">Full Name</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="email">Email</label>
                                        <input class="form-control" value="{{ Session::get('email') }}" disabled required>

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
                                        <label for="">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="phone">Phone Number</label>
                                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Session::get('phone') }}" disabled>

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="country">Country</label>
                                        {{-- <input id="states" type="text" class="form-control{{ $errors->has('states') ? ' is-invalid' : '' }}" name="states" value="{{ old('states') }}" required> --}}
                                        <select class="form-control {{ $errors->has('states') ? ' is-invalid' : '' }}" name="country" id="country" required>
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
                                        <label for="street_address">Street Address</label>
                                        <textarea name="address" id="street_address" cols="30" rows="5" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" required>{{ old('dop') }}</textarea>


                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" required> I agree to the <a href="{{ route('frontTerms') }}">Terms & Conditions </a> <br>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LdlEmAaAAAAAPsZMkkEkUwLEkkYjC8LKaLE4wDj"
                                        data-callback="enableBtn"></div>
                                    </div>
                                    <button type="submit" id="button1" disabled="disabled" class="btn btn-primary">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script>
function enableBtn(){
   document.getElementById("button1").disabled = false;
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
@endsection
