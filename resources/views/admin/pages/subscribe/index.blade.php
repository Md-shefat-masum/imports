@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
    <style>
        @media print {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> Subscribes List</h3>
                    </div>
                    <div class="col-md-6 text-right card_header_btn">

                    </div>
                </div>
            </div>
            <div id="printableTable" class="card-body table-responsive">
                @if (Session::has('success'))
                <div class="alert alert-info">{{ Session::get('success') }}</div>
                @endif
                @if ($errors->has('mail_id'))
                    <div class="col-md-12" style="text-align: center; margin-bottom: 10px;">
                        <div class="alert alert-danger">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif
                <div class="col-md-12 no-print" style="text-align: center; margin-bottom: 10px;">
                    <button type="button" id="deleteAll" class="btn btn-danger" name="button" style="margin-bottom: 8px;">Delete all selected items</button>

                </div>
                <form action="{{ route('subscribe_delete') }}" method="post" id="subscribe_delete">
                    @csrf
                <table cellspacing="0" bordercolor="gray" id="allTable"
                    class=" table table-bordered custom_table custom_table_btn">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th style="">#</th>
                            <th>Email</th>
                            <th>Subscribe Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $subscribes = DB::table('subscribes')->get();
                        @endphp
                        <?php $i=0; ?>
                        @foreach($subscribes as $data)
                            <?php $i++; ?>
                            <tr>
                                <td>
									<div class="form-check">
           								<input type="checkbox" class="form-check-input big-checkbox" name="mail_id[]" value="{{ $data->id }}">
          							</div>
								</td>
                                <td>{{$i}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{ date("d-m-Y || H:i A", strtotime($data->created_at)) }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </form>
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

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableData').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

        $('#deleteAll').click(function() {
			$("#subscribe_delete").submit();
		});
    } );
</script>
@endsection
