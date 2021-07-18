@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')
<div class="row">

    <div class="col-md-12">
        <form method="post" action="{{ route('adminAddedNewUser') }}" id="add_data" enctype="multipart/form-data">
            @csrf
            @section('editMethod')
            @show


            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Create User</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
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
                        @if(Session::has('success'))
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                {!! session('success') !!}
                            </div>
                            @endif



                            @if(Auth::user()->group_id==1)
                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label"> Type </label>
                                <div class="col-sm-8">
                                    <select name="group_id" onchange="show_team(this.value)" class="form-control"
                                        required>
                                        <option value="Admin">Admin</option>
                                        <option value="vops">VOPS</option>
                                        <option value="Shipping">Shipping Manager</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" value="{!! old('first_name') !!}"
                                        placeholder="Full Name" class="form-control" id="first_name" required>
                                </div>
                            </div>
                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="{!! old('email') !!}" placeholder="Email"
                                        class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cell_phone" value="{!! old('cell_phone') !!}"
                                        placeholder="phone" class="form-control" id="cell_phone" required>
                                </div>
                            </div>
                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="{!! old('password') !!}"
                                        placeholder="password" class="form-control" id="password" required>
                                </div>
                            </div>
                            <div class="form-group row custom_form">
                                <label class="col-sm-3 col-form-label">Confirmed Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation"
                                        value="{!! old('password_confirmation') !!}" placeholder="Confirmed password"
                                        class="form-control" id="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer header-part text-center">
                        <button type="submit" class="btn btn-info">Update</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                </div>
        </form>
    </div>

    @section('scripts') @endsection
    @endsection