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
	<a href="{{ route('addSlider') }}" class="btn btn-primary">Add Slider</a>
	<br>
	<br>
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
	<div class="table-responsive">
		<table class="table table-bordered">
			<h3>All slider product list</h3>
			<tr>
				<th style="">#</th>
				<th>Product Name</th>
				<th> Category</th>
				<th>Product Unit</th>
				<th>Product Price</th>
				<th>Product Quantity</th>
				<th>Action</th>
			</tr>
			<?php $i=0; ?>
			@forelse($sliders as $slider)
			@php
			$sp = DB::table('products')->where('id', $slider->pro_id)->first();
			@endphp
			<?php $i++; ?>
			<tr>
				<td>{{$i}}</td>
				@php
				$p_cat=DB::table('product_categories')->where('id',$sp->cat_id)->first();
				$p_unit=DB::table('units')->where('id',$sp->unit)->first();
				@endphp
				<td>{{$sp->p_name}}</td>
				<td>{{$p_cat->cat_name }}</td>
				<td>{{$p_unit->unit}}</td>
				<td>{{$sp->price}}</td>
				<td>{{$sp->p_quientity}}</td>
				<td>
					<form class="form-inline" action="{{ route('editSlider') }}" method="post" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name="pro_id" value="{{ $sp->id }}">
						<input type="hidden" name="slider_id" value="{{ $slider->id }}">
						<div class="form-group">
							<select class="form-control" id="sel1" name="status" required>
								<option value="1" {{ ($slider->slider_position == 1)? 'selected' : '' }}>Up</option>
								<option value="0" {{ ($slider->slider_position == 0)? 'selected' : '' }}>Down</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Update</button>
					</form>
					<form method="POST" action="{{ route('sliderDelete', $slider->id) }}" accept-charset="UTF-8"
						style="display:inline">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-danger" title="Remove From List"
							onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
					</form>
				</td>

			</tr>
			@empty
			No Slider
			@endforelse
		</table>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="container">
				{{ $sliders->links() }}
			</div>
		</div>
	</div>
</div>
<!-- /.box-body -->

@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection