@extends('admin.layouts.master')
@section('title','|menus')

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
						<h3><i class="fa fa-gg-circle"></i> All Product</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Product</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('product.store')}}" method="post" id="add_data" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Product</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="">Product Category</label>
												<select name="cat_id" id="" class="form-control" required>
													<option value="">Select Category</option>
													@foreach($category as $c)
														<option value="{{$c->id}}">{{$c->cat_name}}</option>
													@endforeach
												</select>
											</div>
	
											<div class="form-group">
												<label for="">Sub Category</label>
												<select name="sub_cat_id" id="" class="form-control" required>
													<option value="">Select Sub Category</option>
													@foreach($subCategory as $c)
														<option value="{{$c->id}}">{{$c->name}}</option>
													@endforeach
												</select>
											</div>
	
											<div class="form-group">
												<label for="">Product Name</label>
												<input type="text" name="p_name" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Unit</label>
												<select name="unit" id="" class="form-control" required>
	
													@foreach($unit as $u)
														<option value="{{$u->id}}">{{$u->unit}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="">Product Description</label>
												<textarea name="p_description" id="p_description" cols="30" rows="10" class="form-control" required></textarea>
											</div>
											<div class="form-group">
												<label for="">Product Link Share</label>
												<input type="text" name="link" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Quantity</label>
												<input type="text" name="p_quientity" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Bundle Quantity</label>
												<input type="number" name="min_quientity" id="min_quientity" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Unit Price</label>
												<input type="number" name="price" id="price" class="form-control" required>
											</div>
	
											<div class="form-group">
												<label for="">Bundle Price</label>
												<input type="number" name="bundle_price" id="bundle_price" class="form-control" required>
											</div>
	
											<div class="form-group">
												<label for="">Product Model</label>
												<input type="text" name="model" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Brand</label>
												<select name="brand" id="" class="form-control" required>
	
													@foreach($brand as $c)
													<option value="{{$c->id}}">{{$c->brand}}</option>
												@endforeach
												</select>
											</div>
										
	
											@if (Auth::user()->group_id == '1')
												<div class="form-group">
													<label for="">Product Status</label>
													<select name="status" id="" class="form-control" required>
														<option value="1">Publish</option>
														<option value="0">Unpublish</option>
														<option value="2">Sold Out</option>
													</select>
												</div>
											@endif
											@if (Auth::user()->group_id == 4 || Auth::user()->group_id == 5)
												<div class="form-group">
													<label for="">Product Status</label>
													<select class="form-control" required>
														<option>Submit</option>
													</select>
												</div>
											@endif
	
											@if (Auth::user()->group_id == 5 || Auth::user()->group_id == 4)
											<input type="hidden" name="status" value="0">
											@endif
	
											<div class="input-group control-group increment" >
												<input type="file" name="image[]" class="form-control">
												<div class="input-group-btn">
													<button class="btn btn-info" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
												</div>
											</div>
											<div class="clone hide">
												<div class="control-group input-group" style="margin-top:10px">
													<input type="file" name="image[]" class="form-control">
													<div class="input-group-btn">
														<button class="btn btn-danger" type="button"><i class="fa fa-remove" aria-hidden="true"></i> Remove</button>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">

											<button type="submit" class="btn btn-secondary modal-close-btn"
												data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary modal-delete-btn">Save
												changes</button>
										</div>
									</div>
									<!-- /.modal-content -->

								</div>
							</form>
							<!-- /.modal-dialog -->
						</div>
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
								<th>Status</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($product as $sp)
							<?php $i++; ?>

						<tr>
							<td>{{$i}}</td>
							
							<td>{{$sp->p_name}}</td>
							<td>{{$sp->Category->cat_name ?? null}}</td>
							<td>{{$sp->Unit->unit}}</td>
							<td>{{$sp->bundle_price}}</td>
							<td>{{$sp->p_quientity}}</td>
							<td>
								@if ($sp->status == 1)
									Publish
								@elseif ($sp->status == 0)
									Unpublish
								@elseif ($sp->status == 2)
									Sold Out
								@endif
							</td>

							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('product.edit',$sp->id)}}" class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{url('/pages/product',$sp->id)}}" method="POST">
											@method('DELETE')
											{{csrf_field()}} <button class="" style="
											background: none;
											border: none;
											color: #ffffff;
											text-align: center;
											
										">Delete</button>
										</form>
									</a>
								</div>
							</td>
						</tr>

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

		$(".btn-info").click(function(){
			var html = $(".clone").html();
			$(".increment").after(html);
		});

		$("body").on("click",".btn-danger",function(){
			$(this).parents(".control-group").remove();
		});

		// Summernote Editor
		// $('#p_description').summernote({
		// 	height: 200,
		// });

		$("#min_quientity, #price").keyup(function(){
			console.log('ok');
	        var minQuientity = $('#min_quientity').val();
	        var unitPrice = $('#price').val();
	        var bundlePrice = minQuientity * unitPrice
	        $('#bundle_price').val(bundlePrice);
			
	    });
	
	});

</script>
@endsection
