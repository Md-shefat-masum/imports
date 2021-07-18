@extends('front_end.layouts.master2')
@section('title','| Blog')
@section('stylesheet')
<style>
    .blog_cat ul {
        margin-bottom: 0px;
    }

    .blog_cat ul li {
        display: inline-block;
        margin-top: 20px;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        left: 0;
        top: 37px;
        z-index: 99;
        text-align: left;
        background: #ffffff !important;
        border-left: 1px solid #122063 !important;
    }

    .dropdown-content a {
        display: block;
        border: none;
        border-bottom: 1px solid #122063 !important;
        border-right: 1px solid #122063 !important;
        background: #ffffff !important;
        color: #122063 !important;
        text-align: left;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
@endsection
@section('content')
<div class="container">
    <!-- Blog Post -->

    <section class="leatest-news-area">
        <div class="title text-center">
            <h2>SUPPLIERS EXPERIENCE</h2>
        </div>
        <!--title-->
        <div class="title text-center blog_cat">
            <ul class="">
                @php
                $blog_cat = App\Blog::where('status', '1')->where('type', 'supplier')->get();
                @endphp
                <li><a class="btn btn-primary custom-btn  get_subcat" href="javascript:void(0)" data-id="all"
                        style="border-radius: 0px;margin-right: -3px;">All</a></li>
                @foreach ($blog_cat->unique('category') as $b_cat)
                <li class="dropdown">
                    <a class="dropbtn btn btn-primary custom-btn  get_cat_blog" data-id="{{ $b_cat->category }}"
                        href="javascript:void(0)" style="border-radius: 0px;margin-right: -3px;">
                        @php
                        $blog_cat = DB::table('blog_category')->where('id', $b_cat->category)->first();

                        $blog_sub_cat = DB::table('blog_sub_cat')->where('status', '1')->where('cat_id',
                        $blog_cat->id)->get();
                        @endphp
                        {{ isset($blog_cat->cat_name) ? $blog_cat->cat_name : '' }}

                        @if (count($blog_sub_cat) > 0)
                        <span>&nbsp;&nbsp; <i class="fas fa-angle-down"></i></span>
                        @endif
                    </a>
                    @if (count($blog_sub_cat) > 0)
                    <div class="dropdown-content">
                        @foreach ($blog_sub_cat as $blog_sub_ca)
                        <a class="btn btn-primary custom-btn get_subcat" data-id="{{ $blog_sub_ca->id }}"
                            href="javascript:void(0)" style="border-radius: 0px;margin-right: -3px;">
                            {{ $blog_sub_ca->sub_cat_name }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        <div class="container">
            <div class="">

                <div class="item">
                    <div class="leates-content">
                        <div class="row subcat_blog">
                            @foreach($blog as $b)
                            <div class="col-lg-3 col-md-3">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="single-news">
                                            <div class="single-news-image">
                                                <a href="{!! url('blog-details/'.$b->id) !!}" style="color: #1c4d88;">
                                                    <img src="{{URL::to('/')}}/images/blog/{{$b->image}}" alt=""
                                                        style="height: 200px;">
                                                </a>
                                            </div>
                                            <!--single-news-imag-->
                                        </div>
                                        <!--single-news-->
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="single-news-text">
                                            <div class="submit-button">
                                                <!--   <a  class="btn btn-primary custom-btn">{{$b->heading}}</a> -->
                                            </div>
                                            <div class="blog-title">
                                                <?php $readmore="...Read More";?>
                                                <span>
                                                    <p>
                                                        <a href="{!! url('blog-details/'.$b->id) !!}"
                                                            style="color: #1c4d88;">
                                                            {{ substr(strip_tags($b->title), 0,50) }}
                                                            {{ strlen(strip_tags($b->title)) > 50 ? "$readmore" : "" }}
                                                        </a>
                                                    </p>
                                                </span>
                                                <p class="text-info"><a href="{!! url('details/'.$b->id) !!}"
                                                        style="text-decoration:none;color:#000;">
                                                        {{ substr(strip_tags($b->details), 0,100) }}
                                                        {{ strlen(strip_tags($b->details)) > 50 ? "...Read More" : "" }}
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="submit-button">
                                                <a class="btn btn-primary custom-btn"
                                                    href="{!! url('blog-details/'.$b->id) !!}">Continue Reading</a>
                                            </div>
                                        </div>
                                        <!--single-news-text-->
                                    </div>
                                    <!--col-lg-3-->


                                </div>
                            </div>
                            <!--col-lg-3-->
                            @endforeach
                        </div>
                        <!--row-->
                    </div>
                    <!--leates-content-->
                </div>
            </div>
        </div>
        <!--container-->
        <div class="whitespace" style="height: 210px;"></div>

    </section>
    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        <li class="page-item {{ (empty($blog->previousPageUrl())) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $blog->previousPageUrl() }}">← Back</a>
        </li>
        <li class="page-item {{ (empty($blog->nextPageUrl())) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $blog->nextPageUrl() }}">Next →</a>
        </li>
    </ul>

</div>
</div>
<!-- /.container -->
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