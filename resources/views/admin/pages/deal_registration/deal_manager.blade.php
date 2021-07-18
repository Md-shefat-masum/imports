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
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> Deal Registration</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add New Deal</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{ route('deal_registration_store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Add New Deal</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										@php
											$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
										@endphp
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="first_name"> First Name *</label>
												<input type="text" name="first_name" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="last_name"> Last Name *</label>
												<input type="text" name="last_name" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="email"> Email Address *</label>
												<input type="email" name="email" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="job_title"> Job Title *</label>
												<input type="text" name="job_title" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="company"> Company *</label>
												<input type="text" name="company" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="phone"> Phone *</label>
												<input type="text" name="phone" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="website"> Website *</label>
												<input type="url" name="website" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="address"> Address *</label>
												<textarea name="address" cols="30" rows="2" id="my-editor2" class="form-control" required></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor2', options);
												</script>
											</div>

                                            <div class="form-group">
												<label for="country"> Country *</label>
												<input type="text" name="country" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="headquarters"> Headquarters </label>
												<input type="text" name="headquarters" class="form-control">
											</div>

                                            <div class="form-group">
                                                <label for="indeustry"> Industry *</label>
                                                <select class="form-control" name="indeustry">
                                                    <option value="Advertising / Performance Mktg / Lead Gen">Advertising / Performance Mktg / Lead Gen</option>
                                                    <option value="Business Process Outsourcer (BPO)">Business Process Outsourcer (BPO)</option>
                                                    <option value="Business Support Services">Business Support Services</option>
                                                    <option value="Collections">Collections</option>
                                                    <option value="Communications (Telco, Cable, ISP)">Communications (Telco, Cable, ISP)</option>
                                                    <option value="Consumer Goods & Services">Consumer Goods & Services</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Financial Services">Financial Services</option>
                                                    <option value="Government">Government</option>
                                                    <option value="Health Insurance">Health Insurance</option>
                                                    <option value="Healthcare Providers & Pharma">Healthcare Providers & Pharma</option>
                                                    <option value="Manufacturing">Manufacturing</option>
                                                    <option value="Media / Entertainment / Publishing">Media / Entertainment / Publishing</option>
                                                    <option value="Other">Other</option>
                                                    <option value="P & C Insurance">P & C Insurance</option>
                                                    <option value="Retail / Ecommerce">Retail / Ecommerce</option>
                                                    <option value="Software">Software</option>
                                                    <option value="Technology">Technology</option>
                                                    <option value="Travel / Transportation">Travel / Transportation</option>
                                                    <option value="Utilities (Oil, Gas, Electric)">Utilities (Oil, Gas, Electric)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="good_relation"> Currently do business with this company *</label>
                                                <select class="form-control" name="good_relation">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="meeting_scheduled_completed"> Meeting Scheduled or Completed? *</label>
                                                <select class="form-control" name="meeting_scheduled_completed">
													<option value="Yes">Yes</option>
													<option value="No">No</option>
                                                
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <label for="purchase_time_frame"> Purchase Timeframe? *</label>
                                                <select class="form-control" name="purchase_time_frame">
                                                    
													<option value="1-2 Weeks">1-2 Weeks</option>
                                                    <option value="2-4 Weeks">2-4 Weeks</option>
                                                    <option value="4-6 Weeks">4-6 Weeks</option>
                                                    <option value="Within 6 Months">Within 6 Months</option>
                                                </select>
                                            </div>

                                            <h2>Partner Submitter Information</h1>

                                            <div class="form-group">
												<label for="your_full_name"> Your Full Name *</label>
												<input type="text" name="your_full_name" class="form-control" required>
											</div>
                                            <div class="form-group">
												<label for="your_full_email"> Your Full Email *</label>
												<input type="email" name="your_full_email" class="form-control" required>
											</div>
                                            <div class="form-group">
												<label for="your_full_phone"> Your Full Phone *</label>
												<input type="text" name="your_full_phone" class="form-control" required>
											</div>
                                            <div class="form-group">
												<label for="fwb_affiliate"> FWB Affiliate / Entrepreneur Company *</label>
												<input type="text" name="fwb_affiliate" class="form-control" required>
											</div>

                                            <div class="form-group">
                                                <label for="is_the_sales_rep_name"> Is the Sales Rep Name the same as above? *</label>
                                                <select class="form-control" name="is_the_sales_rep_name">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>

										</div>
										<div class="modal-footer">

											<button type="submit" class="btn btn-secondary modal-close-btn"
												data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary modal-delete-btn">Save
												changes</button>
										</div>
									</div>
									<!-- /.modal-content -->

								</div>
							</form>
							<!-- /.modal-dialog -->
						</div>
					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

							<th style="">#</th>
									<th>Creator</th>
									<th>Name</th>
									<th>Email</th>
									<th>Job Title</th>
									<th>Company</th>
									<th>Phone</th>
									<th>Website</th>
									<th>Country</th>
									<th>Industry</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						@foreach($blog as $data)
							@php
								$i++;
								$creator = App\User::where('id', $data->auth_user)->first();
							@endphp
							<tr>
								<td>{{$i}}</td>
								<td>{{ $creator->first_name }} {{ $creator->last_name}}</td>
								<td>{{$data->first_name}} {{$data->last_name}}</td>
								<td>{{$data->email}}</td>
								<td>{{$data->job_title}}</td>
								<td>{{$data->company}}</td>
								<td>{{$data->phone}}</td>
								<td>{{$data->website}}</td>
								<td>{{$data->country}}</td>
								<td>{{$data->indeustry}}</td>

								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info">Action</button>
										<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{route('deal_registration_edit',$data->id)}}" >Edit</a></li>
											<li><form action="{{route('deal_registration_destroy',$data->id)}}" method="POST">
												@method('DELETE')
												{{csrf_field()}}
												<button class="" style="
												background: none;
												border: none;
												color: #333;
												text-align: center;
												padding-left: 20px;
												">Delete</button>
											</form></li>

										</ul>
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
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
					// Summernote Editor
					$('#details').summernote({
						height: 200,
					});
                    $('#address').summernote({
						height: 80,
					});
				});

</script>
@endsection
@endsection