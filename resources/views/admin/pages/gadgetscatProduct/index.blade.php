@extends('admin.layouts.master')
@section('title','|Slider Product')
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
						<h3><i class="fa fa-gg-circle"></i> Gadgets Product Category</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('addGadgetscat') }}" class="btn"><i class="fa fa-plus-circle"></i> Add
							Gadgets Product Category</a>


					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

							<th style="">#</th>
							<th>Category Name</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@forelse($homecats as $slider)
						@php
						$sp = DB::table('product_categories')->where('id', $slider->cat_id)->first();
						@endphp
						<?php $i++; ?>

						<tr>
							<td>{{$i}}</td>
							{{-- @php
							$p_cat=DB::table('subcategories')->where('id',$sp->cat_id)->first();
							$p_unit=DB::table('units')->where('id',$sp->unit)->first();
							@endphp --}}
							{{-- <td>{{$sp->p_name}}</td> --}}
							<td>{{$sp->cat_name }}</td>
							{{-- <td>{{$p_unit->unit}}</td>
							<td>{{$sp->price}}</td>
							<td>{{$sp->p_quientity}}</td> --}}


							<td style="display: block ruby;">
								<form class="form-inline" action="{{ route('editGadgetscat') }}" method="post"
									style="display: inline;">
									@csrf
									@method('PUT')
									<input type="hidden" name="cat_id" value="{{ $sp->id }}">
									{{-- <input type="hidden" name="slider_id" value="{{ $slider->id }}"> --}}
									<div class="form-group">
										<select class="form-control" id="sel1" name="cat_status" required>
											<option value="1" {{ ($slider->cat_status == 1)? 'selected' : '' }}>Published
												
											</option>
											<option value="0" {{ ($slider->cat_status == 0)? 'selected' : '' }}>
												Unpublished</option>
										</select>
									</div>
									<button type="submit" class="btn btn-primary">Update</button>
								</form>
								<form method="POST" action="{{ route('GadgetscatDelete', $slider->id) }}"
									accept-charset="UTF-8" style="display:inline">
									{{ method_field('DELETE') }}
									{{ csrf_field() }}
									<button type="submit" class="btn btn-danger" title="Remove From List"
										onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
								</form>
							</td>
						</tr>
						@empty
						No Gadgets Product
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