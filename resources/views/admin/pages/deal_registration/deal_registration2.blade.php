@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-12 ">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Deal Registration
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
							Add New Deal
						</button>
					</h3>


					@if (Session::has('success'))
						<div class="alert alert-info">{{ Session::get('success') }}</div>
					@endif
					@if (Session::has('error'))
						<div class="alert alert-danger">{{ Session::get('error') }}</div>
					@endif


					<!-- modal start -->
					<div class="modal modal-success fade" id="modal-success">
						<div class="modal-dialog">
							<form action="{{ route('deal_registration_store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Add New Deal</h4>
										</div>
										@php
											$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
										@endphp
										<div class="modal-body">
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
												<input type="number" name="phone" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="website"> Website *</label>
												<input type="url" name="website" class="form-control" required>
											</div>

                                            <div class="form-group">
												<label for="address"> Address *</label>
                                                <textarea name="address" cols="30" rows="2" class="form-control" required></textarea>
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
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
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
												<input type="number" name="your_full_phone" class="form-control" required>
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
											<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-outline">Save changes</button>
										</div>
									</div>
									<!-- /.modal-content -->
								</form>
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- modal end -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th style="">#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Job Title</th>
									<th>Company</th>
									<th>Phone</th>
									<th>Website</th>
									<th>Country</th>
									<th>Industry</th>
									<th>Action</th>
								</tr>

								<?php $i=0;?>
								@foreach($blog as $data)
									@php
										$i++;
									@endphp
									<tr>
										<td>{{$i}}</td>
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
								</table>
							</div>
							<!-- /.box -->
							<div class="box-footer clearfix">
								<ul class="pagination pagination-sm no-margin pull-right">
									<ul class="pagination pagination-sm no-margin pull-right">
										<li>{{ $blog->links() }}</li>
									</ul>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.box -->
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
