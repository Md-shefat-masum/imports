
<div class="col-md-6 offset-md-3">

    Dear user,<br/>
    @if($action=='success')
        Your order was placed successfully.
    @else
        Your order was canceled.
    @endif

    <br/> <br/>


    <h3 class="text-center">Payment Details</h3> <br>
    <table border="1">

        <tbody>
        <tr>
            <td style="padding-left: 0;">Full Name</td>
            <td>{{$full_name}}</td>
        </tr><hr>
        <tr>
            <td style="padding-left: 0;">Order Total </td>
            <td>{{$order_total}}</td>
        </tr><hr>
        <tr>

            <td style="padding-left: 0;">Payment Type</td>
            <td style="text-transform: uppercase;">{{$payment_type}}</td>

        </tr><hr>


        </tbody>
    </table>

</div>