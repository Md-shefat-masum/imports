@extends('admin.layouts.master')
@section('title','| Contact ')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">About Us
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
				Add About Us
				</button>
				</h3>
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
			<!-- /.box-header -->
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">About 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">About 3</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<form action="{{route('aboutOne.store')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="contaier">
							<div class="form-gorup">
								<label for="">Title</label>
								<input type="text" class="form-control" name="title">
							</div>
							<div class="form-gorup">
								<label for="">Description</label>
								<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
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
					<div class="table-responsive">
						<table class="table table-bordered">
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

								<div class="btn-group">
									<button type="button" class="btn btn-info">Action</button>
									<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('aboutOne.edit',$data->id)}}">Edit</a></li>
										<li><form action="{{url('pages/aboutOne',$data->id)}}" method="POST">
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
				</div>
				<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
				<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
			</div>

			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li>{{ $aboutOne->links() }}</li>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>
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
</script>
@endsection
