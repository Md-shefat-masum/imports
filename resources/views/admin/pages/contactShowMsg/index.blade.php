@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Contact Message</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<div class="row">
					@if (Session::has('success'))
					<div class="alert alert-info" style="text-align: center;width: 100%;">{{ Session::get('success') }}</div>
					@endif

					@if ($errors->has('message_id'))
						<div class="col-md-12" style="text-align: center; margin-bottom: 10px;">
							<div class="alert alert-danger">
								<span>{{ $errors->first() }}</span>
							</div>
						</div>
					@endif
					<div class="col-md-12" style="text-align: center; margin-bottom: 10px;">
						<button type="button" id="deleteAll" class="btn btn-danger" name="button" style="margin-bottom: 8px;">Delete all selected items</button>
						<br>
						<button type="button" id="deleteAndSpam" class="btn btn-danger" name="button">Delete all selected items & Mark as spam </button>
					</div>
				</div>
				<form action="{{ route('multipleMessageDelete') }}" method="post" id="MessageDeleteForm">
					@csrf
					<input type="hidden" name="spam" id="spam_message" value="">
					<table cellspacing="0" bordercolor="gray" id="allTable" class=" table table-bordered custom_table custom_table_btn">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th style="">#</th>
								<th>Full Name</th>
								<th>Phone </th>
								<th>Email</th>
								<th>Message</th>
								<th>Sending Time</th>
								{{-- <th>Manage</th> --}}
							</tr>
						</thead>

						<tbody>
							<?php $i=0; ?>
							@foreach($showContactMsg as $data)
							<?php $i++; ?>
							<tr>
								<td>
									<div class="form-check">
           								<input type="checkbox" class="form-check-input big-checkbox" name="message_id[]" value="{{ $data->id }}">
          							</div>
								</td>
								<td>{{$i}}</td>
								<td>{{$data->full_name}}</td>
								<td>{{$data->phone}}</td>
								<td>{{$data->email}}</td>
								<td>{{$data->message}}</td>
								<td>{{date('M j,Y h:ia',strtotime($data->created_at))}}</td>
								{{-- <td>
									<div class="btn-group btn-group-sm btn-color-ceate">

										<a class="btn btn-danger delete-btn" href="/pages/contactMessage/{{ $data->id }}">
											<button class="" style="
																background: none;
																border: none;
																color: #ffffff;
																text-align: center;">Delete</button>
										</a>
									</div>
								</td> --}}
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
<script>
	$(document).ready(function() {
		$('#deleteAll').click(function() {
			$('#spam_message').val('off');
			$("#MessageDeleteForm").submit();
		});
		$('#deleteAndSpam').click(function() {
			$('#spam_message').val('on');
			$("#MessageDeleteForm").submit();
		});
	});
</script>
@endsection
