@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('success'))

		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> Request Blog</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">

						
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
										<img src="{{url('/')}}/images/blog/{{$data->image}}" style="height:50; width: 50px;">
									@endif
								</td>
								<td style="display: inline-flex;">
									<form method="POST" action="{{ route('approveBlog', $data->id) }}" accept-charset="UTF-8" style="display:inline">
										 @csrf
										 {{ method_field('PUT') }}
										 <button type="submit" class="btn btn-success" title="Approved" onclick="return confirm(&quot;Confirm Approved?&quot;)">Approved</button>
									 </form>
									 <a class="btn btn-info" title="View" href="{{ route('blogDescription', $data->id) }}">View</a>
									<form method="POST" action="{{ route('removeBlog', $data->id) }}" accept-charset="UTF-8" style="display:inline">
										 {{ method_field('DELETE') }}
										 {{ csrf_field() }}
										 <button type="submit" class="btn btn-danger" title="Remove From List" onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
									 </form>
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
