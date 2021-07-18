@extends('front_end.layouts.master')
@section('title','|Product')
@section('stylesheet')
    <style>
        .table td, .table th{
            border: none;
        }
    </style>
@endsection
@section('content')
    @include('front_end.pages.ourJs')
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card text-center">
                @if (session('success'))
                    <div class="alert alert-success" style="width:100%">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">
                    My Profile
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $details->first_name." ".$details->last_name }}</h5>
                    <table class="table">
                        <tr>
                            <th>First Name</th>
                            <td>:</td>
                            <td>{{ $details->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>:</td>
                            <td>{{ $details->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $details->email }}</td>
                        </tr>
                        <tr>
                            <th>Cell Phone</th>
                            <td>:</td>
                            <td>{{ $details->cell_phone }}</td>
                        </tr>
                        <tr>
                            <th>Alternate Phone</th>
                            <td>:</td>
                            <td>{{ $details->home_phone }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>:</td>
                            <td>{{ $details->dop }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td>{{ $details->address }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>:</td>
                            <td>{{ $details->city }}</td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>:</td>
                            <td>{{ $details->zip_code }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>:</td>
                            <td>{{ $details->states }}</td>
                        </tr>

                        <tr>
                            <th></th>
                            <td></td>
                            <td><a class="btn btn-primary" href="{{ route('update-profile') }}">Edit Profile</a></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
