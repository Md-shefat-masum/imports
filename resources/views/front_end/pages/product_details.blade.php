@extends('front_end.layouts.master')
@section('title','|Product')
@section('stylesheet')
<style>
    .gallery-wrap .img-big-wrap img {
        height: 450px;
        width: 100%;
        display: inline-block;
        cursor: zoom-in;
    }


    .gallery-wrap .img-small-wrap .item-gallery {
        width: 60px;
        height: 60px;
        border: 1px solid #ddd;
        margin: 7px 2px;
        display: inline-block;
        overflow: hidden;
    }

    .gallery-wrap .img-small-wrap {
        text-align: center;
    }

    .gallery-wrap .img-small-wrap img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 4px;
        cursor: zoom-in;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    .image-viewer {

        display: flex;
        flex-direction: column;
        justify-content: flex-start;

        .main-image {
            width: 300px;
            height: 300px;
            align-self: center;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;

            img {
                cursor: zoom-in;
                max-width: 100%;
                max-height: 100%;
                width: auto;
                height: auto;
            }
        }

        .secondary-images {
            align-self: center;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: space-between;

            .secondary-image {
                padding: $padding-x-small;
                height: 50px;

                img {
                    cursor: pointer;
                    max-width: 100%;
                    max-height: 100%;
                }
            }
        }
    }

    .secondary-image img {
        height: 50px;
        width: 50px;
        float: left;
        margin: 5px;
        border: 2px solid #ddd;
        padding: 2px;
    }

    @media only screen and (min-width: 992px) {
        .main-image {
            text-align: center;
            min-height: 400px;
        }
    }

    .main-image img {
        height: auto;
        max-height: 400px;
        width: auto;
        max-width: 100%;
    }

    .item-property ul li {
        margin-left: 20px;
    }
</style>
@endsection
@section('content')

<!-- <div class="row"> -->
<!-- <div class="col-md-6"> -->
<?php
    $val=$product['image'];
    $v=json_decode($val);
    // for ($i=0; $i <count($v) ; $i++) {
    // }


    ?>
