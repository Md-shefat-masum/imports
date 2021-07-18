@extends('front_end.layouts.master')
@section('title','|Blog')

@section('content')
@if(Session::has('success'))
<!-- /.box-header -->
<div class="box-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {!! session('success') !!}
    </div>

    @endif

    @if(Session::has('errorl'))
    <!-- Button trigger modal -->
    <script>
        Swal.fire({
            title: '',
            type: 'info',
            html: '<h4>Please ' +
                'Login ' +
                'Or Register to comment</h4> <br><br>' +
                '<a class="btn btn-info" href="/login">Login</a> <a class="btn btn-info" href="/register">Register</a>',
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false
        })
    </script>

    @endif
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">home</a></li>
                            <li>blog details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--blog body area start-->
    <div class="blog_bg_area">
        <div class="container">
            <div class="blog_page_section">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="blog_wrapper blog_details">
                            <article class="single_blog">
                                <figure>
                                    {{-- @if (isset($blog)) --}}


                                    <div class="post_header">
                                        <h3 class="post_title">{{$blog->title}}</h3>
                                        <!-- <div class="blog_meta">

                                            <span class="meta_date">On : <a href="#">{!! date("j F,
                                                    Y",strtotime($blog->created_at)) !!}</a></span>
                                        </div> -->
                                    </div>
                                    {{-- @endif --}}
                                    @php
                                    $blog_comment = DB::table('blog_comments')->where('blog_id',
                                    $blog->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
                                    @endphp
                                    <div class="blog_thumb text-center">
                                        @if($blog->image!='')
                                        <img src="{{URL::to('/')}}/images/blog/{{$blog->image}}" alt="">
                                        @endif
                                    </div>
                                    <figcaption class="blog_content">
                                        <div class="card-body post_content post_content_two popup_pdf">
                                            <p>{!! $blog->details !!}</p>

                                        </div>
                                        @if(App\RelatedForum::where("blog_id",$blog->blog_id)->get())
                                        <h4 style="margin: 0px 0px 10px 0px;">RELATED NON-AUCTION ITEMS</h4>
                                        <div class="row no-gutters shop_wrapper bg-light"
                                            style="border: 1px solid rgba(244, 238, 238, 0.62) !important;">
                                            @php

                                            $relb = DB::table('related_forums')->orderby('id','desc')->get();
                                            // dd($blog->id);
                                            @endphp
                                            @foreach ($relb as $itemb)
                                            {{-- {{$itemb->id}} --}}
                                            @if ($blog->id == $itemb->blog_id)

                                            @php
                                            $rb = DB::table('blogs')->where('id',$itemb->blog_id)->first();

                                            // dd($rb);
                                            @endphp

                                            @php
                                            $val=$itemb->related_blog;
                                            $v=json_decode($val);
                                            $fval=$itemb->flash_sale;
                                            $f=json_decode($fval);
                                            // dd($v);
                                            @endphp
                                            <?php
                                                 for ($x=0; $x < count($v) ; $x++) {

                                                 ?>
                                            @php
                                            $rbr =
                                            DB::table('blogs')->where('id',$v[$x])->first();
                                            // dd($rbr);
                                            @endphp
                                            <div class="col-lg-3 col-md-4 col-12 ">
                                                <article class="single_product">
                                                    <figure>
                                                        <div class="product_thumb" style="height: 150px !important;">
                                                            <a class="primary_img"
                                                                href="{!! url('blog-details/'.$rbr->id) !!}">
                                                                @if($rbr->image!='')
                                                                <img src="{{URL::to('/')}}/images/blog/{{$rbr->image}}"
                                                                    alt="">
                                                                @endif
                                                            </a>


                                                            <div class="action_links">
                                                                <ul>

                                                                    <li class="quick_button"><a
                                                                            href="{!! url('blog-details/'.$rbr->id) !!}"
                                                                            title="quick view"><i
                                                                                class="ion-ios-search-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="product_content grid_content">
                                                            <div class="product_content_inner">
                                                                <h4 class="product_name"
                                                                    style="height: 90px !important;font-size: 14px !important;">
                                                                    <a
                                                                        href="{!! url('blog-details/'.$rbr->id) !!}">{{$rbr->title ?? Null}}</a>


                                                                </h4>
                                                                <div class="price_box" style="padding: 10px 0px 0px 0px;">
                                                                    <div class="current_price_two">
                                                                        <span class="current_price"> <a href="{!! url('blog-details/'.$rbr->id) !!}"> Read More</a></span>
                                                                        <br />
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="product_rating">

                                                                </div>
                                                                <div class="price_box">

                                                                    <span class="current_price">Viev</span>
                                                                </div> --}}
                                                            </div>
                                                            {{-- <div class="add_to_cart">
                                                                    <a href="#" title="Add to cart">Add to cart</a>
                                                                </div> --}}
                                                        </div>

                                                    </figure>
                                                </article>
                                            </div>
                                            <?php } ?>

                                            @endif
                                            @endforeach


                                        </div>
                                        @endif
                                        @if(App\RelatedForum::where("blog_id",$blog->blog_id)->get())
                                        <h4 style="margin: 0px 0px 10px 0px;">DAILY FLASH SALE</h4>
                                        <div class="row no-gutters shop_wrapper bg-light"
                                            style="border: 1px solid rgba(244, 238, 238, 0.62) !important;">

                                            @php

                                            $relb = DB::table('related_forums')->orderby('id','desc')->get();
                                            // dd($blog->id);
                                            @endphp
                                            @foreach ($relb as $itemb)
                                            {{-- {{$itemb->id}} --}}
                                            @if ($blog->id == $itemb->blog_id)

                                            @php
                                            $rb = DB::table('blogs')->where('id',$itemb->blog_id)->first();

                                            // dd($rb);
                                            @endphp

                                            @php

                                            $fval=$itemb->flash_sale;
                                            $f=json_decode($fval);
                                            // dd($v);
                                            @endphp
                                            <?php
                                                 for ($x=0; $x < count($f) ; $x++) {

                                                 ?>
                                            @php
                                            $fsale =
                                            DB::table('blogs')->where('id',$f[$x])->first();
                                            // dd($rbr);
                                            @endphp

                                            <div class="col-lg-3 col-md-4 col-12 ">
                                                <article class="single_product">
                                                    <figure>
                                                        <div class="product_thumb" style="height: 150px !important;">
                                                            <a class="primary_img"
                                                                href="{!! url('blog-details/'.$fsale->id) !!}">
                                                                @if($fsale->image!='')
                                                                <img src="{{URL::to('/')}}/images/blog/{{$fsale->image}}"
                                                                    alt="">
                                                                @endif
                                                            </a>


                                                            <div class="action_links">
                                                                <ul>

                                                                    <li class="quick_button"><a
                                                                            href="{!! url('blog-details/'.$fsale->id) !!}"
                                                                            title="quick view"><i
                                                                                class="ion-ios-search-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="product_content grid_content">
                                                            <div class="product_content_inner">
                                                                <h4 class="product_name"
                                                                    style="height: 90px !important;font-size: 14px !important;">
                                                                    <a
                                                                        href="{!! url('blog-details/'.$fsale->id) !!}">{{$fsale->title ?? Null}}</a>


                                                                </h4>
                                                                <div class="price_box" style="padding: 10px 0px 0px 0px;">
                                                                    <div class="current_price_two">
                                                                        <span class="current_price"> <a href="{!! url('blog-details/'.$fsale->id) !!}"> Read More</a></span>
                                                                        <br />
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="product_rating">

                                                                </div>
                                                                <div class="price_box">

                                                                    <span class="current_price">Viev</span>
                                                                </div> --}}
                                                            </div>
                                                            {{-- <div class="add_to_cart">
                                                                    <a href="#" title="Add to cart">Add to cart</a>
                                                                </div> --}}
                                                        </div>


                                                    </figure>
                                                </article>
                                            </div>
                                            <?php } ?>

                                            @endif
                                            @endforeach


                                        </div>
                                        @endif
                                        <div class="entry_content">

                                            <div class="social_sharing">
                                                <p>share this post:</p>
                                                <ul>
                                                    {{-- <li>
                                                        <a href="https://www.facebook.com/sharer.php?u={{ Request::url() }}"  target="_balnk" title="facebook"><i class="fa fa-facebook"></i></a>
                                                    </li> --}}

                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?text={{ Request::url() }}"  target="_balnk" title="twitter"><i class="fa fa-twitter"></i></a>
                                                    </li>

                                                    <li>
                                                        <a href="http://pinterest.com/pin/create/button/?url={{ Request::url() }}" target="_balnk" title="pinterest"><i class="fa fa-pinterest"></i></a>
                                                    </li>

                                                    <li><a href="https://www.linkedin.com/cws/share?url={{ Request::url() }}" target="_balnk" title="linkedin"><i class="fa fa-linkedin"></i></a>
                                                    </li>

                                                    <li><a href="#" target="_balnk" title="talkingtota">
                                                        <img style="width: 20px;" src="http://talkingtota.com/themes/default/statics/img/logo.png" alt="">
                                                    </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>

                        </div>
                        @php
                        $m = 1;
                        @endphp
                        @foreach ($blog_comment as $value)
                        <div class="card-footer text-muted">
                            <h5>{{ $value->author_name}} <span style="font-size: 10px;font-weight: bold;"> <b>Date :
                                    </b> {{ date("d-m-Y || H:i A", strtotime($blog->created_at)) }} </span> </h5>
                            <p>{{ $value->comment }}</p>
                        </div>
                        @php
                        if ($m++ > 2) break;
                        @endphp
                        @endforeach
                        <div class="card-footer text-muted">
                            <form class="" action="{{ route('commentStore')}}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <textarea class="form-control" name="comment" rows="3"
                                    placeholder="Add your comment"></textarea>
                                <button class="btn" type="submit"
                                    style="margin-top: 5px;float: right;background: #1C4D88;color: #ffffff;">Submit</button>
                            </form>
                        </div>

                        <!--blog grid area start-->

                        {{-- @include('front_end.include.related_posts',['blog_id'=>$blog->id]) --}}
                    </div>
                    @includeIf('front_end.layouts.sidebar-blog')
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="max-width: 960px;">

        <!-- Modal content-->
        <div class="modal-content" style="top: 5vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="left: 15px;position: absolute;">Information</h4>
            </div>
            <div class="modal-body">
                <div id="example1" style="height: 800px;">pdf loading ....</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--modal external link-->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" style="max-width: 960px;">

        <!-- Modal content-->
        <div class="modal-content" style="top: 5vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="left: 15px;position: absolute;">Information</h4>
            </div>
            <div class="modal-body">
                <div id="example22" style="height: 700px;overflow-y: scroll;">loading ....</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="urlModal" role="dialog">
    <div class="modal-dialog" style="max-width: 1120px;">

        <!-- Modal content-->
        <div class="modal-content" style="top: 5vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="left: 15px;position: absolute;">Information</h4>
            </div>
            <div class="modal-body">
                <div id="example2" style="height: 800px;">
                    <iframe id="urlshow" src="#" style="border:none;height:100%;width:100%;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')


@endsection
