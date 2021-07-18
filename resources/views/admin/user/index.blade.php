@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div style="text-align: center; padding: 0px 0px 20px 0px;">
                <a class="btn" href="{{ route('user-list.index') }}"
                    style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">All List</a>
                <a class="btn" href="{{ route('verified') }}"
                    style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">Verified</a>
                <a class="btn" href="{{ route('unverified') }}"
                    style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">Unverified</a>
            </div>
            @if(Session::has('error'))
            <!-- /.box-header -->
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! session('error') !!}
                </div>
                @endif
                <div class="card">
                    <div class="card-header header-part">
                        <div class="row">
                            <div class="col-md-6 card_header_title">
                                <h3><i class="fa fa-gg-circle"></i> All User</h3>
                            </div>
                            <div class="col-md-6 text-right card_header_btn">
                                <a href="{{ route('user-list.create') }}" class="btn"><i class="fa fa-plus-circle"></i>
                                    Add
                                    User</a>
                            </div>
                            @if (Session::has('success'))
                            <div class="alert alert-info" style="text-align: center;width: 100%;">{{ Session::get('success') }}</div>
                            @endif
                        </div>
                    </div>
                    <div id="printableTable" class="card-body table-responsive">
                        <table cellspacing="0" bordercolor="gray" id="allTable"
                            class=" table table-bordered custom_table custom_table_btn">
                            <thead>
                                <tr>
                                    <th> S.N.</th>
                                    <th> Type </th>
                                    <th> Name </th>
                                    <th> email </th>
                                    <th> Email Verify </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp

                                @foreach($user_list as $row)
                                @if($row->email != 'sohangood12@gmail.com')
                                @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$row->type}}</td>
                                    <td><b>{{$row->first_name}}</b></td>
                                    <td>{{$row->email}}</td>
                                    <td>{{ ($row->email_verified_at == null) ? 'Unverified' : 'Verified' }}</td>
                                    <td>
                                        <a href="{{ url('/user-list/'.$row->id.'/edit') }}" class="btn btn-info">
                                            Edit</a>
                                        @if(Auth::user()->group_id==1)
                                        <form class="delete" action="{{ url('/user-list/'.$row->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete?')"
                                            style="display: inline-block;">
                                            {{method_field('DELETE')}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <a href="{{ route('userResendEmail', $row->id) }}" class="btn btn-success">
                                            Resend</a>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $user_list }} --}}
                    </div>
                    <div class="card-footer header-part">
                        <button onclick="generatePDF()" class="btn btn-sm btn-danger">PDF</button>
                        <button onclick="$('table').tblToExcel();" class="btn btn-sm btn-success">EXCEL</button>
                        <button id="csv" class="btn btn-sm btn-info">CSV</button>
                        <button id="json" class="btn btn-sm btn-warning">JSON</button>
                        <button onclick="printDiv()" class="btn btn-sm btn-primary">PRINT</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </section>

    @section('scripts') @endsection
    @endsection
