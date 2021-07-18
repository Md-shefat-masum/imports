@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-12 ">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">
                        Enterprenor Product Approved
					</h3>

				<!-- modal end -->
				</div>

				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th style="">#</th>
								<th>Product Name</th>
								<th> Category</th>
								<th>Product Unit</th>
								<th>Product Price</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php $i=0; ?>
							@foreach($product as $sp)
								<?php $i++; ?>
								@php
								$userSupplier = DB::table('users')->where('id', $sp->user_id)->first();
								@endphp
								@if (isset($userSupplier))
									@if ($userSupplier->group_id == 5)
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
											@if ($sp->status==1)
												<td>Publish</td>
											@elseif ($sp->status==0)
												<td>Unpublish</td>
											@elseif ($sp->status==2)
												<td>Sold Out</td>
											@endif
											<td>

												<div class="btn-group">
													<form action="{{ route('supplierApproveUpdate', $sp->id) }}" method="POST" style="display: inline-block;">
														@csrf
														@method('PUT')
														<input type="hidden" name="status" value="1">
														<button class="btn btn-info">Approved</button>
													</form>
													<a class="btn btn-default" href="{{route('product.edit',$sp->id)}}">Edit</a>
													<a class="btn btn-default" href="#">View</a>
													<form action="{{url('/pages/product',$sp->id)}}" method="POST" style="display: inline-block;">
														@method('DELETE')
														{{csrf_field()}}
														<button class="btn btn-danger">Delete
														</button>
													</form>
												</div>
											</td>
										</tr>
									@endif
								@endif

							@endforeach
						</table>
						{{ $product->links() }}
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
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
