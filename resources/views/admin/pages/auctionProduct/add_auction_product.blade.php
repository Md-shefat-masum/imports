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
	
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Product List</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('auctionProduct') }}" class="btn"><i class="fa fa-reply"
								aria-hidden="true"></i>
								Back To Auction Product</a>


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
						@forelse($product as $sp)
			
							@php
								$sliderPro = DB::table('current_auction_product')->where('product_id', $sp->id)->get();
							@endphp
							@if (count($sliderPro)<1)
								<?php $i++; ?>
								<tr>
									<td>{{$i}}</td>
									@php
								  /*$p_cat=DB::table('product_categories')->where('id',$sp->cat_id)->get();
								  $p_unit=DB::table('units')->where('id',$sp->unit)->get();*/
								  @endphp
									<td>{{$sp->p_name}}</td>
									<td>{{$sp->Category->cat_name ?? null}}</td>
									<td>{{$sp->Unit->unit}}</td>
									<td>{{$sp->price}}</td>
									<td>{{$sp->p_quientity}}</td>
									<td>
										<form class="form-inline" action="{{ route('addToAuction') }}" method="post" style="display: inline-block;">
											@csrf
											<input type="hidden" name="pro_id" value="{{$sp->id}}">
											<button type="submit" class="btn btn-info">Make Auction</button>
										</form>
									</td>
			
								</tr>
							@endif
						@empty
							<h3>No Product Found Or This Product is already Special</h3>
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
