@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">VPOS</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-success text-center">
                            <h2>{{ session('message') }}</h2>
                        </div>
                    @endif
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th> Action </th>
                            </tr>

                            @foreach( $vpos as $row )
                            <tr>
                                @php
                                    $orderId = $row->id;
                                    $pre = "";
                                    for($i=1; $i<=5-strlen($orderId); $i++)
                                        $pre .="0";

                                @endphp
                                <td>{{ $row->id+1000 }}</td>
                                <td>{{ $row->full_name }}</td>
                                <td>{{ $row->telephone }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @if($row->status==0)
                                        Pending
                                    @elseif($row->status==1)
                                        Accepted
                                    @else
                                        Canceled
                                    @endif
                                </td>
                                <td>
                                    @if($row->status==0)
                                    <a class="btn btn-default" href="{!! url('pages/vpos?action=accept&id='.$row->id ) !!}"  onclick="return validateForm();" > Accept </a>
                                    <a class="btn btn-default" href="{!! url('pages/vpos?action=cancel&id='.$row->id ) !!}" onclick="return confirm('Are you sure you want to cancel?')" > Cancel </a>
                                    @else

                                    @endif
                                        <a class="btn btn-default view" data-target="#{{ $row->id }}" data-toggle="modal" href="#"> View </a>


                                        <!-- Modal -->
                                        <div class="modal fade" id="{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content" style="width: 800px">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center" id="exampleModalLongTitle">VPOS details</h5>
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
                                                                            $userAddress = DB::table('users')->where('id',$id)->first();

                                                                        @endphp
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <h4 class="text-center"><strong>Billing Info</strong></h4>
                                                                                <div class="table-responsive">

                                                                                    <table class="table table-bordered" >
                                                                                        <tr>
                                                                                            <th style="border: 0;">Billing Name</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->first_name }} {{ $userAddress->last_name }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Email</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->email }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Billing Address</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->address }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Billing City</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->city }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Billing State</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->states }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Zip Code</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->zip_code }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Phone Number</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if (isset($userAddress))
                                                                                                    {{ $userAddress->cell_phone }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                    </table>
                                                                                </div>
                                                                            </div>

                                                                            @php

                                                                                $shipping = DB::table('delevery__addresses')
                                                                                    ->where('delevery__addresses.user_id',$id)
                                                                                    ->first();
                                                                            @endphp
                                                                            <div class="col-md-6">
                                                                                <h4 class="text-center"><strong>Shipping Info</strong></h4>
                                                                                <div class="table-responsive">

                                                                                    <table class="table table-bordered" >
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping Name</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->first_name }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping Email</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->user_email }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping Address</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->address }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping City</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->city }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping State</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->states }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Zip Code</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->zip_code }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Phone Number</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ $shipping->cell_phone }}</td>
                                                                                        </tr>

                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>

                                                                        @php
                                                                            $details = DB::table('order_details')
                                                                                ->join('vpos','order_details.vpos_id','=','vpos.id')
                                                                                ->join('products','order_details.product_id','=','products.id')
                                                                                ->select('order_details.*','products.*')
                                                                                ->where('order_details.vpos_id',$orderId)
                                                                                ->get();
                                                                        @endphp

                                                                        <div style="width: 99%">
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
                                                                            <div class="pull-right">
                                                                                <div class="table-responsive">

                                                                                    <table class="table">
                                                                                        <tr>
                                                                                            <th style="border: 0;">Total Bidding Amount</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">{{ number_format($row->order_total,2) }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Shipping Charge</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">
                                                                                                @if($row->shipping_amount == NULL)
                                                                                                    {{ number_format(0,2) }}
                                                                                                @else
                                                                                                    {{ number_format($row->shipping_amount,2) }}
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th style="border: 0;">Net Amounts</th>
                                                                                            <td style="border: 0;">:</td>
                                                                                            <td style="border: 0;">

                                                                                                @php
                                                                                                $sa= $row->shipping_amount;
                                                                                                $ot= $row->order_total;
                                                                                                $grand_total = $sa+$ot;

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
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var confirm_check =  confirm('Are you sure you want to accept ?');
            if(confirm_check)
            {
                window.open("https://geniecashbox.com/vpos/?cashbox=6099007707", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");
                return true;
            } else {
                return false;
            }

        }
    </script>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@section('scripts')
    {{--<script>--}}
        {{--function showDetails(button) {--}}
            {{--var id = button.id;--}}
            {{--$ajax({--}}
                {{--url: "view-details.blade.php?id="+id,--}}
                {{--method:"GET",--}}
                {{--data: {"id": id},--}}
                {{--success: function (response) {--}}
                    {{--alert(response);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
    {{--</script>--}}

@endsection
@endsection
