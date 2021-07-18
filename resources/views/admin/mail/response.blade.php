
<div class="col-md-6 offset-md-3">
    <h3 class="text-center">Payment Details</h3> <br>
    <table class="table">

        <tbody>
        <tr>

            <td style="padding-left: 0;">Full Name</td>
            <td>{{$full_name}}</td>

        </tr><hr>
        <tr>

            <td style="padding-left: 0;">Biding Amount</td>
            <td>{{$bid_amount}}</td>

        </tr><hr>
        <tr>

            <td style="padding-left: 0;">Shipping Amount</td>
            <td>{{$shipping_amount}}</td>

        </tr><hr>
        <tr>

            <td style="padding-left: 0;">Payment Type</td>
            <td style="text-transform: uppercase;">{{$payment_type}}</td>

        </tr><hr>
        <tr>

            <td style="padding-left: 0;">Total Amount</td>
            <td>{{$bid_amount+$shipping_amount}}</td>

        </tr>



        </tbody>
    </table>

</div>