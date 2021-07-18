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
				<h3 class="box-title">Suppler Forum
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Add New Suppler Forum
              </button>
				</h3>
				<!-- modal start -->
				<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
          	<form action="{{route('sf.store')}}" method="POST" enctype="multipart/form-data">
                	@csrf
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Write Your Suppler Forum</h4>
              </div>
              <div class="modal-body">

                	<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">

                	<div class="form-group">
                		<label for="">Suppler Forum Title</label>
                		<input type="text" name="title" class="form-control">
                	</div>
                	<div class="form-group">
                		<label for="">Suppler Forum Details</label>
                		<textarea name="details" id="" cols="30" rows="10" class="form-control"></textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Suppler Forum Category</label>
                		<input type="text" name="category" class="form-control">
                	</div>

                	<div class="form-group">
                		<label for="">Suppler Forum Status</label>
                		<select name="status" id="" class="form-control">
                			<option selected> -------------- </option>
                			<option value="1">Publish</option>
                			<option value="0">Unpublish</option>

                		</select>
                	</div>
                	<div class="form-group">
                		<label for="">News/Blog File</label>
                		<input type="file" name="image" class="form-control">
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

						<th>Title</th>
						<th>Details</th>
						<th> Category</th>
						<th> Status</th>
						<th>Published At</th>
						<th>Publish by</th>
						<th>Images</th>
						<th>Action</th>
					</tr>
					<?php $i=0;?>
					@foreach($sf as $data)
					<?php $i++;?>
					<tr>
						<td>{{$i}}</td>
						<td>{{$data->heading}}</td>
						<td>{{$data->title}}</td>
						<td>
							{{ substr(strip_tags($data->details), 0,100) }}
        					{{ strlen(strip_tags($data->details)) > 50 ? "...Read More" : "" }}
						</td>
						<td>{{$data->category}}</td>
						<td>{{$data->status}}</td>
						<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>
						<td>{{$data->auther_id}}</td>
						<td><img src="/public/images/blog/{{$data->image}}" style="height:50;width: 50px;"> <td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{route('sf.edit',$data->id)}}" >Edit</a></li>
									<li><form action="{{route('sf.destroy',$data->id)}}" method="POST">
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
					<ul class="pagination pagination-sm no-margin pull-right">
					<li>{{ $sf->links() }}</li>
				</ul>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>
@section('scripts')
@endsection
@endsection
