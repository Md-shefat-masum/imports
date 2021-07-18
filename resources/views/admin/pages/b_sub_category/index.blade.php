@extends('admin.layouts.master')
@section('title','|menus')
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
						<h3><i class="fa fa-gg-circle"></i> All Forums SubCategory</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Forums SubCategory</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{ route('b_sub_category_store')}}" method="post" id="add_data"
								enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Add Forums SubCategory</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

                                            <div class="form-group">
                                                <select class="form-control" name="cat_id">
                                                    @php
                                                        $categories = DB::table('blog_category')->where('status', 1)->orderBy('cat_name', 'asc')->get();
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Forums SubCategory</label>
                                                <input type="text" name="sub_cat_name" class="form-control" required>
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
                            <th>Sub Categroy Name</th>
                            <th>Categroy Name</th>
                            <th>SubCategroy Status</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
                        <?php $i = 0;?>
                        @foreach($cat as $data)
                            <?php $i++;?>
                            @php
                                $main_cat = DB::table('blog_category')->where('id', $data->cat_id)->first();
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->sub_cat_name}}</td>
                                <td>
                                    @if (isset($main_cat))
                                        {{$main_cat->cat_name}}
                                    @endif
                                </td>
                                <td>{{ ($data->status == 1) ? 'Publish' : 'Unpublish' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm btn-color-ceate">

                                        <a href="{{route('b_sub_category_edit',$data->id)}}" class="btn btn-info view-btn">Edit</a>
                                        <a class="btn btn-danger delete-btn">
                                            <form action="{{route('b_sub_category_destroy',$data->id)}}" method="POST">
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

@section('scripts')
@endsection
@endsection
