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

    @if(Session::has('danger'))

        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('danger') }}
        </div>

    @endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> All News Feed</h3>
                        <p>Please publish less than 6</p>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							News Feed</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
                            <form action="{{route('news-feed.store')}}" method="post" id="add_data" enctype="multipart/form-data">
                                @csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Add News Feed</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">


                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" id="menu" required  placeholder="Enter title">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Link</label>
                                                <input type="url" name="link" class="form-control" id="link" required  placeholder="Enter link">

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

                            <th>#</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Status</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
                                @forelse ($newsFeeds as $items)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $items->title }}</td>
                                        <td style="word-break: break-all;">{{ $items->link }}</td>
                                        <td>
                                            @if ($items->status == 1)
                                                Publish
                                            @else
                                                Unpublish
                                            @endif
                                        </td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{ route('news-feed.edit', $items->id) }}" class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{ route('news-feed.destroy', $items->id) }}" method="POST">
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