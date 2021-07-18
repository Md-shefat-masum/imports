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
<div class="box-body">
	<a href="{{ route('sliderProduct') }}" class="btn btn-primary">Back to slider</a>
	<br>
	<br>
	<form class="example" action="{{ route('proSlider') }}" style="margin:auto;max-width:300px" method="post">
		@csrf
		<input type="text" placeholder="Search product.." name="search">
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
	<div class="table-responsive">
		<table class="table table-bordered">
			<h3>All Product list</h3>
			<tr>
				<th style="">#</th>
				<th>Product Name</th>
				<th> Category</th>
				<th>Product Unit</th>
				<th>Product Price</th>
				<th>Product Quentity</th>
				<th>Action</th>
			</tr>
			<?php $i=0; ?>
			@forelse($product as $sp)

			@php
			$sliderPro = DB::table('slider_products')->where('pro_id', $sp->id)->get();
			@endphp
			@if (count($sliderPro)<1) <?php $i++; ?> <tr>
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
					<form class="form-inline" action="{{ route('addToSlider') }}" method="post"
						style="display: inline-block;">
						@csrf
						<input type="hidden" name="pro_id" value="{{$sp->id}}">
						<div class="form-group">
							<select class="form-control" id="sel1" name="status" required>
								<option value="1" selected="">Up</option>
								<option value="0">Down</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Make Slider</button>
					</form>
				</td>

				</tr>
				@endif
				@empty
				<h3>No Product Found Or This Product is already slider</h3>
				@endforelse

		</table>
		@if (class_basename($product) !== 'Collection')
		{{ $product->links() }}
		@endif
	</div>
</div>
<!-- /.box-body -->

@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection