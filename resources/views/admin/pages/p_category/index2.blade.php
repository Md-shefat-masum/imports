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
				<h3 class="box-title">Product Category
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Add Product Category
              </button>
				</h3>
				<!-- modal start (Insert)-->
				<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
          	 <form action="{{route('p_category.store')}}" method="POST">
          	 	{{csrf_field()}}
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Product Category</h4>
              </div>
              <div class="modal-body">

                	<div class="form-group">
                		<label for="">Product Category</label>
                		<input type="text" name="cat_name" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label for="">Product Sub Category</label>
                		<select name="sub_cat" id="" class="form-control" required>
                			<option value="">Select Category</option>
							@foreach($subCategory as $c)
                			<option value="{{$c->id}}">{{$c->name}}</option>
                			@endforeach
                		</select>
                	</div>
                	<div class="form-group">
                		<label for="">Category Description</label>
                		<textarea name="cat_description" id="" cols="30" rows="10" class="form-control" required></textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Status</label>
                		<select name="status" id="" class="form-control" required>
	                		<option value="">Select Status</option>
	                		<option value="1">Publish</option>
	                		<option value="0">Unpublish</option>
                		</select>
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
						<th>Categroy Name</th>
						<th>Categroy Description</th>
						<th>Categroy Status</th>
						<th>Action</th>
					</tr>
					<?php $i=0;?>
					@foreach($cat as $data)
					<?php $i++;?>
					<tr>
						<td>{{$i}}</td>
						<td>{{$data->cat_name}}</td>
						<td><a href="">{{$data->cat_description}}</a></td>
						<td>{{$data->status}}</td>
						<td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('p_category.edit',$data->id)}}" >Edit</a></li>
									<li><form action="{{route('p_category.destroy',$data->id)}}" method="POST">
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
					<li>{{ $cat->links() }}</li>
				</ul>
			</div>

		</div>
		<!--/.box -->
	</div>
</div>










@section('scripts')
@endsection
@endsection
