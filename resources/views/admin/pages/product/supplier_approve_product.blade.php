@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
	
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i>  Supplier Product Approved</h3>
                    </div>
                    
					<div class="col-md-3">
					</div>
					<div class="col-md-3 text-right card_header_btn">

					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>
                            <th style="">#</th>
								<th>Supplier Name</th>
								<th>Product Name</th>
								<th> Category</th>
								<th>Product Unit</th>
								<th>Product Price</th>
								<th>Product Quantity</th>
								<th>Status</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($product as $sp)
							@php
							$userSupplier = DB::table('users')->where('id', $sp->user_id)->first();
							@endphp
							@if (isset($userSupplier))
								@if ($userSupplier->group_id == 4)
									<tr>
										<td>{{$i++}}</td>
										@php
										/*$p_cat=DB::table('product_categories')->where('id',$sp->cat_id)->get();
										$p_unit=DB::table('units')->where('id',$sp->unit)->get();*/
										@endphp
										<td>{{$userSupplier->first_name}} {{$userSupplier->last_name}}</td>
										<td>{{$sp->p_name}}</td>
										<td>{{$sp->Category->cat_name ?? null}}</td>
										<td>{{$sp->Unit->unit}}</td>
										<td>{{$sp->price}}</td>
										<td>{{$sp->p_quientity}}</td>
										@if ($sp->status==1)
											<td>Publish</td>
										@elseif ($sp->status==0)
											<td>Unpublish</td>
										@elseif ($sp->status==2)
											<td>Sold Out</td>
										@endif
										<td>

											<div class="btn-group">
												<a class="btn btn-default" href="{{route('product.edit',$sp->id)}}">Edit</a>
											</div>
										</td>
									</tr>
								@endif
							@endif
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

		$(".btn-success").click(function(){
			var html = $(".clone").html();
			$(".increment").after(html);
		});

		$("body").on("click",".btn-danger",function(){
			$(this).parents(".control-group").remove();
		});

		// Summernote Editor
		$('#p_description').summernote({
			height: 200,
		});

		$("#min_quientity, #price").keyup(function(){
	        var minQuientity = $('#min_quientity').val();
	        var unitPrice = $('#price').val();
	        var bundlePrice = minQuientity * unitPrice
	        $('#bundle_price').val(bundlePrice);
	    });
	});

</script>
@endsection
