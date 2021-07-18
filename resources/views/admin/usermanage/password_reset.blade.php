@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> User List</h3>
                    </div>
                    <div class="col-md-6 text-right card_header_btn">
                    </div>
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
                                <a href="{{ route('passwordResetEdit', $row->id) }}" class="btn btn-danger">Password
                                    Reset</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
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




@section('scripts') @endsection
@endsection