<div class="product_page_bg">
    <div class="container">
        <div class="product_details_wrapper mb-55">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-details-tab" style="margin: 16px 0px 0px 0px;">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="#">
                                    <img id="zoom1" src="/images/product/{{$v[0]}}"
                                        data-zoom-image="/images/product/{{$v[0]}}" alt="big-1"
                                        style="max-width: 96%;">
                            </div>

                            <div class="single-zoom-thumb">
                                <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01"
                                    style="margin: 36px 0px 0px 0px;">
                                    <?php
                                    for ($x=0; $x < count($v) ; $x++) {

                                    ?>
                                    <li>
                                        <a href="#" class="elevatezoom-gallery active" data-update=""
                                            data-image="/images/product/{{$v[$x]}}"
                                            data-zoom-image="/images/product/{{$v[$x]}}">
                                            <img src="/images/product/{{$v[$x]}}" alt="zo-th-1" />
                                        </a>

                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <article class="card-body p-5">
                            <h3 class="title mb-3">{{$product->p_name}}</h3>

                            <p class="price-detail-wrap">
                                <span class="pricee h3 text-warning">
                                    <!--<span class="currency">US $</span><span class="num">{{$product->price}}</span>-->
                                    @php
                                    $productss=DB::table('units')->where('id',$product->unit)->get();
                                    @endphp

                                    @foreach($productss as $pr)
                                    <span class="currency">US $ {{number_format($product->bundle_price)}} /
                                        {{$pr->unit}}</span>
                                    @endforeach
                                </span>
                                <!-- <span>{{$product->unit}}</span>  -->
                            </p> <!-- price-detail-wrap .// -->
                            <dl class="item-property item-property-two item-property-three">
                                <dt>Description</dt>
                                <dd>
                                    <p>{!!html_entity_decode($product->p_description)!!} </p>
                                </dd>
                            </dl>

                            <dl class="param param-feature">
                                <dt>Additional information</dt>


                                <dd><a href="{{ $product->link }}" id="product_link" data-toggle="modal"
                                        data-target="#myModal" style="color: #1664c1;"> (click here)</a></dd>
                                <input type="hidden" name="pdfLink" id="pdfLink" value="{{ $product->link }}">
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog" style="max-width: 960px;">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="top: 5vh;">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="left: 15px;position: absolute;">Product
                                                    Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="example1" style="height: 800px;">pdf loading ....</div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </dl>
                            <hr>
                            <form action="{{url('add-cart')}}" method="POST">
                                @csrf
                                <div class="checkout">
                                    <div class="row ">
                                        @if (isset($_GET["ref"]))
                                        <input type="hidden" name="reference" value="{{ $_GET["ref"] }}">
                                        @endif
                                        <div class="col-sm-4">

                                            <dl class="param param-inline">
                                                <dt>Bundle : </dt>
                                                <dd>
                                                    <!--<input type="number"  value="1" onKeyUp="multiply()" class="form-control form-control-sm quantity" style="width:70px;">-->
                                                    <input type="number" name="quantity" class="quantity form-control"
                                                        value="1" min="1">
                                                    <input type="hidden" name="product_id" class="quantity form-control"
                                                        value="{{ $product->id }}">
                                                    <input type="hidden" name="product_name"
                                                        class="quantity form-control" value="{{ $product->p_name }}">

                                                </dd>
                                            </dl> <!-- item-property .// -->
                                        </div> <!-- col.// -->
                                        <div class="col-sm-4">
                                            <dl class="param param-inline">
                                                <dt>Bundle Price: </dt>
                                                <dd>
                                                    <label class="form-check form-check-inline">
                                                        <p class="price" data-price="{{$product->bundle_price}}">
                                                            ${{number_format($product->bundle_price)}}</p>
                                                        <input type="hidden" name="price"
                                                            value="{{ $product->bundle_price }}">
                                                        <!--<span class="form-check-label"><input name="PPRICE" id="PPRICE" class="form-control price" value="{{$product->price}}" readonly></span>-->
                                                    </label>

                                                </dd>
                                            </dl> <!-- item-property .// -->
                                        </div> <!-- col.// -->
                                        <div class="col-sm-4">
                                            <dl class="param param-inline">
                                                <dt>Total Price: </dt>
                                                <dd>
                                                    <label class="form-check form-check-inline">
                                                        <p class="total"> <span
                                                                id="total">${{number_format($product->bundle_price)}}</span>
                                                        </p>
                                                    </label>

                                                </dd>
                                            </dl> <!-- item-property .// -->
                                        </div> <!-- col.// -->
                                    </div> <!-- row.// -->
                                    <hr>

                                    @if($product->status==2)
                                    <button type="submit" disabled class="btn btn-outline-primary text-uppercase">Sold
                                        Out </button>
                                    @else
                                    <button type="submit" class="btn btn-outline-primary text-uppercase">Add to cart
                                    </button>
                                    @endif

                            </form>
                        </article> <!-- card-body.// -->
                    </div>
                </div>
            </div>
            <!-- <img class="xzoom" src="" xoriginal="/images/product/{{$v[0]}}" /> -->

            <!--container.//-->

            </a>
        </div>
    </div>
</div>
</div>

<?php //} ?>



@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
<script>
    $(document).ready(function(){
        $(window).on('load',function(){

            var product_link = $('#product_link').attr('href');
            console.log(product_link.replace('https://freeworldimports.com','https://freeworldimports.com'));
            // console.log(location);
            $('#product_link').attr('href',product_link.replace('https://freeworldimports.com','https://freeworldimports.com'));
            $('#pdfLink').attr('value',product_link.replace('https://freeworldimports.com','https://freeworldimports.com'));
            var link = $('#pdfLink').val();
            //console.log(link);
            PDFObject.embed(link, "#example1");
        });
    })
</script>
<script>
    $(document).ready(function(){
        $(".checkout").on("keyup", ".quantity", function(){
            // alert("hello");
            var price = +$(".price").data("price");
            var quantity = +$(this).val();
            $("#total").text("$" + price * quantity);
        })

    })
</script>
<script>
    class ImageViewer {
    constructor(selector) {
        this.selector = selector;
        $(this.secondaryImages).click(() => this.setMainImage(event));
        $(this.mainImage).click(() => this.showLightbox(event));
        $(this.lightboxClose).click(() => this.hideLightbox(event));
    }

    get secondaryImageSelector() {
        return '.secondary-image';
    }

    get mainImageSelector() {
        return '.main-image';
    }

    get lightboxImageSelector() {
        return '.lightbox';
    }

    get lightboxClose() {
        return '.lightbox-controls-close';
    }

    get secondaryImages() {
        var secondaryImages = $(this.selector).find(this.secondaryImageSelector).find('img')
        return secondaryImages;
    }

    get mainImage() {
        var mainImage = $(this.selector).find(this.mainImageSelector);
        return mainImage;
    }

    get lightboxImage() {
        var lightboxImage = $(this.lightboxImageSelector);
        return lightboxImage;
    }

    setLightboxImage(event){
        var src = this.getEventSrc(event);
        this.setSrc(this.lightboxImage, src);
    }

    setMainImage(event){
        var src = this.getEventSrc(event);
        this.setSrc(this.mainImage, src);
    }

    getSrc(node){
        var image = $(node).find('img');
    }

    setSrc(node, src){
        var image = $(node).find('img')[0];
        image.src = src;
    }

    getEventSrc(event){
        return event.target.src;
    }

    showLightbox(event){
        this.setLightboxImage(event);
        $(this.lightboxImageSelector).addClass('show');
    }

    hideLightbox(){
        $(this.lightboxImageSelector).removeClass('show');
    }
}

new ImageViewer('.image-viewer');
</script>

<script>
    $(document).ready(function(){
    // var link = $('#pdfLink').val();
    // console.log(link);
    // PDFObject.embed(link, "#example1");

})
</script>
@endsection