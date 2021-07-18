@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background: #fff;
    padding-bottom: 60px;">
            <h3 class="text-center">View VPOS Details</h3> <br>
            <div class="table-responsive">
                <table class="table">
                    <tbody>

                        <tr>
                            <td style="text-align: right;">Billing Name</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->first_name !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Email Address</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->email !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Billing Address</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->address !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Billing City</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->city !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Billing State</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->states !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Zip Code</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->zip_code !!}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Phone Number</td>
                            <td style="text-align: center;">:-</td>
                            <td>{!! $billingInfo->cell_phone !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <th>Product ID</th>

                        <th>Model</th>
                        <th>Bid Price</th>
                        <th>Shipping Price</th>
                        <th>Total Price</th>
                    </tr>


                    <tr>
                        @php
                            $orderId = $billingInfo->id;
                            $pre = "";
                            for($i=1; $i<=5-strlen($orderId); $i++)
                                $pre .="0";

                        @endphp
                        <td>{{ "A-".$pre.$orderId }}</td>
                        <td>{{ $billingInfo->product_id }}</td>
                        <td>{{ $billingInfo->model }}</td>
                        <td>{{ $billingInfo->bid_amount }}</td>
                        <td>{{ $billingInfo->shipping_amount }}</td>
                        @php
                            $b_p = $billingInfo->bid_amount;
                            $s_p = $billingInfo->shipping_amount;
                            $totalPrice = $b_p+$s_p;
                        @endphp
                        <td>{{ $totalPrice }}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection
