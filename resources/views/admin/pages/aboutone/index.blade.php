@extends('admin.layouts.master')
@section('title','| Contact ')
@section('stylesheet')
<style>
	ul.tabs {
		margin: 0px;
		padding: 0px;
		list-style: none;
	}

	ul.tabs li {
		background: none;
		color: #222;
		display: inline-block;
		padding: 10px 15px;
		cursor: pointer;
	}

	ul.tabs li.current {
		background: #ededed;
		color: #222;
	}

	.tab-content {
		display: none;
		background: #ededed;

	}

	.tab-content.current {
		display: inherit;
	}
</style>
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
						<h3><i class="fa fa-gg-circle"></i> About Us</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">


					</div>
				</div>
			</div>
			<div class="accordion" id="accordionExample">
				<div class="card">

					{{-- <ul class="tabs"> --}}
					{{-- <li class="tab-link" data-tab="tab-1">About One</li>
					<li class="tab-link" data-tab="tab-2">About Two</li>
					<li class="tab-link" data-tab="tab-3">About Three</li> --}}
					<div class="container">
						<div class="row" style="padding: 20px 50px;">
							<div id="headingOne">
								<h2 class="mb-0">
									<button class="btn btn-info" type="button" data-toggle="collapse"
										data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										About One
									</button>
								</h2>
							</div>
							<div id="headingTwo">
								<h2 class="mb-0">
									<button class="btn btn-warning collapsed" type="button" data-toggle="collapse"
										data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										About Two
									</button>
								</h2>
							</div>
							<div id="headingThree">
								<h2 class="mb-0">
									<button class="btn btn-success collapsed" type="button" data-toggle="collapse"
										data-target="#collapseThree" aria-expanded="false"
										aria-controls="collapseThree">
										About Three
									</button>
								</h2>
							</div>
						</div>
					</div>

					{{-- </ul> --}}

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
						data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<h3>About One</h3>
									<form action="{{route('aboutOne.store')}}" method="post"
										enctype="multipart/form-data">
										{{csrf_field()}}
										<div class="contaier">
											<div class="form-gorup">
												<label for="">Title</label>
												<input type="text" class="form-control" name="title">
											</div>
											<div class="form-gorup">
												<label for="">Description</label>
												<textarea name="description" id="" cols="30" rows="10"
													class="form-control"></textarea>
											</div>

											<div class="form-gorup">
												<label for="">Button Name</label>
												<input type="text" class="form-control" name="btn_name">
											</div>
											<div class="form-gorup">
												<label for="">Button Link</label>
												<input type="text" class="form-control" name="btn_link">
											</div>
											<div class="form-gorup">
												<label for="">Image</label>
												<input type="file" class="form-control" name="image">
											</div>
											<div class="form-gorup">
												<label for="">Status</label>
												<select name="status" id="" class="form-control">
													<option selected="">Select Status</option>
													<option value="1">Publish</option>
													<option value="0">Unpublish</option>
												</select>
											</div>
											<br>
											<input type="submit" class="btn btn-success" value="Save">
										</div>
									</form>
									<br><br>
									<div id="printableTable" class="card-body table-responsive">
										<table cellspacing="0" bordercolor="gray" id="allTable"
											class=" table table-bordered custom_table custom_table_btn">
											<thead>

												<tr>
													<th style="">#</th>
													<th>Title</th>
													<th>Description</th>
													<th>Button Name</th>
													<th>Button Link</th>
													<th>Status</th>


													<th>Create At</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=0; ?>
												@foreach($aboutOne as $data)
												<?php $i++; ?>
												<tr>
													<td>{{$i}}</td>
													<td>{{$data->title}}</td>
													<td>{{$data->description}}</td>
													<td>{{$data->btn_name}}</td>
													<td>{{$data->btn_link}}</td>
													<td>{{$data->status}}</td>

													<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>

													<td>

														<div class="btn-group btn-group-sm btn-color-ceate">

															<a href="{{route('aboutOne.edit',$data->id)}}" class="btn btn-info view-btn">Edit</a>
															<a class="btn btn-danger delete-btn">
																<form action="{{url('pages/aboutOne',$data->id)}}" method="POST">
																	@method('DELETE')
																	{{csrf_field()}} <button class="" style="
																	background: none;
																	border: none;
																	color: #ffffff;
																	text-align: center;
																	
																">Delete</button>
																</form>
															</a>
														</div>
													</td>

												</tr>
												@endforeach
											</tbody>

										</table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<h3>About Two</h3>
									<form action="{{route('aboutTwo.store')}}" method="post"
										enctype="multipart/form-data">
										{{csrf_field()}}
										<div class="contaier">
											<div class="form-gorup">
												<label for="">Title</label>
												<input type="text" class="form-control" name="title">
											</div>
											<div class="form-gorup">
												<label for="">Content</label>
												<textarea name="content" id="" cols="30" rows="10"
													class="form-control"></textarea>
											</div>

											<div class="form-gorup">
												<label for="">Status</label>
												<select name="status" id="" class="form-control">
													<option selected="">Select Status</option>
													<option value="1">Publish</option>
													<option value="0">Unpublish</option>
												</select>
											</div>
											<br>
											<input type="submit" class="btn btn-success" value="Save">
										</div>
									</form>
									<br><br>
									<div id="printableTable" class="card-body table-responsive">
										<table cellspacing="0" bordercolor="gray" id="allTable"
											class=" table table-bordered custom_table custom_table_btn">
											<thead>
												<tr>
													<th style="">#</th>
													<th>Title</th>
													<th>Content</th>
													<th>Status</th>
													<th>Create At</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=0; ?>
												@foreach($aboutTwo as $data)
												<?php $i++; ?>

												<tr>
													<td>{{$i}}</td>
													<td>{{$data->title}}</td>
													<td>{{$data->content}}</td>
													<td>{{$data->status}}</td>

													<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>

													<td>
														<div class="btn-group btn-group-sm btn-color-ceate">

															<a href="{{route('aboutTwo.edit',$data->id)}}" class="btn btn-info view-btn">Edit</a>
															<a class="btn btn-danger delete-btn">
																<form action="{{url('pages/aboutTwo',$data->id)}}" method="POST">
																	@method('DELETE')
																	{{csrf_field()}} <button class="" style="
																	background: none;
																	border: none;
																	color: #ffffff;
																	text-align: center;
																	
																">Delete</button>
																</form>
															</a>
														</div>
													</td>

												</tr>
												@endforeach

											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree"
						data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<h3>About Three</h3>
									<form action="{{route('aboutThree.store')}}" method="post"
										enctype="multipart/form-data">
										{{csrf_field()}}
										<div class="contaier">
											<div class="form-gorup">
												<label for="">Title</label>
												<input type="text" class="form-control" name="title">
											</div>
											<div class="form-gorup">
												<label for="">Project Name</label>
												<input type="text" class="form-control" name="project_name">
											</div>
											<div class="form-gorup">
												<label for="">Project Details</label>
												<textarea name="details" id="" cols="30" rows="10"
													class="form-control"></textarea>
											</div>
											<div class="form-gorup">
												<label for="">Image</label>
												<input type="file" class="form-control" name="image">
											</div>
											<div class="form-gorup">
												<label for="">Status</label>
												<select name="status" id="" class="form-control">
													<option selected="">Select Status</option>
													<option value="1">Publish</option>
													<option value="0">Unpublish</option>
												</select>
											</div>
											<br>
											<input type="submit" class="btn btn-success" value="Save">
										</div>
									</form>
									<br><br>
									<div id="printableTable" class="card-body table-responsive">
										<table cellspacing="0" bordercolor="gray" id="allTable"
											class=" table table-bordered custom_table custom_table_btn">
											<thead>
												<tr>
													<th style="">#</th>
													<th>Title</th>
													<th>Project Name</th>
													<th>Project Details</th>
													<th>Status</th>
													<th>Create At</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=0; ?>
												@foreach($aboutThree as $data)
												<?php $i++; ?>
												<tr>
													<td>{{$i}}</td>
													<td>{{$data->title}}</td>
													<td>{{$data->project_name}}</td>
													<td>{{$data->details}}</td>
													<td>{{$data->status}}</td>

													<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>

													<td>

														<div class="btn-group btn-group-sm btn-color-ceate">

															<a href="{{route('aboutThree.edit',$data->id)}}"
																class="btn btn-info view-btn">Edit</a>
															<a class="btn btn-danger delete-btn">
																<form action="{{url('pages/aboutThree',$data->id)}}"
																	method="POST">
																	@method('DELETE')
																	{{csrf_field()}} <button class="" style="
																	background: none;
																	border: none;
																	color: #ffffff;
																	text-align: center;
																	
																">Delete</button>
																</form>
															</a>
														</div>
													</td>

												</tr>
												@endforeach

											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
						</div>

					</div><!-- container -->
					<!-- modal start -->
					<!--
					<div class="form-group">
							<label for="">Phone Number</label>
							<div class="input-group control-group increment" >
							<input type="text" name="phone[]" class="form-control">
							<div class="input-group-btn">
									<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
							</div>
					</div>
					<div class="clone hide">
							<div class="control-group input-group" style="margin-top:10px">
									<input type="text" name="phone[]" class="form-control">
									<div class="input-group-btn">
											<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
									</div>
							</div>

					</div>
					</div>
					<div class="form-group">
							<label for="">Address OR Location</label>
							<div class="input-group control-group increment" >
							<input type="text" name="address[]" class="form-control">
							<div class="input-group-btn">
									<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
							</div>
					</div>
					<div class="clone hide">
							<div class="control-group input-group" style="margin-top:10px">
									<input type="text" name="address[]" class="form-control">
									<div class="input-group-btn">
											<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
									</div>
							</div>

					</div>
					</div>
					<div class="form-group">
							<label for="">Email</label>
							<div class="input-group control-group increment" >
							<input type="text" name="email[]" class="form-control">
							<div class="input-group-btn">
									<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
							</div>
					</div>
					<div class="clone hide">
							<div class="control-group input-group" style="margin-top:10px">
									<input type="text" name="email[]" class="form-control">
									<div class="input-group-btn">
											<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
									</div>
							</div>

					</div>
				</div> -->

					<!-- /.modal-content -->

					<!-- /.modal-dialog -->

					<!-- modal end -->
				</div>
			</div>
			<!-- /.box-header -->


			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li>{{ $aboutOne->links() }}</li>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
	{{-- </div> --}}
	@endsection
	@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
$(".btn-success").click(function(){
var html = $(".clone").html();
$(".increment").after(html);
});
$("body").on("click",".btn-danger",function(){
$(this).parents(".control-group").remove();
});
});
$(document).ready(function(){

	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
	</script>
	@endsection