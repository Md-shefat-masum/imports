@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">
            <div class="box">

                <div class="panel-heading"> Entrepreneurs List </div>

                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif


                    {{-- <a class="pull-right btn btn-default" href="{{ url('/user-list/create') }}" >Add New user</a> --}}
                    <div class="table-responsive">                        
                        <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Type </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Country </th>
                            <th> Status </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                        @foreach($suppliers as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->user_type}}</td>
                                <td><b>{{$row->first_name}} {{$row->last_name}}</b></td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->cell_phone}}</td>
                                <td>{{$row->country}}</td>
                                <td>
                                    Active
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

@section('scripts') @endsection
@endsection
