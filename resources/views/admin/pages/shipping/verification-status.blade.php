@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')

@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> Verification Status</h3>
                    </div>
                    <div class="col-md-6 text-right card_header_btn">

                    </div>
                </div>
            </div>
            <div id="printableTable" class="card-body table-responsive">
                <table cellspacing="0" bordercolor="gray" id="allTable"
                    class=" table table-bordered custom_table custom_table_btn">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Payment Type</th>
                            <th>Order Date</th>
                            <th>Order Total</th>
                            <th>Shipping Fee</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orders as $row )
                        @if($row->status == 3 )
                        <tr>
                            @php
                            $orderId = $row->id;
                            $pre = "";
                            for($i=1; $i<=5-strlen($orderId); $i++) $pre .="0" ; @endphp <td>{{ $row->id+1000 }}</td>
                                <td>{{ $row->first_name." ".$row->last_name }}</td>
                                <td>{{ $row->payment_type }}</td>
                                <td>{{ $row->order_date }}</td>
                                <td>$ {{ number_format($row->order_total,2) }}</td>
                                <td>$ {{ number_format($row->shipping_fee,2) }}</td>

                                <td>$
                                    @php
                                    $sp = $row->shipping_fee;
                                    $pp = $row->order_total;
                                    $total = $sp+$pp;
                                    @endphp
                                    {{ number_format($total,2) }}
                                </td>
                                <td>
                                    @php
                                    $group_id=Auth::user()->group_id;
                                    @endphp
                                    @if($row->status==0 &&($group_id==1 || $group_id==2))
                                    <a class="btn btn-default"
                                        href="{!! url('pages/orders?action=process&id='.$orderId ) !!}"
                                        onclick="return confirm('Are you sure you want to accept?')"> Processing </a>
                                    @elseif($row->status==1 &&($group_id==1 || $group_id==3))
                                    <a class="btn btn-default"
                                        href="{!! url('pages/orders?action=deliver&id='.$orderId ) !!}"
                                        onclick="return confirm('Are you sure you want to cancel?')"> Deliver </a>
                                    @endif
                                    <a class="btn btn-success" href="#"> Pending </a>
                                    <a class="btn btn-info" type="button" data-target="#rowid{{ $row->id }}"
                                        data-toggle="modal" href="#"> View </a>


                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="rowid{{ $row->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content" style="width: 800px;">
                                                <div class="modal-header"
                                                    style="background: #0d1625;border: 1px solid #0d1625;">
                                                    <h2 class="modal-title text-center" id="exampleModalLongTitle">Order
                                                        details</h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-body">
                                                                    @php
                                                                    $id = $row->user_id;
                                                                    $orderId = $row->id;
                                                                    $user = DB::table('users')
                                                                    ->where('id',$id)
                                                                    ->first();
                                                                    $details = DB::table('order_details')
                                                                    ->join('products','order_details.product_id','=','products.id')
                                                                    ->select('order_details.*','products.*')
                                                                    ->where('order_id',$orderId)
                                                                    ->get();
                                                                    $shipping = DB::table('order_details')
                                                                    ->join('delevery__addresses','order_details.user_id','=','delevery__addresses.user_id')
                                                                    ->select('order_details.user_id','delevery__addresses.*')
                                                                    ->where('delevery__addresses.user_id',$id)
                                                                    ->first();

                                                                    @endphp
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h4 class="text-center"><strong>Billing
                                                                                    Info</strong></h4>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <tr>
                                                                                        <th style="border: 0;">Billing
                                                                                            Name</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->first_name." ".$user->last_name }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Email
                                                                                        </th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->email }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Billing
                                                                                            Address</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->address }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Billing
                                                                                            City</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->city }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Billing
                                                                                            State</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->states }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Zip Code
                                                                                        </th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->zip_code }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Phone
                                                                                            Number</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $user->cell_phone }}</td>
                                                                                    </tr>

                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h4 class="text-center"><strong>Shipping
                                                                                    Info</strong></h4>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            Name</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->first_name }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            Email</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->user_email }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            Address</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->address }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            City</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->city }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            State</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->states }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Zip Code
                                                                                        </th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->zip_code }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Phone
                                                                                            Number</th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">
                                                                                            {{ $shipping->cell_phone }}
                                                                                        </td>
                                                                                    </tr>

                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th>Order ID</th>
                                                                                <th>Product ID</th>
                                                                                <th>Product Name</th>
                                                                                <th>Model</th>
                                                                                <th>Order Unit</th>
                                                                                <th>Unit Price</th>
                                                                                <th>Total Price</th>
                                                                            </tr>
                                                                            @foreach($details as $detail)
                                                                            <tr>
                                                                                <td>{{ $detail->order_id+1000 }}</td>
                                                                                <td>{{ $detail->product_id }}</td>
                                                                                <td>{{ $detail->p_name }}</td>
                                                                                <td>{{ $detail->model }}</td>
                                                                                <td>{{ $detail->quantity }}</td>
                                                                                <td>{{ number_format($detail->bid_price,2) }}
                                                                                </td>
                                                                                <td>
                                                                                    @php
                                                                                    $qty = $detail->quantity;
                                                                                    $price = $detail->bid_price;
                                                                                    $total = $price*$qty;
                                                                                    @endphp
                                                                                    {{ number_format($total,2) }}
                                                                                </td>
                                                                            </tr>

                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="pull-right">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tr>
                                                                                <th style="border: 0;">Total Bidding
                                                                                    Amount</th>
                                                                                <td style="border: 0;">:</td>
                                                                                <td style="border: 0;">
                                                                                    {{ number_format($row->order_total,2) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="border: 0;">Shipping Charge
                                                                                </th>
                                                                                <td style="border: 0;">:</td>
                                                                                <td style="border: 0;">
                                                                                    {{ number_format($row->shipping_fee,2) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="border: 0;">Net Amounts</th>
                                                                                <td style="border: 0;">:</td>
                                                                                <td style="border: 0;">
                                                                                    @php
                                                                                    $sf= $row->shipping_fee;
                                                                                    $ot= $row->order_total;
                                                                                    $grand_total = $sf+$ot;
                                                                                    @endphp
                                                                                    {{ number_format($grand_total,2) }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
                <div id="editor"></div>
                <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
            </div>
            <div class="card-footer header-part">
                <button onclick="generatePDF()" class="btn btn-sm btn-danger">PDF</button>
                <button onclick="$('table').tblToExcel();" class="btn btn-sm btn-success">EXCEL</button>
                <button id="csv" class="btn btn-sm btn-info">CSV</button>
                <button id="json" class="btn btn-sm btn-warning">JSON</button>
                <button onclick="printDiv()" class="btn btn-sm btn-primary">PRINT</button>
            </div>
        </div>
    </div>

</div>

@section('scripts')
@endsection
@endsection