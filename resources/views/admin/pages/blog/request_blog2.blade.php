@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-12 ">
			<div class="box">
                <div class="panel-heading"> Request Blog </div>
				<!-- /.box-header -->
				@if (Session::has('success'))
					<div class="alert alert-info">{{ Session::get('success') }}</div>
				@endif
				@if (Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif
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
								<td>
									@if ($data->status==0)
										Unpublish
									@elseif ($data->status==1)
										Publish
									@else
										Pending
									@endif
								</td>
								<td>
									@if($data->image !=null)
										<img src="{{url('/')}}/public/images/blog/{{$data->image}}" style="height:50;width: 50px;">
									@endif
								</td>
								<td>
									<form method="POST" action="{{ route('approveBlog', $data->id) }}" accept-charset="UTF-8" style="display:inline">
										 @csrf
										 {{ method_field('PUT') }}
										 <button type="submit" class="btn btn-primary btn-sm" title="Approved" onclick="return confirm(&quot;Confirm Approved?&quot;)">Approved</button>
									 </form>
									 <a class="btn btn-primary btn-sm" title="View" href="{{ route('blogDescription', $data->id) }}">View</a>
									<form method="POST" action="{{ route('removeBlog', $data->id) }}" accept-charset="UTF-8" style="display:inline">
										 {{ method_field('DELETE') }}
										 {{ csrf_field() }}
										 <button type="submit" class="btn btn-danger btn-sm" title="Remove From List" onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
									 </form>
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
							<li>{{ $blog->links() }}</li>
						</ul>
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
		// Summernote Editor
		$('#details').summernote({
			height: 200,
		});
	});

</script>
@endsection
