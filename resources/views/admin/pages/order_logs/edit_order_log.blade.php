@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
<style>
    table tr th {
        padding-top: 12px !important;
    }
</style>
@endsection
@section('content')
    <br><br>
    <div class="container">
        @if($errors->any())
            <div class="row">
                <div class="col-md-12">
                    <!-- start: SECTION FLASH MESSAGE -->
                    <p class="btn btn-block btn-lg btn-danger close-alert">
                        {{ implode('', $errors->all(':message')) }}
                        <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                    <!-- end: SECTION FLASH MESSAGE -->
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <!-- start: SECTION FLASH MESSAGE -->
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="btn btn-block btn-lg btn-{{ $msg }} close-alert">
                            {{ Session::get('alert-' . $msg) }}
                            <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                @endif
            @endforeach
            <!-- end: SECTION FLASH MESSAGE -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Order Logs</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm">
                                <a href="{{ route('view_order_log') }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form action="{{ route('update_order_log', $order_logs->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-center">
                                        <strong>Billing Info</strong></h4>
                                    @php
                                        $billing_address = DB::table('order_log_billing_address')->where('order_log_id', $order_logs->id)->first();
                                    @endphp
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="border: 0;">
                                                Billing Name
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_name" value="{{ $billing_address->name }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Email
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="email" name="billing_email" value="{{ $billing_address->email }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Billing Address
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_address" value="{{ $billing_address->address }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Billing City
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_city" value="{{ $billing_address->city }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Billing State
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_state" value="{{ $billing_address->state }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Zip Code
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_zip_code" value="{{ $billing_address->zip_code }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: 0;">
                                                Phone Number
                                            </th>
                                            <td style="border: 0;">
                                                :
                                            </td>
                                            <td style="border: 0;">
                                                <input class="form-control" type="text" name="billing_phone_number" value="{{ $billing_address->phone_number }}">
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-center"><strong>Shipping Info</strong></h4>
                                    @php
                                        $shipping = DB::table('order_log_shipping_address')->where('order_log_id', $order_logs->id)->first();
                                    @endphp
                                    <table class="table table-bordered">
                                        @if ($shipping)
                                            <tr>
                                                <th style="border: 0;">
                                                    Shipping
                                                    Name
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_name" value="{{ $shipping->name }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Shipping
                                                    Email
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="email" name="shipping_email" value="{{ $shipping->email }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Shipping
                                                    Address
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_address" value="{{ $shipping->address }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Shipping
                                                    City
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_city" value="{{ $shipping->city }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Shipping
                                                    State
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_state" value="{{ $shipping->state }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Zip Code
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_zip_code" value="{{ $shipping->zip_code }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border: 0;">
                                                    Phone Number
                                                </th>
                                                <td style="border: 0;">
                                                    :
                                                </td>
                                                <td style="border: 0;">
                                                    <input class="form-control" type="text" name="shipping_phone_number" value="{{ $shipping->phone_number }}">
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <br>
                            <br>
                            <table class="table table-bordered" style=" border-top:5px solid #ccc;">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Model</th>
                                    <th>Order Unit</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                                @php
                                    $order_log_details = DB::table('order_log_details')->where('order_log_id', $order_logs->id)->get();
                                @endphp
                                @foreach($order_log_details as $detail)
                                    <tr class="order_log_details">
                                        <td>{{ $detail->order_id+1000 }}</td>
                                        <td>{{ $detail->product_id }}</td>
                                        @php
                                            $product = DB::table('products')->where('id', $detail->product_id)->first();
                                        @endphp
                                        <td>{{ $product->p_name }}</td>
                                        <td>{{ $product->model }}</td>
                                        <td>
                                            <input class="form-control order_log_quantity" style="width: 90px;" type="number" name="quantity[]" value="{{ $detail->quantity }}" min="1">
                                            <input type="hidden" class="unit_price" name="unit_price[]" value="{{ $detail->bid_price }}">
                                            <input type="hidden" class="product_id" name="product_id[]" value="{{ $product->id }}">
                                        </td>
                                        <td>{{ number_format($detail->bid_price,2) }}</td>
                                        <td class="log_total">
                                            @php
                                                $qty = $detail->quantity;
                                                $price = $detail->bid_price;
                                                $total = $price*$qty;
                                            @endphp
                                            <span class="order_log_total">{{ number_format($total,2) }}</span>
                                            <input type="hidden" class="single_total" value="{{ $total }}">
                                        </td>
                                    </tr>

                                @endforeach
                            </table>

                            <div style="height:30px; width:100%; clear:both;">
                                &nbsp;
                            </div>
                            <div class="pull-right" style="float:right; margin-top:50px; border-top:5px solid #ccc; text-align:left;">
                                <table class="table">
                                    <tr>
                                        <th style="border: 0;">
                                            Total Bidding Amount
                                        </th>
                                        <td style="border: 0;">
                                            :
                                        </td>
                                        <td style="border: 0;">
                                            <span class="total_bidding_amount">{{ number_format($order_logs->order_total, 2) }}</span>
                                            <input class="total_bidding" type="hidden" value="{{ $order_logs->order_total }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border: 0;">
                                            Shipping Charge
                                        </th>
                                        <td style="border: 0;">
                                            :
                                        </td>
                                        <td style="border: 0;">
                                            <input class="form-control shipping_charge" name="shipping_fee" style="width: 80px;" type="number" min="0" value="{{ ($order_logs->shipping_fee == null) ? '0.00' : $order_logs->shipping_fee }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border: 0;">
                                            Net Amounts
                                        </th>
                                        <td style="border: 0;">
                                            :
                                        </td>
                                        <td style="border: 0;">
                                            <span class="net_amounts">{{ number_format($order_logs->order_total+$order_logs->shipping_fee, 2) }}</span>
                                            <input class="input_net_amounts" type="hidden" name="order_total" value="{{ $order_logs->order_total+$order_logs->shipping_fee }}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

@section('scripts')
<script>
    $(document).ready(function () {
        $('.order_log_quantity').change(function () {
            var quantity = $(this).val();
            var unit_price = $(this).parent().find('.unit_price').val();
            var total = parseInt(quantity)*parseInt(unit_price);
            $(this).parent().parent().find('.order_log_total').html(total.toFixed(2));
            $(this).parent().parent().find('.single_total').val(total);

            var total = 0;
            $('.single_total').each(function(){
                total += parseInt($(this).val());
            });

            $('.total_bidding_amount').html(total.toFixed(2));
            $('.total_bidding').val(total);
            var shipping = $('.shipping_charge').val();

            var netAmounts = parseInt(total)+parseInt(shipping);
            $('.net_amounts').html(netAmounts.toFixed(2));
            $('.input_net_amounts').val(netAmounts);

        });

        $('.shipping_charge').change(function () {
            var shipping = $(this).val();
            var totalBidding = $('.total_bidding').val();
            var netAmounts = parseInt(shipping)+parseInt(totalBidding);
            $('.net_amounts').html(netAmounts.toFixed(2));
            $('.input_net_amounts').val(netAmounts);
        });

        //Alert bar display none
        $('.close-alert').click(function () {
            $(this).parent().hide();
        });
    });
</script>
@endsection
@endsection
