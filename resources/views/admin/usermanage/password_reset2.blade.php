@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">
            <div class="box">

                <div class="panel-heading"> User List </div>

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
                                    <th> email </th>
                                    <th> Verification </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp

                                @foreach($user_list as $row)
                                    @php $i++; @endphp

                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$row->type}}</td>
                                        <td><b>{{$row->first_name}}</b></td>
                                        <td>{{$row->email}}</td>
                                        <td>{{ ($row->email_verified_at == null) ? 'Unverified' : 'Verified' }}</td>
                                        <td>
                                            <a href="{{ route('passwordResetEdit', $row->id) }}" class="btn btn-danger">Password Reset</a>
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
