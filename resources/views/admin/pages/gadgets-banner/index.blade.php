@extends('admin.layouts.master')
@section('title','|Gadgets Banner')
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
						<h3><i class="fa fa-gg-circle"></i> All Gadgets Banner</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Gadgets Banner</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('gadgets_banner_store')}}" method="post" id="add_data" enctype="multipart/form-data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Gadgets Banner</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="">Image</label>
												<input type="file" name="image" class="form-control" id="brand" required>
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
							<th>Id</th>
							<th>Image</th>
							<th>Create At</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($value as $data)
						<?php $i++; ?>

						<tr>
							<td>{{$i}}</td>
							<td>{{$data->id}}</td>
							<td><img src="{{ asset('images/slider/'.$data->image) }}" style="height: 50px;"
								alt="">
						</td>
							
							<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('gadgets_banner_edit',$data->id)}}"
										class="btn btn-info view-btn">Edit</a>
									    <a class="btn btn-danger delete-btn">
                                            <form action="{{route('gadgets_banner_destroy',$data->id)}}" method="POST">
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
