@extends('admin.layouts.master')
@section('title','|discount Product')
@section('stylesheet')
<style media="screen">
	form.example input[type=text] {
		padding: 5px;
		padding-left: 15px;
		font-size: 17px;
		border: 1px solid grey;
		float: left;
		width: 80%;
		background: #f1f1f1;
	}

	form.example button {
		float: left;
		width: 20%;
		padding: 5px;
		background: #2196F3;
		color: white;
		font-size: 17px;
		border: 1px solid grey;
		border-left: none;
		cursor: pointer;
	}

	form.example button:hover {
		background: #0b7dda;
	}

	form.example::after {
		content: "";
		clear: both;
		display: table;
	}
</style>
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
						<h3><i class="fa fa-gg-circle"></i> All Popup</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('addblogpopup') }}" class="btn"><i class="fa fa-plus-circle"></i> Add Popup</a>


					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

							<th style="">#</th>
							<th>Blog</th>
							<th>Image</th>

							<th>Status</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@forelse($popup as $bg)
						@php
						//  $product = Blog::where('category',34)->where('sub_category',59)->where('status',1)->orderBy('add_to_latest','DESC')->get();
						$sp = DB::table('blogs')->where('id', $bg->blog_id )->first();
						@endphp
						<?php $i++; ?>

						<tr>
							<td>{{$i}}</td>
						
							<td>{{$sp->title}}</td>
							<td><img src="/images/blog/{{$sp->image}}" alt="" style="height: 100px;"></td>

						
							<td>
								<form class="form-inline" action="{{ route('editblogpopup') }}" method="post"
									style="display: inline;">
									@csrf
									@method('PUT')
									<input type="hidden" name="blog_id" value="{{ $sp->id }}">
									<div class="form-group">
										<select class="form-control" id="sel1" name="status" required>
											<option value="1"
												{{ ($bg->blog_position == 1)? 'selected' : '' }}>Active
											</option>
											<option value="0"
												{{ ($bg->blog_position == 0)? 'selected' : '' }}>
												Inactive</option>
										</select>
									</div>
									<button type="submit" class="btn btn-primary">Update</button>
								</form>

							</td>
							<td>
								<form method="POST" action="{{ route('blogpopupDelete', $bg->id) }}"
									accept-charset="UTF-8" style="display:inline">
									{{ method_field('DELETE') }}
									{{ csrf_field() }}
									<button type="submit" class="btn btn-danger" title="Remove From List"
										onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
								</form>
							</td>
						</tr>
						@empty
						No discount
						@endforelse
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

</script>
@endsection