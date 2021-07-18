@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
        @if(Session::has('success'))

        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('success') }}
        </div>

    @endif

    @if(Session::has('danger'))

        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('danger') }}
        </div>

    @endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> All Quick Contact</h3>
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

                            <th style="">#</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Social Link</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
                        <?php $i=0; ?>
                        @forelse ($quickContact as $contact)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    {{ $contact->address_first }} <br>
                                    {{ $contact->address_second }} <br>
                                    {{ $contact->address_third }}
                                </td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>
                                    <b>Facebook </b><br>
                                    {{ substr($contact->facebook, 0, 43) }}<br>
                                    <b>Twitter </b><br>
                                    {{ substr($contact->twitter, 0, 43) }}<br>
                                    <b>Gmail </b><br>
                                    {{ substr($contact->gmail, 0, 43) }}<br>
                                    <b>Linkedin </b><br>
                                    {{ substr($contact->linkedin, 0, 43) }}
                                </td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{ route('editQuickContact', $contact->id) }}" class="btn btn-info view-btn">Edit</a>
								</div>
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

@endsection
@section('scripts')

@endsection
