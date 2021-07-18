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

					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

							<th style="">#</th>
							<th>Blog Title</th>
							<th>Comment</th>
							<th>Author</th>
							<th>Status</th>
							<th>Create At</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@php
							$commetnList = DB::table('blog_comments')->paginate(15);
						@endphp
						@foreach($commetnList as $data)
						<?php $i++; ?>
						<tr>
							@php
								$blog = DB::table('blogs')->where('id', $data->blog_id)->first();
							@endphp
							<td>{{$i}}</td>
							<td>{{$blog->title}}</td>
							<td>{{$data->comment}}</td>
							<td>{{$data->author_name}}</td>
							<td>
								@if($data->status == 1)
								{{"Publish"}}
								@else
								{{"Unpublish"}}
								@endif
							</td>
							<td>{{ date("d-m-Y || H:i A", strtotime($data->created_at)) }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm btn-color-ceate">

                                        <a href="" class="btn btn-warning">View</a>
                                        <a href="{{route('commentSectionEdit', $data->id)}}" class="btn btn-success view-btn">Edit</a>
                                        <a class="btn btn-success">
											<form action="{{ route('commentSectionApproved', $data->id)}}" method="POST">
												@method('PUT')
												{{csrf_field()}}
												<button class="" style="
                                                background: none;
                                                border: none;
                                                color: #ffffff;
                                                text-align: center;
                                                
                                            ">Approved</button>
                                            </form>
										</a>
										<a class="btn btn-danger">
											<form action="{{ route('commentSectionDelete', $data->id)}}" method="POST">
											@method('DELETE')
											{{csrf_field()}}
											 <button class="" style="
												background: none;
												border: none;
												color: #fff;
												text-align: center;
											">Delete</button>
										 </form></a>
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
