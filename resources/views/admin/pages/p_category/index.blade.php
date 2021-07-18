@extends('admin.layouts.master')
@section('title','|p_category')
@section('stylesheet')
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
						<h3><i class="fa fa-gg-circle"></i> All Product Category</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Product Category</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('p_category.store')}}" method="post" id="add_data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Add Product Category</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">


											<div class="form-group">
												<label for="">Product Category</label>
												<input type="text" name="cat_name" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Product Sub Category</label>
												<select name="sub_cat" id="" class="form-control" required>
													<option value="">Select Category</option>
													@foreach($subCategory as $c)
													<option value="{{$c->id}}">{{$c->name}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="">Category Description</label>
												<textarea name="cat_description" id="my-editor" cols="30" rows="10"
													class="form-control" required></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
															width: "100%",
														};
														CKEDITOR.replace('my-editor', options);
												</script>
											</div>
											<div class="form-group">
												<label for="">Status</label>
												<select name="status" id="" class="form-control" required>
													<option value="">Select Status</option>
													<option value="1">Publish</option>
													<option value="0">Unpublish</option>
												</select>
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
							<th>Categroy Name</th>
							<th>Categroy Description</th>
							<th>Categroy Status</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						@foreach($cat as $data)
						<?php $i++;?>

						<tr>
							<td>{{$i}}</td>
							<td>{{$data->cat_name}}</td>
							<td><a href="">{{$data->cat_description}}</a></td>
							<td>{{$data->status}}</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('p_category.edit',$data->id)}}"
										class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{url('pages/p_category',$data->id)}}" method="POST">
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
@endsection