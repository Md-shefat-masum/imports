@extends('front_end.layouts.master')
@section('title', '|Product')
@section('stylesheet')
<style>
    /* Global settings */
    .product-image {
        float: left;
        width: 20%;
    }

    .product-details {
        float: left;
        width: 37%;
    }

    .product-price {
        float: left;
        width: 12%;
    }

    .product-quantity {
        float: left;
        width: 10%;
    }

    .product-removal {
        float: left;
        width: 9%;
    }

    .product-line-price {
        float: left;
        width: 12%;
        text-align: right;
    }

    /* This is used as the traditional .clearfix class */
    .group:before,
    .shopping-cart:before,
    .column-labels:before,
    .product:before,
    .totals-item:before,
    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        content: '';
        display: table;
    }

    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        clear: both;
    }

    .group,
    .shopping-cart,
    .column-labels,
    .product,
    .totals-item {
        zoom: 1;
    }

    /* Apply clearfix in a few places */
    /* Apply dollar signs */
    .product .product-price:before,
    .product .product-line-price:before,
    .totals-value:before {
        content: '$';
    }

    /* Body/Header stuff */

    .shopping-cart {
        margin-top: -45px;
    }

    /* Column headers */
    .column-labels label {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .column-labels .product-image,
    .column-labels .product-details,
    .column-labels .product-removal {
        text-indent: -9999px;
    }

    /* Product entries */
    .product {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .product .product-image {
        text-align: center;
    }

    .product .product-image img {
        width: 100px;
    }

    .product .product-details .product-title {
        margin-right: 20px;
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }

    .product .product-details .product-description {
        margin: 5px 20px 5px 0;
        line-height: 1.4em;
    }

    .product .product-quantity input {
        width: 40px;
    }

    .product .remove-product {
        border: 0;
        padding: 4px 8px;
        background-color: #c66;
        color: #fff;
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        font-size: 12px;
        border-radius: 3px;
    }

    .product .remove-product:hover {
        background-color: #a44;
    }

    /* Totals section */
    .totals .totals-item {
        float: right;
        clear: both;
        width: 100%;
        margin-bottom: 10px;
    }

    .totals .totals-item label {
        float: left;
        clear: both;
        width: 79%;
        text-align: right;
    }

    .totals .totals-item .totals-value {
        float: right;
        width: 21%;
        text-align: right;
    }

    .totals .totals-item-total {
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }

    .checkout {
        float: right;
        border: 0;
        margin-top: 20px;
        padding: 6px 25px;
        background-color: #6b6;
        color: #fff;
        font-size: 25px;
        border-radius: 3px;
    }

    .checkout:hover {
        background-color: #494;
    }

    /* Make adjustments for tablet */
    @media screen and (max-width: 650px) {
        .shopping-cart {
            margin: 0;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .column-labels {
            display: none;
        }

        .product-image {
            float: right;
            width: auto;
        }

        .product-image img {
            margin: 0 0 10px 10px;
        }

        .product-details {
            float: none;
            margin-bottom: 10px;
            width: auto;
        }

        .product-price {
            clear: both;
            width: 70px;
        }

        .product-quantity {
            width: 100px;
        }

        .product-quantity input {
            margin-left: 20px;
        }

        .product-quantity:before {
            content: 'x';
        }

        .product-removal {
            width: auto;
        }

        .product-line-price {
            float: right;
            width: 70px;
        }
    }

    /* Make more adjustments for phone */
    @media screen and (max-width: 350px) {
        .product-removal {
            float: right;
        }

        .product-line-price {
            float: right;
            clear: left;
            width: auto;
            margin-top: 10px;
        }

        .product .product-line-price:before {
            content: 'Item Total: $';
        }

        .totals .totals-item label {
            width: 60%;
        }

        .totals .totals-item .totals-value {
            width: 40%;
        }
    }
</style>
@endsection
@section('content')
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Session::has('delete_product_cart'))
<!-- /.box-header -->
<div class="box-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {!! session('delete_product_cart') !!}
    </div>
</div>
@endif

@if(Session::has('bidMessage'))
<!-- /.box-header -->
<div class="box-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {!! session('bidMessage') !!}
    </div>
</div>
@endif

@if(Session::has('bidMessageSuccess'))

<!-- /.box-header -->
<div class="box-body">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {!! session('bidMessageSuccess') !!}
    </div>
</div>
@endif


<div class="container">

    <div class="row">
        <div class="col-md-12">
            <form action="{{url('/shopping-cart-bid')}}" method="post">
                {{ csrf_field() }}


                <table class="table table-bordered table-hover">
                    <tr style="text-align: center;">
                        <th>Product</th>
                        <th>Unit Price</th>
                        {{-- <th>Bundle/Unit</th> --}}
                        <th>Min Order</th>
                        <th>Starting Price</th>
                        <th>Current Amount</th>
                        <th style="width: 210px;">Your Bid</th>
                        <th style="width: 110px;">Bundle</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>

                    @php
                    $i = 0;
                    $user_id = Auth::user()->id;
                    @endphp
                    @foreach($userCart as $cart)
                    @php
                    $i++;
                    $val=$cart->image;
                    $v=json_decode($val);
                    $product = DB::table('products')->where('id', $cart->product_id)->first();
                    // $all_bids = 0;
                    // $all_bids =
                    $dis_rate= DB::table('discount_products')->where('pro_id',$cart->product_id)->first();
                    if(isset($dis_rate)){
                    $dis = $dis_rate->discount_rate;
                    }else {
                    $dis = 0;
                    }
                    // dd($dis);
                    DB::table('all_bids')->where('product_id',$cart->product_id)->orderBy('id',"DESC")->first();

                    $start_time = DB::table('bid_resets')->latest()->first()->reset_at;
                    $start_time = Carbon\Carbon::parse($start_time)->subdays(1);
                    $end_time = Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at);
                    // dd($start_time,$end_time);


                    if(DB::table('all_bids')->where('product_id',$cart->product_id)->whereBetween('created_at',[$start_time,$end_time])->orderBy('id',"DESC")->exists()){
                    $all_bids = DB::table('all_bids')
                    ->where('product_id',$cart->product_id)
                    ->whereBetween('created_at',[$start_time,$end_time])
                    ->orderBy('id',"DESC")
                    ->first();
                    // dd($all_bids);
                    }else{
                    $all_bids = new App\AllBid;
                    $all_bids->your_bid = 0;
                    }
                    // dd($all_bids);
                    @endphp

                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">

                    <input type="hidden" value="{{$cart->product_id}}" name="product_id[]">

                    <input type="hidden" value="1" name="status">

                    <tr>
                        <!-- Product Image -->
                        <td>
                            <img src="{{ asset('images/product') }}/{{$v[0]}}" style="height:100px;width:100px;">
                        </td>

                        <!-- Unit Price -->
                        <td>$ {{ $product->price }}</td>

                        <!-- Min Order -->
                        <td>
                            {{ $product->min_quientity }}
                            <input type="hidden" class="min_order" value="{{ $product->min_quientity }}">
                        </td>

                        <!-- Starting Price -->
                        <td class="start_price_show">
                            {{-- <p>$ {{ (isset($all_bids)) ? $all_bids->your_bid+1 : $product->price+1 }}</p> --}}
                            <p>$ {{ $all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1 }}</p>
                            {{-- <input type="hidden" class="start_price" id="new_start_price" name="start_price[]" value="{{ (isset($all_bids)) ? $all_bids->your_bid+1 : $product->price+1 }}">
                            --}}
                            <input type="hidden" class="start_price" id="new_start_price" name="start_price[]"
                                value="{{ $all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1 }}">
                        </td>

                        <!-- Current Amount -->
                        <td id="currentBid">
                            <span> $ </span>

                            <span>{{ $all_bids->your_bid }}</span>
                            {{-- <input type="hidden" cl name="bid_price[]" value="{{ (isset($all_bids)) ? ($all_bids->your_bid+1)*$product->min_quientity : ($product->price+1)*$product->min_quientity }}"
                            class="max_bid_price"> --}}
                            {{-- <input type="hidden" cl name="bid_price[]" value="{{ $all_bids->your_bid>0 ? ($all_bids->your_bid+1)*$product->min_quientity : ($product->price+1)*$product->min_quientity }}"
                            class="max_bid_price"> --}}
                            <input type="hidden" name="bid_price[]" value="{{ $all_bids->your_bid }}"
                                class="max_bid_price">
                        </td>

                        <!-- Your Bid -->
                        <td>
                            {{-- <input type="number" name="your_bid[]" class="form-control yourBid" pleaseholder="Enter you bid" value="{{ (isset($all_bids)) ? $all_bids->your_bid+1 : $product->price+1 }}"
                            min="{{ (isset($all_bids)) ? $all_bids->your_bid+1 : $product->price+1 }}"> --}}
                            <input type="number" name="your_bid[]" class="form-control yourBid"
                                pleaseholder="Enter you bid"
                                value="{{ ($all_bids->your_bid>0) ? $all_bids->your_bid+1 : $product->price+1 }}"
                                min="{{ (isset($all_bids)) ? $all_bids->your_bid+1 : $product->price+1 }}">
                            @foreach($errors->all() as $error)
                            <p class="text-danger">{{$error}}</p>
                            @endforeach
                        </td>

                        <!-- Bundle -->
                        <td>
                            <input type="number" class="form-control quantity" name="quantity[]"
                                pleaseholder="Enter quantity" min="1" value="{{ $cart->quantity }}">
                            @foreach($errors->all() as $error)
                            <p class="text-danger">{{$error}}</p>
                            @endforeach
                        </td>
                        <td>
                            <span> $ </span>
                            <span class="currentAmount">
                                {{ $cart->quantity*$product->min_quientity*($all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1) }}
                            </span>
                        </td>
                        {{-- <td>{{$dis ?? Null}}</td> --}}
                        @if(isset($dis))

                        <td>{{$dis}} %</td>
                        @else
                        <td>0 %</td>
                        @endif


                        <td>

                            {{-- $ <span id="total"></span> --}}
                            <span> $ </span>
                            <span class="discounttotal-list">
                                {{$cart->discount_price+($cart->quantity*$product->min_quientity*($all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1))-($cart->quantity*$product->min_quientity*($all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1))*($dis/100)}}
                            </span>
                            @if(isset($dis))

                            <input type="hidden" id="dtotal" value="{{$dis}}">
                            @else
                            <input type="hidden" id="dtotal" name="discount_price[]" value="0">
                            @endif

                            <input type="hidden" class="discout-rate" name="discount[]" value="{{$dis}}">
                            <input type="hidden" class="max_dis_price" name="discount_price[]" value=" {{$cart->discount_price+($cart->quantity*$product->min_quientity*($all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1))-($cart->quantity*$product->min_quientity*($all_bids->your_bid>0 ? $all_bids->your_bid+1 : $product->price+1))*($dis/100)}}">

                        </td>
                        <!-- Remove Cart -->
                        <td>
                            <a class="remove-product" href="/cart/delete-product/{{$cart->id}}">
                                Remove
                            </a>
                        </td>
                    </tr>

                    @endforeach
                    {{-- <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th>$</th>
                            <th></th>
                        </tr>
                    </tfoot> --}}
                </table>

                <p> Your BID should be greater than the STARTING PRICE.</p>

                <button type="submit" class="btn btn-success pull-left" style="float:right" onclick="minMaxId();">Check
                    Out</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var $totalprice = $('#totalprice');
        var price = parseInt($.trim($totalprice.text()).replace(',', '.'));
        $totalprice.data('totalprice', price);
        $('#quantity').keyup(function () {
            var qty = this.value;
            var price = $totalprice.data('totalprice');
            var total = price * qty;

            $totalprice.html(total ? total : price);
        });
</script>
<script>
    $(document).ready(function () {

            /* Set rates + misc */
            var taxRate = 0.05;
            var shippingRate = 15.00;
            var fadeTime = 300;


            /* Assign actions */
            $('.product-quantity input').change(function () {
                updateQuantity(this);
            });

            $('.product-removal button').click(function () {
                removeItem(this);
            });


            /* Recalculate cart */
            function recalculateCart() {
                var subtotal = 0;

                /* Sum up row totals */
                $('.product').each(function () {
                    subtotal += parseFloat($(this).children('.product-line-price').text());
                });

                /* Calculate totals */
                var tax = subtotal * taxRate;
                var shipping = (subtotal > 0 ? shippingRate : 0);
                var total = subtotal + tax + shipping;

                /* Update totals display */
                $('.totals-value').fadeOut(fadeTime, function () {
                    $('#cart-subtotal').html(subtotal.toFixed(2));
                    $('#cart-tax').html(tax.toFixed(2));
                    $('#cart-shipping').html(shipping.toFixed(2));
                    $('#cart-total').html(total.toFixed(2));
                    if (total == 0) {
                        $('.checkout').fadeOut(fadeTime);
                    } else {
                        $('.checkout').fadeIn(fadeTime);
                    }
                    $('.totals-value').fadeIn(fadeTime);
                });
            }


            /* Update quantity */
            function updateQuantity(quantityInput) {
                /* Calculate line price */
                var productRow = $(quantityInput).parent().parent();
                var price = parseFloat(productRow.children('.product-price').text());
                var quantity = $(quantityInput).val();
                var linePrice = price * quantity;

                /* Update line price display and recalc cart totals */
                productRow.children('.product-line-price').each(function () {
                    $(this).fadeOut(fadeTime, function () {
                        $(this).text(linePrice.toFixed(2));
                        recalculateCart();
                        $(this).fadeIn(fadeTime);
                    });
                });
            }


            /* Remove item from cart */
            // function removeItem(removeButton) {
            //     /* Remove row from DOM and recalc cart total */
            //     var productRow = $(removeButton).parent().parent().find('.');
            //     productRow.slideUp(fadeTime, function () {
            //         productRow.remove();
            //         recalculateCart();
            //     });
            // }

            //hasnat work
            $(document).on('change', '.yourBid', function () {
                var bid_price = $(this).val();
                var current_bid = $(this).parents('tr').find('.start_price').val();

                if (current_bid > bid_price) {
                    alert('Your bid price is lower than current bid price ?');
                    $(this).val(parseFloat(current_bid) + 1);

                }
            });
        

        });


</script>


<script>
    $(document).ready(function () {
            $(".quantity").keyup(function () {
                var quantity = $(this).parents('tr').find('.quantity').val();
                var startPrice = $(this).parents('tr').find('.start_price_show').find('input').val();
                var yourBid = $(this).parents('tr').find('.yourBid').val();
                var minOrder = $(this).parents('tr').find('.min_order').val();
                var dt = parseInt($(this).parents('tr').find('#dtotal').val());
                //console.log(startPrice);
                var dis = dt/100;
                var discountrate = quantity * yourBid * minOrder * dis;
                // alert(discounttotalPrice);
                var newStartPrice = quantity * yourBid * minOrder;

                var discounttotalPrice = newStartPrice - discountrate;
                // document.getElementById("total").innerHTML = discounttotalPrice;
                $(this).parents('tr').find('.currentAmount').html(newStartPrice);
                $(this).parents('tr').find('.discounttotal-list').html(discounttotalPrice);
                $(this).parents('tr').find('.discounttotal').html(discounttotalPrice);
                $(this).parents('tr').find('.max_bid_price').val(newStartPrice);
                $(this).parents('tr').find('.discout-rate').val(dt);
                $(this).parents('tr').find('.max_dis_price').val(discounttotalPrice);
            });
            $(".quantity").click(function () {
                var quantity = $(this).parents('tr').find('.quantity').val();
                var startPrice = $(this).parents('tr').find('.start_price_show').find('input').val();
                var yourBid = $(this).parents('tr').find('.yourBid').val();
                var minOrder = $(this).parents('tr').find('.min_order').val();
                var dt = parseInt($(this).parents('tr').find('#dtotal').val());
            
                //console.log(startPrice);
                var dis = dt/100;
                var discountrate = quantity * yourBid * minOrder * dis;
                var newStartPrice = quantity * yourBid * minOrder;

                var discounttotalPrice = newStartPrice - discountrate;
                //console.log(yourBid);
                //console.log(newStartPrice);
                // $(this).parents('tr').find('.discounttotal').html(discounttotalPrice);
                $(this).parents('tr').find('.currentAmount').html(newStartPrice);
                $(this).parents('tr').find('.discounttotal-list').html(discounttotalPrice);
               
                $(this).parents('tr').find('.max_bid_price').val(newStartPrice);
                $(this).parents('tr').find('.discout-rate').val(dt);
                $(this).parents('tr').find('.max_dis_price').val(discounttotalPrice);
                // alert(dt);
            });

            $(".yourBid").keyup(function () {
                var quantity = $(this).parents('tr').find('.quantity').val();
                var startPrice = $(this).parents('tr').find('.start_price_show').find('input').val();
                var yourBid = $(this).parents('tr').find('.yourBid').val();
                var minOrder = $(this).parents('tr').find('.min_order').val();
                var dt = parseInt($(this).parents('tr').find('#dtotal').val());
                var dis = dt/100;
                var discountrate = quantity * yourBid * minOrder * dis;
                // alert(discounttotalPrice);
                var newStartPrice = quantity * yourBid * minOrder;

                var discounttotalPrice = newStartPrice - discountrate;
                // document.getElementById("total").innerHTML = discounttotalPrice;
                $(this).parents('tr').find('.currentAmount').html(newStartPrice);
                $(this).parents('tr').find('.discounttotal-list').html(discounttotalPrice);
                $(this).parents('tr').find('.max_bid_price').val(newStartPrice);
                $(this).parents('tr').find('.discout-rate').val(dt);
                $(this).parents('tr').find('.max_dis_price').val(discounttotalPrice);
            });
            $(".yourBid").click(function () {
                var quantity = $(this).parents('tr').find('.quantity').val();
                var startPrice = $(this).parents('tr').find('.start_price_show').find('input').val();
                var yourBid = $(this).parents('tr').find('.yourBid').val();
                var minOrder = $(this).parents('tr').find('.min_order').val();
                var dt = parseInt($(this).parents('tr').find('#dtotal').val());
                var dis = dt/100;
                var discountrate = quantity * yourBid * minOrder * dis;
                // alert(discounttotalPrice);
                var newStartPrice = quantity * yourBid * minOrder;

                var discounttotalPrice = newStartPrice - discountrate;
                // document.getElementById("total").innerHTML = discounttotalPrice;
                $(this).parents('tr').find('.currentAmount').html(newStartPrice);
                $(this).parents('tr').find('.discounttotal-list').html(discounttotalPrice);
                $(this).parents('tr').find('.max_bid_price').val(newStartPrice);
                $(this).parents('tr').find('.discout-rate').val(dt);
                $(this).parents('tr').find('.max_dis_price').val(discounttotalPrice);
            });
        });

</script>
@endsection