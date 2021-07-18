@extends('front_end.layouts.master')
@section('title','| Blog')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>Entrepreneur Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="blog_bg_area">
    <div class="container">
        <!--blog area start-->
        <div class="blog_page_section">
            <div class="row">

                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_list widget_categories">
                            <h3>Entrepreneur EXPERIENCE</h3>
                            <ul>
                                <li><a href="{{url("/forum/entrepreneur")}}">All</a>
                                    @php
                                    $blog_cat = App\Blog::where('status', '1')->where('type', 'entrepreneur')->get();
                                    @endphp
                                    @foreach ($blog_cat->unique('category') as $b_cat)
                                <li class="widget_sub_categories"><a href="">
                                        @php
                                        $blog_cat = DB::table('blog_category')->where('id', $b_cat->category)->first();

                                        $blog_sub_cat = DB::table('blog_sub_cat')->where('status', '1')->where('cat_id',
                                        $blog_cat->id)->get();
                                        @endphp
                                        {{ isset($blog_cat->cat_name) ? $blog_cat->cat_name : '' }}
                                        {{-- @if (count($blog_sub_cat) > 0)
                                        <span>&nbsp;&nbsp; <i class="fas fa-angle-down"></i></span>
                                        @endif --}}
                                    </a>
                                    @if (count($blog_sub_cat) > 0)
                                    <ul class="widget_dropdown_categories" style="display: none;">
                                        @foreach ($blog_sub_cat as $blog_sub_ca)
                                        <li><a
                                                href="/forum/entrepreneur/cat/{{$b_cat->id}}">{{ $blog_sub_ca->sub_cat_name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>
                @if(Session::has('category'))
                <div class="col-lg-9 col-md-12 text-center">
                    <div class="alert alert-danger"><strong>No product found</strong></div>
                </div>
                @php
                $url = route('webproduct');
                Session::forget('category');
                header('Refresh: 8; URL='.$url);
                @endphp
                @endif

                <div class="col-lg-9 col-md-12">
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">
                            <h4 style="font-size: 20px;">Blogs</h4>
                        </div>

                    </div>
                    <div class="blog_wrapper mb-60">

                        @forelse ($products as $b)
                        <div class="blog_wrapper_inner">
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="#"><img src="{{url('/')}}/images/blog/{{$b->image}}"
                                                alt=""></a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <h4 class="post_title"><a href="#">{{$b->title}}</a></h4>
                                        <div class="blog_meta">
                                            <span class="author">Posted by : <a href="#">{{$b->type}}</a> </span>
                                        </div>
                                        <div class="blog_desc">
                                            <p>{!!Str::words($b->details,25)!!}</p>
                                        </div>
                                        <footer class="btn_more">
                                            <a href="{{url('/supplier_blogs_view',$b->id)}}"> Read more</a>
                                        </footer>
                                    </figcaption>
                                </figure>
                            </article>

                        </div>
                        @empty
                        <div class="col-lg-12 col-md-12 text-center">
                            <div class="alert alert-danger"><strong>No product found</strong></div>
                        </div>
                        @endforelse
                    </div>
                    <!--blog pagination area start-->
                    <div class="blog_pagination">
                        {{ $products->links() }}
                    </div>
                    <!--blog pagination area end-->
                </div>
            </div>
        </div>
        <!--blog area end-->


    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $(".get_subcat").on("click", function() {
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: 'POST',
                url: '/forum/supplier/cat/subcategory',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": dataId
                },
                success: function(data) {
                    $(".subcat_blog").html(data);
                    //console.log(data);
                }
            });
        });

        $(".get_cat_blog").on("click", function() {
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: 'POST',
                url: '/forum/supplier/cat/subcategory',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cat": dataId
                },
                success: function(data) {
                    $(".subcat_blog").html(data);
                    //console.log(data);
                }
            });
        });

    });
</script>
@endsection
