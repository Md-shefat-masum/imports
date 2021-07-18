@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Facebook Feed
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-success">
                            Add Partner
                        </button>
                    </h3>
                    <!-- modal start -->
                    <div class="modal modal-success fade" id="modal-success">
                        <form action="{{route('partners.store')}}" method="post" id="add_data" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Partner</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" id="menu" required  placeholder="Enter title">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Description (short)</label>
                                                <input type="text" name="description" class="form-control" id="description" required  placeholder="Enter description">

                                            </div>
                                            <div class="form-group">
                                                <label for="">Logo</label>
                                                <input type="file" name="image" class="form-control" id="image" required>
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
                        <p>Please publish less than 6</p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <tr>
                                <th style="">#</th>
                                <th>Logo</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php $i=0; ?>
                            @forelse ($partners as $partner)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <img src="{{URL::to('/')}}/images/footer/{{$partner->image}}" alt="LOGO" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $partner->title }}</td>
                                    <td>{{ $partner->description }}</td>
                                    <td>
                                        @if ($partner->status == 1)
                                            Publish
                                        @else
                                            Unpublish
                                        @endif
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ route('partners.edit', $partner->id) }}">Edit</a></li>
                                                <li><form action="{{ route('partners.destroy', $partner->id) }}" method="POST">
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
                            @empty

                            @endforelse
                        </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

@endsection
@section('scripts')

@endsection
