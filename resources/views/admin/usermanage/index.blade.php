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
                                @if ($row->type == 'Supplier' || $row->type == 'Entrepreneur')
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$row->type}}</td>
                                    <td><b>{{$row->first_name}}</b></td>
                                    <td>{{$row->email}}</td>
                                    <td>{{ ($row->email_verified_at == null) ? 'Unverified' : 'Verified' }}</td>
                                    <td>
                                        <form class="form-inline" action="{{ route('user-action', $row->id) }}"
                                            method="post" style="display: inline-block;">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="form-group" style="display: inline-block;">
                                                <select class="form-control" id="sel1" name="user_action">
                                                    <option value="pending"
                                                        {{ ($row->user_action == 'pending') ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="reject"
                                                        {{ ($row->user_action == 'reject') ? 'selected' : '' }}>
                                                        Reject</option>
                                                    <option value="active"
                                                        {{ ($row->user_action == 'active') ? 'selected' : '' }}>
                                                        Active</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                        <form method="POST" action="{{ route('user-delete', $row->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Remove From List"
                                                onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
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