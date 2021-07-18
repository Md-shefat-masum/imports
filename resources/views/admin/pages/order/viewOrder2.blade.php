@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')

@endsection
@section('content')
    <br><br>
    <div class="container">
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
                        <h3 class="box-title">Orders List</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Payment Type</th>
                                    <th>Order Date</th>
                                    <th>Order Total</th>
                                    <th>Shipping Fee</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($orders as $row )
                                    @php
                                        $user = DB::table('users')->where('id', $row->user_id)->first();
                                    @endphp
                                    @if (Auth::user()->group_id == '5' || Auth::user()->group_id == '4')

                                        @if (Auth::user()->id == $row->user_id)
                                            @if($row->status == 0 )

                                                <tr>
                                                    @php
                                                        $orderId = $row->id;
                                                        $pre = "";
                                                        for($i=1; $i<=5-strlen($orderId); $i++)
                                                        $pre .="0";

                                                    @endphp
                                                    <td>{{ $row->id+1000 }}</td>
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
                                                        @if($row->status==0 &&($group_id==1 || $group_id==3))
                                                            <a class="btn btn-default" href="{!! url('pages/orders?action=process&id='.$row->user_id.'&order_id='.$row->id ) !!}" onclick="return confirm('Are you sure this is delivered?')">
                                                                Processing </a>
                                                        @endif

                                                        <a class="btn btn-default view" data-target="#{{ $row->id }}" data-toggle="modal" href="#">
                                                            View </a>


                                                        <!-- Modal -->
                                                        <div class="modal fade" id="{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content" style="width: 800px;">
                                                                    <div class="modal-header">
                                                                        <h2 class="modal-title text-center" id="exampleModalLongTitle">
                                                                            Order details</h2>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                                                <h4 class="text-center">
                                                                                                    <strong>Billing
                                                                                                        Info</strong>
                                                                                                </h4>
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-bordered">
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Billing
                                                                                                                Name
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->first_name." ".$user->last_name }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Email
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->email }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Billing
                                                                                                                Address
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->address }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Billing
                                                                                                                City
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->city }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Billing
                                                                                                                State
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->states }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Zip Code
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->zip_code }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Phone
                                                                                                                Number
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $user->cell_phone }}</td>
                                                                                                        </tr>

                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <h4 class="text-center">
                                                                                                    <strong>Shipping
                                                                                                        Info</strong>
                                                                                                </h4>
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-bordered">
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Shipping
                                                                                                                Name
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->first_name }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Shipping
                                                                                                                Email
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->user_email }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Shipping
                                                                                                                Address
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->address }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Shipping
                                                                                                                City
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->city }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Shipping
                                                                                                                State
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->states }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Zip Code
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->zip_code }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th style="border: 0;">
                                                                                                                Phone
                                                                                                                Number
                                                                                                            </th>
                                                                                                            <td style="border: 0;">
                                                                                                                :
                                                                                                            </td>
                                                                                                            <td style="border: 0;">{{ $shipping->cell_phone }}</td>
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
                                                                                                    <th>Product Name
                                                                                                    </th>
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
                                                                                                        <td>{{ number_format($detail->bid_price,2) }}</td>
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
                                                                                        <table class="table">
                                                                                            <tr>
                                                                                                <th style="border: 0;">
                                                                                                    Total Bidding Amount
                                                                                                </th>
                                                                                                <td style="border: 0;">
                                                                                                    :
                                                                                                </td>
                                                                                                <td style="border: 0;">{{ number_format($row->order_total,2) }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th style="border: 0;">
                                                                                                    Shipping Charge
                                                                                                </th>
                                                                                                <td style="border: 0;">
                                                                                                    :
                                                                                                </td>
                                                                                                <td style="border: 0;">{{ number_format($row->shipping_fee,2) }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th style="border: 0;">
                                                                                                    Net Amounts
                                                                                                </th>
                                                                                                <td style="border: 0;">
                                                                                                    :
                                                                                                </td>
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
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-info">
                                                                                Print
                                                                            </button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>

                                            @endif
                                        @endif
                                    @elseif (Auth::user()->group_id == '1')
                                        @if($row->status == 0 )

                                            <tr>
                                                @php
                                                    $orderId = $row->id;
                                                    $pre = "";
                                                    for($i=1; $i<=5-strlen($orderId); $i++)
                                                    $pre .="0";

                                                @endphp
                                                <td>{{ $row->id+1000 }}</td>
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
                                                    @if($row->status==0 &&($group_id==1 || $group_id==3))
                                                        <a class="btn btn-default" href="{!! url('pages/orders?action=process&id='.$row->user_id.'&order_id='.$row->id ) !!}" onclick="return confirm('Are you sure this is delivered?')">
                                                            Processing </a>
                                                    @endif

                                                    <a class="btn btn-default view" data-target="#{{ $row->id }}" data-toggle="modal" href="#">
                                                        View </a>
                                                    <a class="btn btn-default view" data-target="#{{ $row->id.$row->user_id }}" data-toggle="modal" href="#">
                                                        Delete </a>

                                                    @if(Auth::user()->email == 'hsblco_admin@gmail.com')

                                                        @php
                                                            $order_log = DB::table('orders_logs')->where('order_id', $row->id)->first();
                                                        @endphp

                                                        @if(!isset($order_log))
                                                        <form action="{{ route('create_order_log', $row->id)}}" method="post" style="display: inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-default view" href="{{ route('create_order_log', $row->id)}}">
                                                                Create Logs
                                                            </button>
                                                        </form>
                                                        @endif
                                                    @endif

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content" id="" style="width: 800px;">
                                                                <div class="modal-header">
                                                                    <h2 class="modal-title text-center" id="exampleModalLongTitle">
                                                                        Order details</h2>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                                            <h4 class="text-center">
                                                                                                <strong>Billing
                                                                                                    Info</strong></h4>
                                                                                            <table class="table table-bordered">
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing Name
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->first_name." ".$user->last_name }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Email
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->email }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing Address
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->address }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing City
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->city }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing State
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->states }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Zip Code
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->zip_code }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Phone Number
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->cell_phone }}</td>
                                                                                                </tr>

                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <h4 class="text-center">
                                                                                                <strong>Shipping
                                                                                                    Info</strong></h4>
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
                                                                                                        <td style="border: 0;">{{ $shipping->first_name }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            Email
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->user_email }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            Address
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->address }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            City
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->city }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            State
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->states }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Zip Code
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->zip_code }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Phone Number
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->cell_phone }}</td>
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
                                                                                        @foreach($details as $detail)
                                                                                            <tr>
                                                                                                <td>{{ $detail->order_id+1000 }}</td>
                                                                                                <td>{{ $detail->product_id }}</td>
                                                                                                <td>{{ $detail->p_name }}</td>
                                                                                                <td>{{ $detail->model }}</td>
                                                                                                <td>{{ $detail->quantity }}</td>
                                                                                                <td>{{ number_format($detail->bid_price,2) }}</td>
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

                                                                            <div class="pull-right" style="float:right; margin-top:50px; border-top:5px solid #ccc;">
                                                                                <table class="table">
                                                                                    <tr>
                                                                                        <th style="border: 0;">Total
                                                                                            Bidding Amount
                                                                                        </th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">{{ number_format($row->order_total,2) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Shipping
                                                                                            Charge
                                                                                        </th>
                                                                                        <td style="border: 0;">:</td>
                                                                                        <td style="border: 0;">{{ number_format($row->shipping_fee,2) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="border: 0;">Net
                                                                                            Amounts
                                                                                        </th>
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

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info print_cz" data-attr="{{$row->id}}">
                                                                        Print
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="print-section" style="position:fixed; bottom:101%;">
                                                            <div class="modal-content" id="printTable{{$row->id}}" style="width: 800px;">
                                                                <div class="modal-header">
                                                                    <div style="text-align:center; width:100%; clear:both; margin-bottom:0px;">
                                                                        <img style="max-width:200px;" src="{{ asset('/front_end/img/logo.png') }}" alt="logo">
                                                                    </div>
                                                                    <h2 class="modal-title text-center" id="exampleModalLongTitle" style="text-align:center;">
                                                                        ORDER DETAIL</h2>
                                                                    <hr>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-body">

                                                                                    <div class="row">
                                                                                        <div class="col-md-6" style="float:left">
                                                                                            <h4 class="text-center">
                                                                                                <strong>Billing
                                                                                                    Info</strong></h4>
                                                                                            <table class="table table-bordered" style="text-align:left;">
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing Name
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->first_name." ".$user->last_name }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Email
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->email }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing Address
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;width: 150px;">{{ $user->address }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing City
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->city }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Billing State
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->states }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Zip Code
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->zip_code }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th style="border: 0;">
                                                                                                        Phone Number
                                                                                                    </th>
                                                                                                    <td style="border: 0;">
                                                                                                        :
                                                                                                    </td>
                                                                                                    <td style="border: 0;">{{ $user->cell_phone }}</td>
                                                                                                </tr>

                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-md-6" style="float:right">
                                                                                            <h4 class="text-center">
                                                                                                <strong>Shipping
                                                                                                    Info</strong></h4>
                                                                                            <table class="table table-bordered" style="text-align:left;">
                                                                                                @if ($shipping)
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            Name
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->first_name }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            Email
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->user_email }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            Address
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;width: 150px;">{{ $shipping->address }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            City
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->city }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Shipping
                                                                                                            State
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->states }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Zip Code
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->zip_code }}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th style="border: 0;">
                                                                                                            Phone Number
                                                                                                        </th>
                                                                                                        <td style="border: 0;">
                                                                                                            :
                                                                                                        </td>
                                                                                                        <td style="border: 0;">{{ $shipping->cell_phone }}</td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div style="height:30px; width:100%; clear:both;">
                                                                                        &nbsp;
                                                                                    </div>
                                                                                    <table class="table table-bordered cz" style="margin-top:50px; border-top:5px solid #ccc; text-align:left;">
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
                                                                                                <td>{{ number_format($detail->bid_price,2) }}</td>
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
                                                                                                <td style="border: 0;">{{ number_format($row->order_total,2) }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th style="border: 0;">
                                                                                                    Shipping Charge
                                                                                                </th>
                                                                                                <td style="border: 0;">
                                                                                                    :
                                                                                                </td>
                                                                                                <td style="border: 0;">{{ number_format($row->shipping_fee,2) }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th style="border: 0;">
                                                                                                    Net Amounts
                                                                                                </th>
                                                                                                <td style="border: 0;">
                                                                                                    :
                                                                                                </td>
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

                                                                        <div class="modal-footer">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end print-section -->

                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ $row->id.$row->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content" id="" style="width: 800px;">
                                                                <div class="modal-header">
                                                                    <h2 class="modal-title text-center" id="exampleModalLongTitle">
                                                                        Order Delete</h2>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>Do you want to delete order !!</h3>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <a href="{{route('delete_order',$row->id)}}" class="btn btn-danger">Delete</a>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>

                                        @endif
                                    @endif

                                @endforeach
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

@section('scripts')
    <script>
        function printData(id) {
            printId = 'printTable' + id;
            var divToPrint = document.getElementById(printId);
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
                'border:1px solid #000;' +
                'padding:0.5em;' +
                '}' +
                '</style>' +
                '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        };

        $('button.print_cz').on('click', function () {
            var id = $(this).data('attr');

            printData(id);
        });

        //Alert bar display none
        $('.close-alert').click(function () {
            $(this).parent().hide();
        });
    </script>

@endsection
@endsection
