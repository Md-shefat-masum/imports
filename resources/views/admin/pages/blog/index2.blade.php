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
					<h3 class="box-title">Forum
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
							Add New post
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
							<form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Write Your Forum</h4>
										</div>
										@php
											$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
										@endphp
										<div class="modal-body">
											<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">
											@if(Auth::user()->group_id==1)
												<div class="form-group">
													<label for=""> Type</label>
													<select class="form-control" name="type">

														@foreach ($user_groups as $user_group)
															<option value="{{ $user_group->name }}">{{ $user_group->name }}</option>
														@endforeach
													</select>
												</div>
											@endif
											@if(Auth::user()->group_id==4)
												<div class="form-group">
													<label for=""> Type</label>
													<input class="form-control" type="text" name="type" value="Supplier" disabled>
												</div>
											@endif
											@if(Auth::user()->group_id==5)
												<div class="form-group">
													<label for=""> Type</label>
													<input class="form-control" type="text" name="type" value="Entrepreneur" disabled>
												</div>
											@endif
											<div class="form-group">
												<label for=""> Title</label>
												<input type="text" name="title" class="form-control">
											</div>
											<div class="form-group">
												<label for=""> Details</label>
												<textarea name="details" id="details" cols="30" rows="10" class="form-control"></textarea>
											</div>
											<div class="form-group">
												<label for=""> Category</label>
												<select class="form-control" name="category">
													@php
	                                                    $categories = DB::table('blog_category')->where('status', 1)->orderBy('cat_name', 'asc')->get();
	                                                @endphp
	                                                @foreach ($categories as $category)
	                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
	                                                @endforeach
												</select>
											</div>

											<div class="form-group">
												<label for="">Sub Category</label>
												<select class="form-control" name="sub_category">
													@php
	                                                    $sub_cats = DB::table('blog_sub_cat')->where('status', 1)->orderBy('sub_cat_name', 'asc')->get();
	                                                @endphp
														<option value=" ">-- Select Option --</option>
	                                                @foreach ($sub_cats as $sub_cat)
	                                                    <option value="{{ $sub_cat->id }}">{{ $sub_cat->sub_cat_name }}</option>
	                                                @endforeach
												</select>
											</div>

											<div class="form-group">
												<label for=""> File</label>
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
									<th>Type</th>
									<th>Title</th>
									<th>Category</th>
									<th>Sub Category</th>
									<th>Status</th>
									<th>Published At</th>
									<th>Images</th>
									<th>Action</th>
								</tr>

								<?php $i=0;?>
								@foreach($blog as $data)
									@php
										$i++;
									@endphp
									<tr>
										<td>{{$i}}</td>
										<td>{!! ucfirst($data->type) !!}</td>
										<td>{{$data->title}}</td>
										<td>
											@php
												$blog_cat = DB::table('blog_category')->where('id', $data->category)->first();
											@endphp

											{{ isset($blog_cat->cat_name) ? $blog_cat->cat_name : '' }}
										</td>
										<td>
											@php
												$blog_cat = DB::table('blog_sub_cat')->where('id', $data->sub_category)->first();
											@endphp

											{{ isset($blog_cat->sub_cat_name) ? $blog_cat->sub_cat_name : '' }}
										</td>

										@if ($data->status==0)
											<td> Unpublish </td>
										@elseif ($data->status==1)
											<td> Publish </td>
										@else
											<td> Pending </td>
										@endif
										<td>{{date('j F,y',strtotime($data->created_at))}}</td>

										<td>
											@if($data->image !=null)<img src="{{url('/')}}/public/images/blog/{{$data->image}}" style="height:50;width: 50px;"> @endif <td>

											<div class="btn-group">
												<button type="button" class="btn btn-info">Action</button>
												<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a href="{{route('blog.edit',$data->id)}}" >Edit</a></li>
													<li><form action="{{route('blog.destroy',$data->id)}}" method="POST">
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
							<!-- /.box-body -->
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
				});

			</script>
		@endsection
	@endsection
