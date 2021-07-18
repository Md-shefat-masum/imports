@extends('front_end.layouts.master')
@section('title')
    <title>Non Auction Deals</title>
@endsection
@section('content')

<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Non Auction Deals</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="shop_area shop_reverse">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12">

                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    {{-- <div class="shop_toolbar_btn">
                                <button data-role="grid_4" type="button" class=" active btn-grid-4" data-toggle="tooltip"
                                    title="4"></button>
                                <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip"
                                    title="List"></button>
                            </div> --}}
                     <div class="page_amount">
                        <p style="font-weight: bold;
                        font-size: 20px;    text-transform: uppercase;">non-auction products announcements</p>
                    </div>
                </div>
                <!--shop toolbar end-->

                <!--shop wrapper start-->
                <div class="row no-gutters shop_wrapper">
                    @php
                    $blog = App\Blog::where('category',34)->where('sub_category',59)->where('status',1)->orderBy('add_to_latest','DESC')->paginate(18);
                    //$blog = App\Blog::where('category',34)->where('sub_category',59)->where('status',1)->orderBy('created_at','DESC')->paginate(18);
                    ['blog' => $blog];
                    @endphp
                    @foreach($blog as $b)
                    <div class="col-lg-2 col-md-4 col-12 ">



                        <article class="single_product">
                            <figure>

                                <div class="product_thumb product_thumb_two">
                                    <a class="primary_img" href="{!! url('blog-details/'.$b->id) !!}"><img
                                            src="/images/blog/{{$b->image}}" alt=""></a>

                                    <div class="label_product">

                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            {{-- <li class="wishlist">

                                                <a class="add_towishlist_flash" type="submit"
                                                    title="Add to Wishlist">
                                                    <input type="hidden" value="{{$b->id}}">
                                            <i class="ion-android-favorite-outline"></i></a>
                                            </li> --}}

                                            <li class="quick_button"><a href="{!! url('blog-details/'.$b->id) !!}"><i
                                                        class="ion-ios-search-strong"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product_content grid_content">
                                    <div class="product_content_inner">
                                        <h4 class="product_name product_name_two">
                                            <a
                                                href="{!! url('blog-details/'.$b->id) !!}">{{ substr(strip_tags($b->title), 0,30) }}....</a>
                                        </h4>

                                        <div class="price_box" style="padding: 20px 0px 0px 0px;">
                                            {{-- <span class="old_price">$80.00</span> --}}
                                            <div class="current_price_two">
                                                <span class="current_price"> <a
                                                        href="{!! url('blog-details/'.$b->id) !!}"> Read More</a></span>
                                                <br>
                                            </div>
                                            @auth
                                            @if (Auth::user()->user_type == 'admin')
                                            {{-- <div class="current_price_two">
                                                <span class="current_price"><a
                                                        href="{{ route('blog_add_to_popup',$b->id) }}">Add to
                                            popup</a></span> <br>
                                        </div>
                                        --}}
                                        @if ($b->add_to_latest == 0)
                                        <div class="current_price_two">
                                            <span class="current_price"><a
                                                    href="{{ route('blog_add_to_latest_flash_sale',$b->id) }}">Add
                                                    to latest flash sale</a></span> <br>
                                        </div>
                                        @else
                                        <div class="current_price_two">
                                            <span class="current_price"><a
                                                    href="{{ route('blog_remove_from_latest_flash_sale',$b->id) }}">Remove flash sale</a></span>
                                        </div>
                                        @endif
                                        @endif
                                        @endauth
                                    </div>
                                </div>

                    </div>
                    </figure>
                    </article>
                </div>

                @endforeach
            </div>

            <div class="shop_toolbar t_bottom">
                {{ $blog->links() }}
            </div>
            <!--shop toolbar end-->
            <!--shop wrapper end-->
        </div>
    </div>
    </div>
</div>

@push('mjs')
        $('window').on('load',function(){
            setTimeout(function(){
                $('title').html('Non Auction Deals')
            },2000);
        })
@endpush
@endsection
