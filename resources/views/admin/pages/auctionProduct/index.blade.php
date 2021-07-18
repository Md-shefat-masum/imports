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
		@if(session()->has('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div>
		@endif
		@if(session()->has('danger'))
		<div class="alert alert-danger">
			{{ session()->get('danger') }}
		</div>
		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Current Auction</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('addAuction') }}" class="btn"><i class="fa fa-plus-circle"></i> Add Current
							Auction</a>


					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>
							<th style="">#</th>
							<th>Product Name</th>
							<th> Category</th>
							<th>Product Unit</th>
							<th>Product Price</th>
							<th>Product Quantity</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@forelse($sliders as $slider)
							@php
								$sp = DB::table('products')->where('id', $slider->product_id)->first();
							@endphp
							<?php $i++; ?>
							@if (isset($sp))
							<tr>
								<td>{{$i}}</td>
								@php
									$p_cat=DB::table('product_categories')->where('id',$sp->cat_id)->first();
									$p_unit=DB::table('units')->where('id',$sp->unit)->first();
								@endphp
								<td>{{$sp->p_name}}</td>
								<td>
									@if (isset($p_cat->cat_name))
										{{$p_cat->cat_name }}
									@endif
								</td>
								<td>{{$p_unit->unit}}</td>
								<td>{{$sp->price}}</td>
								<td>{{$sp->p_quientity}}</td>
								<td>
									<form method="POST" action="{{ route('auctionDelete', $slider->id) }}" accept-charset="UTF-8" style="display:inline">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<button type="submit" class="btn btn-danger" title="Remove From List" onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
									</form>
								</td>

							</tr>
							@endif
						@empty
							No Current Auction
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
