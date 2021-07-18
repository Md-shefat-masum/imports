@extends('admin.layouts.master')
@section('title','|Hotsale Offer Product')
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
						<h3><i class="fa fa-gg-circle"></i> All Product List</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('hotsaleProduct') }}" class="btn"><i class="fa fa-reply"
								aria-hidden="true"></i>
							Back</a>


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
							<th>Image</th>
							<th> Category</th>
							<th>Product Unit</th>
							<th>Product Price</th>
							<th>Product Quentity</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@forelse($product as $sp)

						@php
						$discountPro = DB::table('discount_products')->where('pro_id', $sp->id)->get();
						@endphp
						@if (count($discountPro)<1) <?php $i++; ?> <tr>
							<td>{{$i}}</td>
							@php
							$val=$sp->image;
							$v=json_decode($val);
							@endphp
							<td>{{$sp->p_name}}</td>
							<td><img src="{{ asset('images/product') }}/{{$v['0']}}" alt="" style="height: 100px;"></td>
							<td>{{$sp->Category->cat_name ?? null}}</td>
							<td>{{$sp->Unit->unit}}</td>
							<td>{{$sp->price}}</td>
							<td>{{$sp->p_quientity}}</td>
							<td style="display: block ruby;">
								<form class="form-inline" action="{{ route('addTohotsale') }}" method="post">
									@csrf
									<input type="hidden" name="pro_id" value="{{$sp->id}}">
									<div class="form-group">
										<select class="form-control" id="sel1" name="status" required>
											<option value="1" selected="">Active</option>
											<option value="0">Inctive</option>
										</select>
									</div>
									<button type="submit" class="btn btn-primary">Make Offer HotSale</button>
								</form>
							</td>
							</tr>

							@endif
							@empty
							<h3>No Product Found Or This Product is already discount</h3>
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