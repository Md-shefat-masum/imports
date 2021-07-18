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

	.product-link {
		display: inline-block;
		background: #ffffff;
		border: 1px solid;
		padding: 4px;
		margin: 7px;
		width: 100%;
		word-break: break-all;
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
						<h3><i class="fa fa-gg-circle"></i> Entrepreneur Products for Socialization</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="{{ route('addLink') }}" class="btn"><i class="fa fa-plus-circle"></i> Add
							Product Link</a>


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
							<th>Product Price</th>
							<th>Link</th>
							<th></th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
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
							<td>
								@if (isset($p_cat->cat_name))
								{{ $p_cat->cat_name }}
								@else

								@endif
							</td>
							<td>{{$sp->price}}</td>
							<td>
								<input type="text" class="product-link" id="{!! 'product'.$i !!}"
									value="{{$slider->pro_link}}" />
							</td>
							<td style='vertical-align:middle;'>
								<button class="btn btn-info" onclick="myFunction('{{ 'product'.$i }}')">Copy</button>
							</td>
							<td>
								<form method="POST" action="{{ route('linkDelete', $slider->id) }}"
									accept-charset="UTF-8" style="display:inline">
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

@push('js')
<script>
	function myFunction(id) {
              /* Get the text field */
              console.log(id,$('#'+id),$('#'+id).val());
              var copyText = document.getElementById($('#'+id).attr('id'));
            //   var copyText = $('#'+id);

              /* Select the text field */
              copyText.focus();
              copyText.setSelectionRange(0, 99999); /*For mobile devices*/

              /* Copy the text inside the text field */
              document.execCommand("copy");

              /* Alert the copied text */
              alert("Copied the text: " + copyText.value);
            }
</script>
<style>
	.table-bordered>thead>tr>th,
	.table-bordered>tbody>tr>th,
	.table-bordered>tfoot>tr>th,
	.table-bordered>thead>tr>td,
	.table-bordered>tbody>tr>td,
	.table-bordered>tfoot>tr>td {
		vertical-align: middle;
	}
</style>
@endpush

@endsection