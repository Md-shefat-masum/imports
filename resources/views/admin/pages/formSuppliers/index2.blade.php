@extends('admin.layouts.master')
@section('title','| Contact ')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Supplier
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                            Add Supplier Forum
                        </button>
                    </h3>
                    <!-- modal start -->
                    <div class="modal modal-success fade" id="modal-success">
                        <form action="{{route('supplier-forum.store')}}" method="post" id="add_data">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Supplier</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Supplier Item</label>
                                                <textarea name="suppliers_item" id="suppliers_item" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->

                                </div>
                            </form>
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
                                <th>Supplier Item</th>
                                <th>Create At</th>
                                <th>Action</th>
                            </tr>
                            <?php $i=0; ?>
                            @foreach($contact as $data)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td style="max-width: 400px;">
                                        {!! substr($data->suppliers_item, 0,50)  !!} ....
                                    </td>
                                    <td>{{ date("d-m-Y || H:i A", strtotime($data->created_at)) }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('supplier-forum.edit',$data->id)}}">Edit</a></li>
                                                <li><form action="{{url('pages/supplier-forum',$data->id)}}" method="POST">
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
                            <li>{{ $contact->links() }}</li>
                        </ul>
                    </div>
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
        });
        // Summernote Editor
		$('#suppliers_item').summernote({
			height: 200,
		});
    </script>
@endsection
