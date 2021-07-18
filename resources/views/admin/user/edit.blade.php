@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/user-list/'.$item->id) }}"
            method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Edit User</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">
                            <a href="{{url('user-list')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
                                Back</a>
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



                    @if(Auth::user()->group_id==1)
                    <div class="form-group row custom_form">
                       <label class="col-sm-3 col-form-label"> Type </label>
                        <div class="col-sm-8">
                       <select name="group_id" onchange="show_team(this.value)" class="form-control" required>
                          @if($user_type)
                             @foreach($user_type as $row)
                               <option value="{!! $row->id !!}" @if($item->group_id==$row->id) selected @endif >{!! $row->name !!}</option>
                             @endforeach
                          @endif
                       </select>
                    </div>
                    </div>

                @endif

                 <div class="form-group row custom_form">
                     <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-8">
                     <input type="text" name="first_name" value="{!! $item->first_name !!}" placeholder="First Name" class="form-control" id="name" required>
                 </div>
                 </div>

                 <div class="form-group row custom_form">
                    <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-8">
                    <input type="email" name="email" value="{!! $item->email !!}" placeholder="Email" class="form-control" id="email" required>
                 </div>
                 </div>

                 <div class="form-group row custom_form">
                    <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-8">
                    <input type="text" name="cell_phone" value="{!! $item->cell_phone !!}" placeholder="phone" class="form-control" id="phone" required>
                 </div>
                 </div>

                 <div class="form-group row custom_form">
                     <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-8">
                     <input type="password" value="" name="password" placeholder="password" class="form-control" id="password" >
                 </div>
                 </div>

                </div>

            </div>
            <div class="card-footer header-part text-center">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
    </div>
    </form>
</div>

@section('scripts') @endsection
@endsection