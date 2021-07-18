@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('front_end/css/about.css')}}">
    <style>
    .nav-tabs .nav-link.active {
        font-weight:bold;
        background-color: transparent;
        border-bottom:3px solid #dd0000;
        border-right: none;
        border-left: none;
        border-top: none;
    }

</style>
@endsection
@section('content')
    <br><br>
    <section class=" ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center ">
                    <nav class="nav-justified ">
                        <div class="nav nav-tabs link_active" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link {{ ( session()->has('info') || session()->has('complete') || session()->has('email-verified') || session()->has('registration-complete') ) ? '' : 'active' }}" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">1. EMAIL VERIFICATION</a>
                            <a class="nav-item nav-link {{ ( session()->has('info') || session()->has('email-verified') ) ? 'active' : '' }}" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">2. PROVIDE SUPPLIER INFORMATION</a>
                            <a class="nav-item nav-link {{ session()->has('registration-complete')? 'active' : ''  }}" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">✔ COMPLETE REGISTRATION</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show {{ ( session()->has('info') || session()->has('complete') || session()->has('email-verified') || session()->has('registration-complete') ) ? '' : 'active' }}" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
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
                                                <label for="inputPassword" class="col-sm-4 col-form-label">Verification Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" class="form-control" id="inputPassword" placeholder="Verification Email">
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                List your products/merchandise within our marketplace
                                            </p>
                                            <br>
                                            <input type="submit" class="btn btn-success" value="Send"/>
                                        </form>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show {{ ( session()->has('info') || session()->has('email-verified') ) ? 'active' : '' }}" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                            @if (session()->has('email-verified'))
                            <div class="pt-3"></div>
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
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
                                                    <input class="form-control" value="{{ session()->get('email-verified') }}" disabled>

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
                                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

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
                                                        <input type="checkbox" required> I agree to the <a href="{{ url('/terms') }}">terms & condition</a> <br>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                                <div class="alert alert-warning" style="text-algin: center;">
                                    Please verified your email address before giving information
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade show {{ session()->has('registration-complete')? 'active' : ''  }}" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                            <div class="pt-3"></div>
                            @if (session()->has('registration-complete'))
                                <div class="alert alert-success">
                                    Congratulations you are successfully registered .
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    Please verified your email address and give information first.
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
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

            } );
        });
    </script>
</script>
@endsection
