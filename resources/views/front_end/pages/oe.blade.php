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
                        <li>Supplier Blog</li>
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
                            <h3>Entrepreneurs EXPERIENCE</h3>
                            <ul>
                                @php
                                $blog_cat = App\Blog::where('status', '1')->where('type', 'entrepreneur')->get();
                                @endphp
                                <li><a class="get_subcat" href="javascript:void(0)"
                                        data-id="all" style="border-radius: 0px;margin-right: -3px;">All</a></li>

                                @foreach ($blog_cat->unique('category') as $b_cat)
                                <li class="widget_sub_categories"><a class="get_cat_blog"
                                        data-id="{{ $b_cat->category }}">
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
                                        <li><a class="get_subcat"
                                                data-id="{{ $blog_sub_ca->id }}">{{ $blog_sub_ca->sub_cat_name }}</a>
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
                <div class="col-lg-9 col-md-12">
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">
                            <h4 style="font-size: 20px;">Entrepreneurs EXPERIENCE</h4>
                        </div>

                    </div>
                    <div class="blog_wrapper mb-60 subcat_blog">
                        @foreach($blog as $b)
                        <div class="blog_wrapper_inner">
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="{!! url('blog-details/'.$b->id) !!}"><img
                                                src="{{URL::to('/')}}/images/blog/{{$b->image}}" alt=""></a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <?php $readmore="...";?>
                                        <h4 class="post_title"><a href="{!! url('blog-details/'.$b->id) !!}">
                                                {{ substr(strip_tags($b->title), 0,50) }}
                                                {{ strlen(strip_tags($b->title)) > 50 ? "$readmore" : "" }}
                                            </a>
                                        </h4>
                                        <div class="blog_meta">
                                            <span class="author">Posted by : <a href="#">{{$b->type}}</a> </span>
                                        </div>
                                        <div class="blog_desc">
                                            {{-- <p>{!!Str::words($b->details,25)!!}</p> --}}
                                            <p>
                                                {{ substr(strip_tags($b->details), 0,100) }}
                                                {{ strlen(strip_tags($b->details)) > 50 ? "..." : "" }}
                                            </p>
                                        </div>
                                        <footer class="btn_more">
                                            <a href="{!! url('blog-details/'.$b->id) !!}"> Read more</a>
                                        </footer>
                                    </figcaption>
                                </figure>
                            </article>

                        </div>
                        @endforeach
                    </div>
                    <!--blog pagination area start-->
                    <div class="blog_pagination">
                        {{ $blog->links() }}
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