@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        @if (Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> Entrepreneurs Request</h3>
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
                            <th> Email </th>
                            <th> Phone </th>

                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp

                        @foreach($user_list as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->user_type}}</td>
                                <td><b>{{$row->first_name}} {{$row->last_name}}</b></td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->cell_phone}}</td>
                                <td>
                                    <form class="form-inline" action="{{ route('supEnt-action') }}" method="post" style="display: inline-flex;">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$row->id}}">
                                        <div class="form-group">
                                          <select class="form-control" id="sel1" name="status">
                                            <option value="pending" {{ ($row->user_action == 'pending') ? 'selected' : '' }}>Pending</option>
                                            <option value="reject" {{ ($row->user_action == 'reject') ? 'selected' : '' }}>Reject</option>
                                            <option value="active" {{ ($row->user_action == 'active') ? 'selected' : '' }}>Active</option>
                                          </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                    <form method="POST" action="{{ route('user-delete', $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                         {{ method_field('DELETE') }}
                                         {{ csrf_field() }}
                                         <button type="submit" class="btn btn-danger" title="Remove From List" onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
                                     </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="editor"></div>
                <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
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
