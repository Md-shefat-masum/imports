@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
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
				<h3 class="box-title">Privency And Policy
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
				Privency And Policy
				</button>
				</h3>
				<!-- modal start -->
				<div class="modal modal-success fade" id="modal-success">
					<form action="{{route('policy.store')}}" method="post" id="add_data">
				  @csrf
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Privency And Policy</h4>
								</div>
								<div class="modal-body">


									<div class="form-group">
										<label for="">Title</label>
										<input type="text" name="title" class="form-control" id="menu">
									</div>

									<div class="form-group">
										<label for="">Description</label>
											<textarea name="description" id="" cols="30" rows="10" class="form-control summernote"></textarea>
									</div>
									<div class="form-group">
										<label for="">Link</label>
										<input type="text" name="link" class="form-control" id="menu">
									</div>
									<div class="form-group">
										<label for="">Image</label>
										<input type="file" name="image" class="form-control" id="menu">
									</div>
									<select name="status" id="status" class="form-control">
										<option value="0">Unpublish</option>
										<option value="1">Publish</option>
									</select>
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
						<th>Description</th>
						<th>Link</th>
						<th>image</th>

						<th>Status</th>
						<th>Create At</th>
						<th>Action</th>
					</tr>
					<?php $i=0; ?>
					@foreach($policy as $data)
					<?php $i++; ?>
					<tr>
						<td>{{$i}}</td>
						<td>{{$data->title}}</td>
						<td>{{$data->link}}</td>
						<td>{{$data->image}}</td>
						<td>
							@if($data->status == 1)
							{{"Publish"}}
							@else
							{{"Unpublish"}}
							@endif
						</td>
						<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>

						<td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('policy.edit',$data->id)}}">Edit</a></li>
									<li><form action="{{url('pages/policy',$data->id)}}" method="POST">
											@method('DELETE')
											{{csrf_field()}}
										 <button class="" style="
										    background: none;
										    border: none;
										    color: #333;
										    text-align: center;
										    padding-left: 20px;
										">Delete</button>
										 </form>
									 </li>
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
					<li>{{ $policy->links() }}</li>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>
@endsection
