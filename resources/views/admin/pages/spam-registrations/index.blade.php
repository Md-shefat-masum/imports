@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
    <link href="http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Spam Registration</h3>
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

				</div>

					<table cellspacing="0" bordercolor="gray" id="myTable" class="table table-bordered custom_table custom_table_btn">
						<thead>
							<tr>
								<th style="">#</th>
								<th>Email</th>
								<th>User Type</th>
								<th>Email Verified</th>
								<th>Phone</th>
								<th>Phone Verified</th>
								<th>Manage</th>
							</tr>
						</thead>

						<tbody>
							<?php $i=0; ?>
							@foreach($spam_registration as $data)
							<?php $i++; ?>
							<tr>
								<td>{{$i}}</td>
								<td>{{$data->email}}</td>
                                <td>{{$data->user_type}}</td>
                                <td>{{ ($data->email_verified_at == null) ? "Not Verified" : 'Verified' }}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{ ($data->phone_verified_at == null) ? "Not Verified" : 'Verified' }}</td>
								<td>
									<div class="btn-group btn-group-sm btn-color-ceate">

										<a class="btn btn-danger delete-btn" href="{{ route('delete_spam_registration', $data->id) }}">
											<button class="" style="
																background: none;
																border: none;
																color: #ffffff;
																text-align: center;">Delete</button>
										</a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
    <script src="http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection
