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
                        Or
                        <a href="{{ route('suppliers_register') }}" class="text-info">Register</a>
                    </form>
                    <a href="{{ route('password.request') }}" style="margin-top: 8px;display: inline-block;">I forgot my
                        password</a><br>
                    <a href="#" style="margin-top: 8px;display: inline-block;">Resend Email Verification</a>
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
    });

</script>


@endsection
