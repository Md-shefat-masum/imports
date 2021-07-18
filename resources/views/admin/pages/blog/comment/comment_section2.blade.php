@extends('admin.layouts.master')
@section('title','|menus')
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
				<h3 class="box-title">Comment Section</h3>
				<!-- modal start -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered">
					<tr>
						<th style="">#</th>
						<th>Blog Title</th>
						<th>Comment</th>
						<th>Author</th>
						<th>Status</th>
						<th>Create At</th>
						<th>Action</th>
					</tr>
					<?php $i=0; ?>
                    @php
                        $commetnList = DB::table('blog_comments')->paginate(15);
                    @endphp
					@foreach($commetnList as $data)
					<?php $i++; ?>
					<tr>
                        @php
                            $blog = DB::table('blogs')->where('id', $data->blog_id)->first();
                        @endphp
						<td>{{$i}}</td>
						<td>{{$blog->title}}</td>
						<td>{{$data->comment}}</td>
						<td>{{$data->author_name}}</td>
						<td>
							@if($data->status == 1)
							{{"Publish"}}
							@else
							{{"Unpublish"}}
							@endif
						</td>
						<td>{{ date("d-m-Y || H:i A", strtotime($data->created_at)) }}</td>

						<td>
                            <div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="">View</a></li>
									<li><a href="{{route('commentSectionEdit', $data->id)}}">Edit</a></li>
									<li>
										<form action="{{ route('commentSectionApproved', $data->id)}}" method="POST">
	            						@method('PUT')
	            						{{csrf_field()}}
	                					 <button class="" style="
	                                        background: none;
	                                        border: none;
	                                        color: #333;
	                                        text-align: center;
	                                        padding-left: 20px;
	                                    ">Approved</button>
	            					 </form>
									</li>
									<li><form action="{{ route('commentSectionDelete', $data->id)}}" method="POST">
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
					<li>{{ $commetnList->links() }}</li>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection
@section('scripts')

@endsection
