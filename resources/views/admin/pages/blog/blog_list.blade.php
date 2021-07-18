@extends('admin.layouts.master')
@section('title','|Blog')
@section('stylesheet')
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">

		@if (Session::has('success'))
		<div class="alert alert-info">{{ Session::get('success') }}</div>
		@endif
		@if (Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> Blog List</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">

					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

                            <th style="">#</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Status</th>
                            <th>Images</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
                        <?php $i=0;?>
                        @foreach($blog as $data)
                        @php
                        $i++;
                        @endphp
                        @if ($data->status==1)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{!! ucfirst($data->type) !!}</td>
                            <td>{{$data->title}}</td>
                            <td>
                                @php
                                    $blog_cat = DB::table('blog_category')->where('id', $data->category)->first();
                                @endphp
                                {{ isset($blog_cat->cat_name) ? $blog_cat->cat_name : '' }}
                            </td>

                            <td>
                                @php
                                    $blog_cat = DB::table('blog_sub_cat')->where('id', $data->sub_category)->first();
                                @endphp
                                {{ isset($blog_cat->sub_cat_name) ? $blog_cat->sub_cat_name : '' }}
                            </td>

                            <td>{{ ($data->status==0) ? 'Unpublish' : 'Publish' }}</td>
                            <td>
                                @if($data->image !=null)<img src="{{url('/')}}/images/blog/{{$data->image}}" style="height:50;width: 50px;">
                                    @endif
                            </td>
                            <td>
                                <a class="btn btn-primary" title="View" href="{{ route('blogDescription', $data->id) }}">View</a>
                                <a class="btn btn-info" title="Edit" href="{{route('blog.edit',$data->id)}}">Edit</a>
                                <form action="{{route('blog.destroy',$data->id)}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    {{csrf_field()}}
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                <input type="text" class="form-control" style="opacity: 0;height:0;" value="https://www.freeworldimports.com/blog-details/{{$data->id}}" id="change_url{{$data->id}}">
                                <button class="btn btn-success" type="button" onclick="myFunction{{$data->id}}()">Copy Share Link</button>
                                <script>
                                    function myFunction{{$data->id}}() {
                                        var copyText = document.getElementById("change_url{{$data->id}}");
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999);
                                        document.execCommand("copy");
                                        alert("Copied the text: " + copyText.value);
                                    }
                                </script>
                            </td>
                        </tr>
                        @endif
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
<script type="text/javascript">
    $(document).ready(function() {
        // Summernote Editor
        $('#details').summernote({
            height: 200,
        });
    });
    
</script>
@endsection
@endsection
