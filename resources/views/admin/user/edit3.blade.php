@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">

                <div class="box-header"> <h3>Edit User</h3> </div>

                <div class="box-body">

                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                        </div>
                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/user-list/'.$item->id) }}" method="POST">
                      @csrf
                        {{method_field('PUT')}}

                        @if(Auth::user()->group_id==1)
                            <div class="form-group">
                               <label for="name"> Type </label>
                               <select name="group_id" onchange="show_team(this.value)" class="form-control" required>
                                  @if($user_type)
                                     @foreach($user_type as $row)
                                       <option value="{!! $row->id !!}" @if($item->group_id==$row->id) selected @endif >{!! $row->name !!}</option>
                                     @endforeach
                                  @endif
                               </select>
                            </div>

                        @endif

                         <div class="form-group">
                             <label for="name">Name</label>
                             <input type="text" name="first_name" value="{!! $item->first_name !!}" placeholder="First Name" class="form-control" id="name" required>
                         </div>

                         <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" value="{!! $item->email !!}" placeholder="Email" class="form-control" id="email" required>
                         </div>

                         <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="cell_phone" value="{!! $item->cell_phone !!}" placeholder="phone" class="form-control" id="phone" required>
                         </div>

                         <div class="form-group">
                             <label for="name">Password</label>
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
