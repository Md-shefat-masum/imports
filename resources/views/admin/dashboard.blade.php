@extends('admin.layouts.master')
@section('content')
@php
$group_id = Auth::user()->group_id;
@endphp
@if($group_id==1)
<div class="row">
    <div class="col-lg-3 col-xl-3">
        <div class="card m-b-30" style="border: none;">
            <div class="card-body">
                <div class="media">
                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"
                        style="background-color: #e20505; color: #fff;"><i class="feather icon-users"></i></span>
                    <div class="media-body">
                        @php
                        $totalUser=App\User::count();
                        @endphp
                        <p class="mb-0">Users</p>
                        <h5 class="mb-0">{{$totalUser}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
    <!-- Start col -->
    @php
    $counter = DB::table('visitor_counter')->where('id', 1)->first()->counter;
    $entrepreneur = DB::table('users')->where('group_id', 5)->get();
    $supplier = DB::table('users')->where('group_id', 4)->get();
    $user = DB::table('users')->get();
  @endphp
    <div class="col-lg-3 col-xl-3">
        <div class="card m-b-30" style="border: none;">
            <div class="card-body">
                <div class="media">
                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"
                        style="background-color: #15cc3d; color: #fff;"><i class="feather icon-users"></i></span>
                    <div class="media-body">
                        <p class="mb-0">Total Visitors</p>
                        <h5 class="mb-0">{{ $counter }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
    <!-- Start col -->
    <div class="col-lg-3 col-xl-3">
        <div class="card m-b-30" style="border: none;">
            <div class="card-body">
                <div class="media">
                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"
                        style="background-color: #e2053c; color: #fff;"><i class="feather icon-users"></i></span>
                    <div class="media-body">
                        <p class="mb-0">Total Supplier</p>
                        <h5 class="mb-0">{{ count($supplier) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xl-3">
        <div class="card m-b-30" style="border: none;">
            <div class="card-body">
                <div class="media">
                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"
                        style="background-color: #0288b1; color: #fff;"><i class="feather icon-users"></i></span>
                    <div class="media-body">
                        <p class="mb-0">Total Enterprenor</p>
                        <h5 class="mb-0">{{ count($entrepreneur) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection