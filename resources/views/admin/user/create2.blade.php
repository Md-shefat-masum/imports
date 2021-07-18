@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="col-md-6 col-md-offset-3">

                <div class="box-header"> <h3>Create User</h3> </div>

                <div class="box-body">

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
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            {!! session('success') !!}
                        </div>
                    @endif

                    <form action="{{ route('adminAddedNewUser') }}" method="POST">
                        @csrf
                        @section('editMethod')
                        @show

                        @if(Auth::user()->group_id==1)
                            <div class="form-group">
                               <label for="name"> Type </label>
                               <select name="group_id" onchange="show_team(this.value)" class="form-control" required>
                                  <option value="Admin">Admin</option>
                                  <option value="vops">VOPS</option>
                                  <option value="Shipping">Shipping Manager</option>
                                </select>
                            </div>
                        @endif

                         <div class="form-group">
                             <label for="name">Name</label>
                             <input type="text" name="first_name" value="{!! old('first_name') !!}" placeholder="Full Name" class="form-control" id="first_name" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" value="{!! old('email') !!}" placeholder="Email" class="form-control" id="email" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="cell_phone" value="{!! old('cell_phone') !!}" placeholder="phone" class="form-control" id="cell_phone" required>
                         </div>
                         <div class="form-group">
                             <label for="name">Password</label>
                             <input type="password" name="password" value="{!! old('password') !!}" placeholder="password" class="form-control" id="password" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Confirmed Password</label>
                            <input type="password" name="password_confirmation" value="{!! old('password_confirmation') !!}" placeholder="Confirmed password" class="form-control" id="password_confirmation" required>
                         </div>


                        <button type="submit" class="btn" style="background: #3C8DBC;color: #ffffff;">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>
                </div>

            </div>
        </div>
    </div>

@section('scripts') @endsection
@endsection
