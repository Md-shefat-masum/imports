@extends('admin.layouts.master') @section('title','|menus') @section('stylesheet') @endsection @section('content')
<div class="row">
    <div class="col-md-12">
        @if (Session::has('success'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Update Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form method="post" action="{{route('edit_releted_blog')}}" id="add_data" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Update Related Blog</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">
                            <a href="{{route('related_blog')}}" class="btn"><i class="fa fa-reply"
                                    aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $blog->id }}" />

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="">Select Blog</label>
                        <div class="col-sm-8">
                            <select class="js-example-basic-single form-control" name="blog_id"
                                style="border: 1px solid rgba(0, 0, 0, 0.281); border-radius: 3px;">
                                @php $categories = DB::table('blogs')->where('status',
                                1)->select('id','title','image','category')->orderBy('id', 'desc')->get();
                                @endphp @php $rb = DB::table('blogs')->select('id','category','title','image')->where('id',$blog->blog_id)->first();
                                @endphp
                                <option value="{{ $blog->blog_id }}">{{$rb->title ?? Null}}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }} | {{$category->category == 34 ? 'Flash Sale' : 'Blog'}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @php
                    $related = [];
                    // dd($blog->id);
                    if(DB::table('related_forums')->where('id',$blog->id)->exists()){
                    $related=
                    DB::table('related_forums')->where('id',$blog->id)->first()->related_blog;
                    // dd($related);
                    $related=json_decode($related);
                    }
                    @endphp
                    @php
                    $flash = [];
                    // dd('lkasjflkasjf');
                    if(DB::table('related_forums')->where('id',$blog->id)->exists()){
                    $flash=
                    DB::table('related_forums')->where('id',$blog->id)->first()->flash_sale;
                    // dd($related);
                    $flash=json_decode($flash);
                    }
                    @endphp
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="">Select Related Blog</label>
                        <div class="col-sm-8">
                            <select class="js-example-basic-multiple form-control" name="related_blog[]"
                                multiple="multiple" style="border: 1px solid rgba(0, 0, 0, 0.281); border-radius: 3px;">
                                @php
                                $bloglist = DB::table('blogs')->where('status',
                                1)->select('id','category','title','image')->orderBy('id', 'desc')->get();

                                @endphp
                                <option value="">-- Select Related Blog --</option>
                                @foreach ($bloglist as $bl)
                                <option {{ in_array($bl->id,$related) ? 'selected' : '' }} value="{{ $bl->id }}">
                                    {{ $bl->title }} | {{$bl->category == 34 ? 'Flash Sale' : 'Blog'}}
                                  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="">Select Flash Sale</label>
                        <div class="col-sm-8">
                            <select class="js-example-basic-multiple form-control" name="flash_sale[]"
                                multiple="multiple" style="border: 1px solid rgba(0, 0, 0, 0.281); border-radius: 3px;">
                                @php
                                $faslsale = DB::table('blogs')->where('status',
                                1)->select('id','title','category','image')->orderBy('id', 'desc')->get();

                                @endphp
                                <option value="">-- Select Flash Sale --</option>
                                @foreach ($faslsale as $fl)
                                <option {{ in_array($fl->id,$flash) ? 'selected' : '' }} value="{{ $fl->id }}">
                                    {{ $fl->title }} | {{$fl->category == 34 ? 'Flash Sale' : 'Blog'}}
                                  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer header-part text-center">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </div>
        </form>
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
