@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">

		@if (Session::has('success'))
		<div class="alert alert-info">{{ Session::get('success') }}</div>
		@endif
		@if (Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> Forum</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add New post</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('blog.store')}}" method="post" id="add_data"
								enctype="multipart/form-data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Write Your Forum</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										@php
										$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
										@endphp
										<div class="modal-body text-left">

											<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">
											@if(Auth::user()->group_id==1)
											<div class="form-group">
												<label for=""> Type</label>
												<select class="form-control" name="type">

													@foreach ($user_groups as $user_group)
													<option value="{{ $user_group->name }}">{{ $user_group->name }}
													</option>
													@endforeach
												</select>
											</div>
											@endif
											@if(Auth::user()->group_id==4)
											<div class="form-group">
												<label for=""> Type</label>
												<input class="form-control" type="text" name="type" value="Supplier"
													disabled>
											</div>
											@endif
											@if(Auth::user()->group_id==5)
											<div class="form-group">
												<label for=""> Type</label>
												<input class="form-control" type="text" name="type" value="Entrepreneur"
													disabled>
											</div>
											@endif
											<div class="form-group">
												<label for=""> Title</label>
												<input type="text" name="title" class="form-control">
											</div>
											<div class="form-group">
												<label for=""> Details</label>
												<textarea name="details" id="my-editor" cols="30" rows="10"
													class="form-control"></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor', options);
												</script>
											</div>
											<div class="form-group">
												<label for=""> Category</label>
												<select class="form-control" name="category">
													@php
													$categories = DB::table('blog_category')->where('status',
													1)->orderBy('cat_name', 'asc')->get();
													@endphp
													@foreach ($categories as $category)
													<option value="{{ $category->id }}">{{ $category->cat_name }}
													</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label for="">Sub Category</label>
												<select class="form-control" name="sub_category">
													@php
													$sub_cats = DB::table('blog_sub_cat')->where('status',
													1)->orderBy('sub_cat_name', 'asc')->get();
													@endphp
													<option value=" ">-- Select Option --</option>
													@foreach ($sub_cats as $sub_cat)
													<option value="{{ $sub_cat->id }}">{{ $sub_cat->sub_cat_name }}
													</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label for=""> File</label>
												<input type="file" name="image" class="form-control">
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
							<th>Type</th>
							<th>Title</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Status</th>
							<th>Published At</th>
							<th>Images</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
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
								@if($data->image !=null)<img src="{{url('/')}}/images/blog/{{$data->image}}"
									style="height:50;width: 50px;"> @endif
							</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('blog.edit',$data->id)}}" class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{route('blog.destroy',$data->id)}}" method="POST">
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
				});

</script>
@endsection
@endsection