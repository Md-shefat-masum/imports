@extends('admin.layouts.master')
@section('title','|Discount')
@section('stylesheet')
<link href="{{asset('admin/assets/plugins/datepicker/datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('success'))

		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i>Successfully</h4>
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Discount</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Discount</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('discount_store')}}" method="post" id="add_data"
								enctype="multipart/form-data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Discount</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="">title</label>
												<input type="text" name="title" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Category</label>


												<select name="category" class="form-control">
													<option value="">Select Category</option>
													@php
													$cat=App\HomeProductCategory::orderBy("id","DESC")->get();
													@endphp
													@foreach ($cat as $item)
													@php
													$spp=DB::table('product_categories')->where('id',$item->cat_id)->first();
													@endphp

													<option value="{{$item->cat_id}}">{{$spp->cat_name ?? Null}}
													</option>
													@endforeach

												</select>
											</div>
											<div class="form-group">
												<label for="">details</label>
												<textarea name="details" id="my-editor2" cols="30" rows="10"
													class="form-control"></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor2', options);
												</script>
											</div>
											<div class="form-group">
												<label for="">Discount</label>
												<input type="number" name="discount" class="form-control">
											</div>
											<div class="form-group">
												<label for="birthdaytime">Discount Start:</label>
												<input type="datetime-local" id="birthdaytime" name="discount_start">
											</div>
											<div class="form-group">
												<label for="birthdaytime">Discount End:</label>
												<input type="datetime-local" id="birthdaytime" name="discount_end">
											</div>


											<div class="form-group">
												<label for="">Image</label>
												<input type="file" name="image" class="form-control" id="brand"
													required>
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
							<th>Title</th>
							<th>Category</th>
							<th>Discount</th>
							<th>Discount Start</th>
							<th>Discount End</th>
							<th>Details</th>
							<th>Image</th>
							<th>Create At</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>

						<?php $i=0; ?>
						@foreach($value as $data)
						<?php $i++; ?>
						@php
						$sp = DB::table('product_categories')->where('id', $data->category)->first();
						@endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{$data->title}}</td>
							<td>{{$sp->cat_name ?? Null}}</td>
							{{-- <td>{{$data_}}</td> --}}
							<td>{{$data->discount}} %</td>
							<td>{{date('M j,Y h:ia',strtotime($data->discount_start))}}</td>
							<td>{{date('M j,Y h:ia',strtotime($data->discount_end))}}</td>
							<td>{!!$data->details!!}</td>
							<td><img src="{{ asset('images/slider/'.$data->image) }}" style="height: 50px;" alt="">
							</td>

							<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('discount_edit',$data->id)}}"
										class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{route('discount_destroy',$data->id)}}" method="POST">
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
<script src="{{asset('admin/assets/plugins/datepicker/datepicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datepicker/i18n/datepicker.en.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/custom-form-datepicker.js')}}"></script>
@endsection