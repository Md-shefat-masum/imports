@extends('admin.layouts.master')
@section('title','|Blog')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
    <div class="col-md-12 ">
        <div class="box">
            <div class="panel-heading"> Blog List </div>
            @if (Session::has('success'))
            <div class="alert alert-info">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="box-header with-border">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="">#</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
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
                                    <a class="btn btn-primary btn-sm" title="View" href="{{ route('blogDescription', $data->id) }}">View</a>
                                    <a class="btn btn-primary btn-sm" title="Edit" href="{{route('blog.edit',$data->id)}}">Edit</a>
                                    <form action="{{route('blog.destroy',$data->id)}}" method="POST" style="display: inline-block;">
                                        @method('DELETE')
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <input type="text" class="form-control" style="opacity: 0;height:0;" value="https://www.freeworldimports.com/blog-details/{{$data->id}}" id="change_url{{$data->id}}">
                                    <button type="button" onclick="myFunction{{$data->id}}()">Copy Share Link</button>
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
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>{{ $blog->links() }}</li>
                        </ul>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
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
