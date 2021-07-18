@extends('front_end.layouts.master')
@push('js')
    <script src="/front_end/front_end_vue.js"></script>
@endpush
@section('content')
    @if(App\PopupBlogProduct::where('blog_position',1)->take(4)->get())
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content" style="background-image: url('/footer-bg.png'); background-size: cover;">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="margin: 0px 0px 0px -18px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <?php $p = 1; ?>
                        @php $co = App\PopupBlogProduct::where('blog_position',1)->orderBy('id','DESC')->take(3)->get(); $count = count($co); @endphp

                        <div class="row">
                            @foreach ($co as $b) @php $sp = DB::table('blogs')->select('id','image')->where('id', $b->blog_id )->first(); @endphp
                            <?php $p++; ?>

                            <div class="@if ($count == 4) col-lg-3 @elseif ($count == 3) col-lg-4 @elseif ($count == 2) col-lg-6 @else col-lg-12 @endif">
                                <a href="{!! url('blog-details/'.$sp->id) !!}"><img src="{{ asset('images/blog/'.$sp->image) }}" style="width: 320px; height: 170px !important;" class="img-fluid" alt="" /></a>
                            </div>

                            @endforeach
                        </div>

                        <h1 class="text-uppercase" style="font-size: 43px; padding: 20px 0px 0px 0px;">TODAY'S BEST OFFERS</h1>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Skip Offers</a>
                        <a href="{{route('daily_flat_sale')}}" class="btn btn-primary">View Offers</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@include('front_end.pages.banner')

<!--product area start-->

{{-- @include('front_end.pages.topcat') --}}
<!--product area end-->

<div class="home_section_bg">
    <!--home section bg area start-->
    @include('front_end.pages.hotsale')

    <!--product area end-->

    {{-- @foreach($categories as $category) @php dd($category); $category = DB::table('category')->where('id', $category->id)->first(); $products=DB::table('product')->where('cat_id', $category->id)->get(); @endphp @endforeach --}} {{--
    @foreach($cateogories as $category) @php $category = DB::table('category')->where('id', $category->id)->first(); $products=DB::table('product')->where('cat_id', $category->id)->get(); @endphp
    <h2>{{ $category->name }}</h2>
    @endforeach --}} {{-- $home_categories = DB::table('home_products')->get(); dd($home_categories); --}}
    @include('front_end.pages.home_product_cat')
    @include('front_end.pages.home_product_g') {{--
    <div class="product_area deals_product_style2" style="padding: 30px 0px;">
        @include('front_end.pages.home_product_two')
    </div>
    --}}
    <!--product area end-->

    @include('front_end.pages.home_product_news')
</div>

@endsection @section('scripts')
<script>
    $(document).ready(function () {
        $(window).on("load", function () {
            $("#exampleModalCenter2").modal("show");
        });

        $(".get_subcat").on("click", function () {
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/forum/supplier/cat/allcategory",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: dataId,
                },
                success: function (data) {
                    $(".subcat_blog").html(data);
                    //console.log(data);
                },
            });
        });

        $(".get_cat_blog").on("click", function () {
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/forum/supplier/cat/allcategory",
                data: {
                    _token: "{{ csrf_token() }}",
                    cat: dataId,
                },
                success: function (data) {
                    $(".subcat_blog").html(data);
                    //console.log(data);
                },
            });
        });
    });
</script>
@endsection
@push('js')
    <script>
        $("#slideshow > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow");
        }, 3000);

        $("#slideshow_two > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_two > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_two");
        }, 5000);

        $("#slideshow_three > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_three > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_three");
        }, 3000);

        $("#slideshow_four > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_four > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_four");
        }, 5000);

        $("#slideshow_five > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_five > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_five");
        }, 3000);

        $("#slideshow_six > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_six > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_six");
        }, 4000);

        $("#slideshow_seven > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_seven > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_seven");
        }, 4000);

        $("#slideshow_eight > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_eight > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_eight");
        }, 3000);
        $("#slideshow_cat > div:gt(0)").hide();

        setInterval(function () {
            $("#slideshow_cat > div:first").fadeOut(1000).next().fadeIn(1000).end().appendTo("#slideshow_cat");
        }, 5000);
    </script>
@endpush
