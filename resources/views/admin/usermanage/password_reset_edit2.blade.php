@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">

                <div class="box-header"> <h3>Password Reset</h3> </div>

                <div class="box-body">

                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                        </div>
                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ route('passwordResetUpdate', $item->id) }}" method="POST">
                      @csrf
                        {{method_field('PUT')}}

                         <div class="form-group">
                             <label for="name">New Password</label>
                             <input type="password" value="" name="password" placeholder="password" class="form-control" id="password" >
                         </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>

            </div>
        </div>
    </div>

@section('scripts') @endsection
@endsection
