@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-12 ">
		<div class="box">
			@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>

		@endif
			<div class="box-header with-border">
				<h3 class="box-title">Testimonials
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Add Testimonials
              </button>
				</h3>
				<!-- modal start (Insert)-->
				<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
          	 <form action="{{route('tes.store')}}" method="POST" enctype="multipart/form-data">
          	 	{{csrf_field()}}
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Testimonials</h4>
              </div>
              <div class="modal-body">

                	<div class="form-group">
                		<label for="">Name</label>
                		<input type="text" name="name" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label for="">Designation</label>
                		<input type="text" name="designation" class="form-control">
                	</div>
                	<div class="form-group">
                		<label for="">Comments</label>
                		<textarea name="comments" id="" cols="30" rows="10" class="form-control"></textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Link</label>
                		<input type="text" name="link" class="form-control">
                	</div>
                	<div class="form-group">
                		<label for="">Status</label>
                		<select name="status" id="" class="form-control">
	                		<option disabled>Select Status</option>
	                		<option value="1">Publish</option>
	                		<option value="0">Unpublish</option>
                		</select>
                	</div>
                	<div class="form-group">
                		<label for="">Image Uplodad</label>
                		<input type="file" name="image" class="form-control">
                	</div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
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
							<th>Designation</th>
							<th> Comments</th>
							<th> Status</th>
							<th> Link</th>
							<th> Images</th>
							<th>Action</th>
						</tr>
						<?php $i=0;
						$path=public_path('/images/testimonial/');
						?>

						@foreach($tes as $data)
							<?php $i++;?>
							<tr>
								<td>{{$i}}</td>
								<td>{{$data->name}}</td>
								<td>{{$data->designation}}</td>
								<td>{{$data->comments}}</td>

								<td>{{$data->status}}</td>
								<td><a href="">{{$data->link}}</a></td>

								<td>
									@if($data->image !=null)<img src="{{url('/')}}/public/images/testimonial/{{$data->image}}" width="80px"> @endif <td>

										<div class="btn-group">
											<button type="button" class="btn btn-info">Action</button>
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{route('tes.edit',$data->id)}}" >Edit</a></li>
												<li><form action="{{route('tes.destroy',$data->id)}}" method="POST">
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
					<li>{{ $tes->links() }}</li>
				</ul>
			</div>

		</div>
		<!--/.box -->
	</div>
</div>










@section('scripts')
@endsection
@endsection
