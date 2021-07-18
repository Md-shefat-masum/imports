@extends('admin.layouts.master')
@section('title','|Blog')
@section('stylesheet')
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        @if (Session::has('success'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Added Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('success-u'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Update Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('success-two'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Delete Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="card">

            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> Related Blog</h3>
                    </div>
                    <div class="col-md-6 text-right card_header_btn">
                        <a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                class="fa fa-plus-circle"></i> Add Related Blog & Flash Sale</a>

                        <div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
                            <form action="{{route('related_blog_add')}}" method="post" id="add_data"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-color">
                                            <h5 class="modal-title">Related Blog</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>

                                        </div>
                                        @php
                                          $user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <div class="modal-body text-left" style="height:54vh;">



                                            <div class="form-group">
                                                <label for="">Select Blog</label>
                                                <select class="js-example-basic-single form-control" name="blog_id"
                                                    style="border: 1px solid rgba(0, 0, 0, 0.281);
                                                    border-radius: 3px;">
                                                    @php
                                                      $categories = DB::table('blogs')->where('status',1)->select('id','category','title','image')->orderBy('category', 'desc')->get();
                                                    @endphp
                                                    <option value=""> -- Select Blog -- </option>
                                                    @foreach ($categories as $category)
                                                      <option value="{{ $category->id }}">{{ $category->title }} | {{$category->category == 34 ? 'Flash Sale' : 'Blog'}}
                                                      </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="">Select Related Blog</label>
                                                <select class="js-example-basic-multiple  form-control"
                                                    name="related_blog[]" multiple="multiple" style="border: 1px solid rgba(0, 0, 0, 0.281);
                                                border-radius: 3px;">
                                                    @php
                                                    $categories = DB::table('blogs')->where('status',1)->select('id','category','title','image')->orderBy('category', 'desc')->get();
                                                    @endphp
                                                    <option value="">-- Select Blog --</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }} | {{$category->category == 34 ? 'Flash Sale' : 'Blog'}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Select FLASH SALE</label>
                                                <select class="js-example-basic-multiple  form-control"
                                                    name="flash_sale[]" multiple="multiple" style="border: 1px solid rgba(0, 0, 0, 0.281);
                                                border-radius: 3px;">
                                                    @php
                                                    $categories = DB::table('blogs')->where('status',
                                                    1)->select('id','title','image','category')->orderBy('category', 'desc')->get();
                                                    @endphp
                                                    <option value="">-- Select Blog --</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }} | {{$category->category == 34 ? 'Flash Sale' : 'Blog'}}
                                                    </option>
                                                    @endforeach
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

                            {{-- <th>Data Id</th> --}}
                            <th>Blog Id</th>
                            <th>Blog</th>
                            {{-- <th>Related Blogs</th> --}}
                            <th>Related Blogs</th>
                            <th>Flash Sale</th>

                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        @foreach($blog as $data)

                          @php
                            // dd($data);
                            $rb = DB::table('blogs')->where('id',$data->blog_id)->first();
                          @endphp
                          @php
                            $val=$data->related_blog;
                            $v=json_decode($val);
                            $fval=$data->flash_sale;
                            $f=json_decode($fval);
                            // dd($v);
                          @endphp
                          @php
                            $i++;
                          @endphp

                          @if (isset($rb))
                          <tr>
                              <td>{{$i}}</td>
                              {{-- <td>{{$data->id}}</td> --}}

                              <td>{{$rb->id ?? Null}}</td>
                              <td>{{$rb->title ?? Null}}</td>
                              @if (isset($v))
                              <td>
                                  <?php

                                      $j=1;
                                       for ($x=0; $x < count($v) ; $x++) {
                                   ?>
                                      {{-- {{$v[$x]}} --}}

                                      @php
                                        $rbr = DB::table('blogs')->where('id',$v[$x])->first();
                                        // dd($rbr);
                                      @endphp

                                      <div>{{$j}}. {{$rbr->title ?? Null}}</div> <br>
                                      @php
                                        $j++;
                                      @endphp
                                  <?php } ?>
                              </td>
                              @endif
                                @if (isset($f))
                                  <td>
                                      <?php

                                        $j=1;
                                        for ($x=0; $x < count($f) ; $x++) {
                                     ?>
                                        {{-- {{$v[$x]}} --}}

                                        @php
                                          $fl = DB::table('blogs')->where('id',$f[$x])->first();
                                          // dd($rbr);
                                        @endphp

                                        <div>{{$j}}. {{$fl->title ?? Null}}</div> <br>
                                        @php
                                          $j++;
                                        @endphp
                                      <?php } ?>
                                  </td>
                              @endif



                              <td>
                                  <div class="btn-group btn-group-sm btn-color-ceate">
                                      <a href="{{route('update_releted_blog',$data->id)}}" class="btn btn-info">Edit</a>
                                      <a href="{{route('delete_releted_blog',$data->id)}}"
                                          class="btn btn-danger">DELETE</a>
                                  </div>

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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style media="screen">
  .select2-container .select2-selection--multiple{
    overflow: auto;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    color: black;
  }
  .select2-container--default .select2-results>.select2-results__options{
    max-height: 40vh;
  }
</style>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
@endsection
