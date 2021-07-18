@extends('admin.layouts.master')
@section('title','|menus')
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
	<br><br>
	<div class="row">
		<div class="col-md-12 ">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="display: block;">
						<a href="{{ route('product.index') }}">Submited Product List</a>

						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success" style="float:right;">
							Add Product
						</button>
					</h3>
					<br>
			        <br>
			        <form class="example" action="{{ route('searchProduct') }}" style="margin:auto;max-width:300px" method="post">
			            @csrf
			            <input type="text" placeholder="Search product.." name="search">
			            <button type="submit"><i class="fa fa-search"></i></button>
			        </form>
					<!-- modal start -->
					<div class="modal modal-success fade" id="modal-success">
						<div class="modal-dialog">
							<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Product</h4>
									</div>

									<div class="modal-body">
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
											<input type="text" name="brand" class="form-control"  >
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
												<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
											</div>
										</div>
										<div class="clone hide">
											<div class="control-group input-group" style="margin-top:10px">
												<input type="file" name="image[]" class="form-control">
												<div class="input-group-btn">
													<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-outline">Save changes</button>
										</div>
									</div>
								</div>
								<!-- /.modal-content -->
							</form>
						</div>
						<!-- /.modal-dialog -->
					</div>
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
								<th>Product Quantity</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php $i=0; ?>
							@foreach($product as $sp)
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

										<div class="btn-group">
											<button type="button" class="btn btn-info">Action</button>
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">View</a></li>
												<li><a href="{{route('product.edit',$sp->id)}}">Edit</a></li>
												<li>
													<form action="{{url('/pages/product',$sp->id)}}" method="POST">
														@method('DELETE')
														{{csrf_field()}}
														<button class="" style="
															background: none;
															border: none;
															color: #333;
															text-align: center;
															padding-left: 20px;
															">Delete
														</button>
													</form>
												</li>
												<li>
													
												</li>
											</ul>
										</div>
										<input type="text" class="form-control" style="opacity:0;height:0;" value="https://www.freeworldimports.com/porduct_details/{{$sp->id}}" id="change_url{{$sp->id}}">
										<button type="button" onclick="myFunction{{$sp->id}}()">Copy Share Link</button>
										<script>
                                            function myFunction{{$sp->id}}() {
                                                var copyText = document.getElementById("change_url{{$sp->id}}");
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999);
                                                document.execCommand("copy");
                                                alert("Copied the text: " + copyText.value);
                                            }
                                        </script>
								</td>
							</tr>
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
