@extends('admin.layouts.master')
@section('title','| Contact ')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-12">
		@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Contact
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
				Add Contact
				</button>
				</h3>
				<!-- modal start -->
				<div class="modal modal-success fade" id="modal-success">
					<form action="{{route('contact.store')}}" method="post" id="add_data">
						@csrf
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Contact</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="">Title</label>
										<input type="text" name="title" class="form-control" required>
									</div>

									<div class="form-group">
										<label for="">Phone 1</label>
										<input type="text" name="phone1" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="">Phone 2</label>
										<input type="text" name="phone2" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Address 1</label>
										<textarea name="address1" id="" cols="30" rows="10" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<label for="">Address 2</label>
										<textarea name="address2" id="" cols="30" rows="10" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<label for="">Email 1</label>
										<input type="email" name="email1" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="">Email 2</label>
										<input type="email" name="email2" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Website 1</label>
										<input type="text" name="website1" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Website 2</label>
										<input type="text" name="website2" class="form-control">
									</div>
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

								</div>


								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-outline">Save changes</button>
								</div>
							</div>
							<!-- /.modal-content -->

						</div>
					</form>
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
						<th>Title</th>
						<th>Phone 1</th>
						<th>Phone 2</th>
						<th>Address 1</th>
						<th>Address 2</th>
						<th>Email 1</th>
						<th>Email 2</th>
						<th>Website 1</th>
						<th>Website 2</th>


						<th>Create At</th>
						<th>Action</th>
					</tr>
					<?php $i=0; ?>
					@foreach($contact as $data)
					<?php $i++; ?>
					<tr>
						<td>{{$i}}</td>
						<td>{{$data->title}}</td>
						<td>{{$data->phone1}}</td>
						<td>{{$data->phone2}}</td>
						<td>{{$data->address1}}</td>
						<td>{{$data->address2}}</td>
						<td>{{$data->email1}}</td>
						<td>{{$data->email2}}</td>
						<td>{{$data->website1}}</td>
						<td>{{$data->website2}}</td>

						<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>

						<td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('contact.edit',$data->id)}}">Edit</a></li>
									<li><form action="{{url('pages/contact',$data->id)}}" method="POST">
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
			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li>{{ $contact->links() }}</li>
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
