@extends('admin.layouts.master')
@section('title','|Slider Product')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-12 ">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Slider Product
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
							Add Slider Product
						</button>
					</h3>
					<!-- modal start -->
					<div class="modal modal-success fade" id="modal-success">
						<div class="modal-dialog">
							<form action="{{route('slider_product.store')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Slider Product </h4>
										</div>
										<div class="modal-body">

											<div class="form-group">
												<label for="">Product Category</label>
												<select name="cat_id" id="" class="form-control" required>
													<option disabled="">Select Category</option>
													@foreach($category as $c)
														<option value="{{$c->id}}">{{$c->cat_name}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="">Sub Category</label>
												<select name="sub_cat" id="" class="form-control" required>
													<option value="">Select Sub Category</option>
													@foreach($subCategory as $c)
														<option value="{{$c->id}}">{{$c->name}}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label for="">Product Unit</label>
												<select name="unit" id="" class="form-control" required>
													<option disabled="">Select Category</option>
													@foreach($unit as $u)
														<option value="{{$u->id}}">{{$u->unit}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="">Slider Position</label>
												<select name="slider_position" id="" class="form-control" required>
													<option value="1">Up</option>
													<option value="0">Down</option>

												</select>
											</div>

											<div class="form-group">
												<label for="">Product Name</label>
												<input type="text" name="p_name" class="form-control" required>
											</div>

											<div class="form-group">
												<label for="">Product Description</label>
												<textarea name="p_description" id="" cols="30" rows="10" class="form-control" required></textarea>
											</div>
											<div class="form-group">
												<label for="">Product link</label>
												<input type="text" name="link" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Quintity</label>
												<input type="text" name="p_quientity" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Price</label>
												<input type="number" name="price" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product status</label>
												<select name="status" id="" class="form-control" required>
													<option value="1">Publish</option>
													<option value="0">Unpublish</option>
													<option value="2">Sold Out</option>
												</select>
											</div>

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
										<th>Product Quentity</th>
										<th>Action</th>
									</tr>
									<?php $i=0; ?>
									@foreach($sliderProduct as $sp)
										<?php $i++; ?>
										<tr>
											<td>{{$i}}</td>
											@php
											$p_cat=DB::table('product_categories')->where('id',$sp->cat_id)->get();
											$p_unit=DB::table('units')->where('id',$sp->unit)->get();

											@endphp
											<td>{{$sp->p_name}}</td>
											@foreach($p_cat as $pc)
												<td>{{$pc->cat_name}}</td>
											@endforeach
											@foreach($p_unit as $pu)
												<td>{{$pu->unit}}</td>
											@endforeach
											<td>{{$sp->price}}</td>
											<td>{{$sp->p_quientity}}</td>
											<td>

												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#">View</a></li>
														<li><a href="{{route('slider_product.edit',$sp->id)}}">Edit</a></li>
														<li><form action="{{url('/pages/slider_product',$sp->id)}}" method="POST">
															@method('DELETE')
															{{csrf_field()}}
															<button class="" style="
															background: none;
															border: none;
															color: #333;
															text-align: center;
															padding-left: 20px;
															">Delete</button>
														</form></li>

													</ul>
												</div>
											</td>

										</tr>

									@endforeach
								</table>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer clearfix">
							<ul class="pagination pagination-sm no-margin pull-right">

							</ul>
						</div>
					</div>
					<!-- /.box -->
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

		});

	</script>
@endsection
