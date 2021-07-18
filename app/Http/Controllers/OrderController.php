<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Mail\OrderMailTwo;
use App\Mail\ShippingMail;
use App\Menu;
use App\ProductCategory;
use App\User;
use App\Vpos;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;
use GuzzleHttp\Client;

class OrderController extends Controller
{
    private $_header;
    private $_host;

    public function __construct()
    {
        $this->_header = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ];
        $this->_host = 'https://epaymaker.com/';
    }

    public function delete_order($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        Session::flash('success', 'Delete Successfully..');
        return redirect()->back()->with('message', "Thanks you operation completed!");
    }

    public function viewOrder(Request $request)
    {

        if (isset($_GET['verification']) && isset($_GET['_token'])) {
            $id = $request->id;
            $token = DB::table('orders')->where('id', $id)->select('order_verification')->first();
            if ($request->_token == $token->order_verification) {
                DB::table('orders')->where('id', $id)->update([
                    'status' => 2,
                    'order_verification' => Carbon::now(),
                ]);
                return 'Thank  you for your order';
            }
            return 'Your Order is Not Submited Please Login first';
        }

        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'process') {
                $orderId = $request->order_id;
                $id = $request->id;
                $token_key = str_random(150);

                DB::table('orders')->where('id', $orderId)->update([
                    'status' => 3,
                    'order_verification' => $token_key,
                ]);

                $user = User::findOrFail($id);

                $data = array(
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'message' => 'Your Shipping is on Processing',
                    'token' => $token_key,
                    'id' => $user->id,
                );

                Mail::to($data['email'])->send(new ShippingMail($data));
                return redirect()->route('verification-status')->with('message', "Thanks you operation completed!");

            } elseif ($_GET['action'] == 'deliver') {
                $orderId = $request->order_id;
                $id = $request->id;
                $token_key = str_random(150);

                DB::table('orders')->where('id', $orderId)->update(['status' => 2]);

                return redirect()->route('shipping-delivered')->with('message', "Thanks you operation completed!");
            }
        }

        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.first_name', 'users.last_name', 'users.cell_phone')
            ->orderBy('orders.id', 'DESC')->get();

        $vpos_order = DB::table('vpos')->orderBy('id', 'desc')->get();

        return view('admin.pages.order.viewOrder', compact('orders', 'vpos_order'));
    }

    public function verificationStatus(Request $request)
    {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'deliver') {
                $id = $request->id;

                DB::table('orders')->where('id', $id)->update(['status' => 2]);

                return redirect('pages/shipping')->with('message', "Thanks you operation completed!");
            }
        }
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.first_name', 'users.last_name', 'users.cell_phone')
            ->orderBy('orders.id', 'DESC')->get();

        return view('admin.pages.shipping.verification-status', compact('orders'));
    }

    public function shipping(Request $request)
    {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'deliver') {
                $id = $request->id;

                DB::table('orders')->where('id', $id)->update(['status' => 2]);

                return redirect('pages/shipping')->with('message', "Thanks you operation completed!");
            }
        }
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.first_name', 'users.last_name', 'users.cell_phone')
            ->orderBy('orders.id', 'DESC')->get();

        return view('admin.pages.shipping.shipping-list', compact('orders'));
    }

    public function shippingDelivered(Request $request)
    {

        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.first_name', 'users.last_name', 'users.cell_phone')
            ->orderBy('orders.id', 'DESC')->get();

        return view('admin.pages.shipping.shipping-delivered', compact('orders'));
    }

    public function vpos(Request $request)
    {

        if (isset($_GET['action'])) { //print_r($_GET); exit;
            if ($request->action == 'accept') {
                $id = $request->id;
                $O_info = DB::table('vpos')->where('id', $id)->first();
                DB::table('vpos')->where('id', $id)->update(['status' => 1]);

                $order_date = date("Y-m-d", strtotime($O_info->created_at));
                $O_data = array(
                    array('user_id' => $O_info->user_id, 'payment_type' => 'vpos', 'order_total' => $O_info->order_total, 'shipping_fee' => $O_info->shipping_amount, 'order_date' => $order_date),
                );
                DB::table('orders')->insert($O_data);
                $order_id = DB::table('orders')->select('id')->orderBy('id', "DESC")->first()->id;
                DB::table('order_details')->where('vpos_id', $id)->update(['order_id' => $order_id]);

                $data['action'] = 'success';
                $data['payment_type'] = 'VPOS';
                $data['full_name'] = $O_info->full_name;
                $data['order_total'] = $O_info->order_total;
                $data['email'] = $O_info->email;

                //dd($data);

                Mail::send('admin.mail.vpos', $data, function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject('Payment Details!');
                });

                return redirect('pages/vpos')->with('message', "Thanks you operation completed!");
            } else if ($request->action == 'cancel') {

                $id = $request->id;

                DB::table('vpos')->where('id', $id)->update(['status' => 2]);
                $order_info = DB::table('vpos')->where('id', $id)->first();

                $data['action'] = 'cancel';
                $data['payment_type'] = 'VPOS';
                $data['full_name'] = $order_info->full_name;
                $data['order_total'] = $order_info->order_total;
                $data['email'] = $order_info->email;

                //dd($data);

                Mail::send('admin.mail.vpos', $data, function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject('Bid Status!');
                });
                return redirect('pages/vpos')->with('message', "Thanks you operation completed!");
            }

        }

        $vpos = DB::table('vpos')->orderBy('id', 'DESC')->get();

        return view('admin.pages.order.vpos', compact('vpos'));
    }

    public function placeOrder()
    {
        $menu = Menu::all();

        $productCategory = ProductCategory::all();
        return view('front_end.pages.place-order', compact('menu', 'productCategory'));
    }

    public function place_order_vpos()
    {
        return view('front_end.pages.place-order-vpos');
    }

    public function saveOrder(Request $request)
    {
        $total = 0;
        $user_id = Auth::user()->id;
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
        $time = Carbon::now();
        $data = array(
            'url' => 'www.google.com',
            'time' => '12:00am',
            'userType' => 'Admin',
        );

        if (isset($userCart[0])) {
            foreach ($userCart as $cart) {
                $bid_info = DB::table('all_bids')->where('product_id', $cart->product_id)->orderBy('id', "DESC")->first();

                if (isset($bid_info->quantity)) {
                    $total += ($bid_info->bid_price * $bid_info->quantity);
                }
            }
        }

        $vpos_id = 0;
        $order_id = 0;

        $authUser = Auth::user();

        if ($request->payment_type == 'epaymaker' && $total > 0) {

            //ePayMaker Payment
            $order_date = date("Y-m-d");
            $payment_type = $request->payment_type;
            $shipping_fee = $request->shipping_amount;
            $todayDate = Carbon::now();
            $InsertData = array(
                array(
                    'user_id' => $user_id,
                    'payment_type' => $payment_type,
                    'order_total' => $total,
                    'shipping_fee' => $shipping_fee,
                    'order_date' => $order_date,
                ),
            );

            DB::table('orders')->insert($InsertData);

            $order_id = DB::table('orders')->select('id')->orderBy('id', "DESC")->first()->id;

            foreach ($userCart as $cart) {
                $bid_info = DB::table('all_bids')->where('product_id', $cart->product_id)->orderBy('id', "DESC")->first();
                if (isset($bid_info->quantity)) {
                    $order_details = array(
                        array(
                            'order_id' => $order_id,
                            'vpos_id' => $vpos_id,
                            'user_id' => $user_id,
                            'product_id' => $bid_info->product_id,
                            'bid_price' => $bid_info->bid_price,
                            'quantity' => $bid_info->quantity,
                        ),
                    );
                    DB::table('order_details')->insert($order_details);
                }
            }

            $token = (string) Str::orderedUuid();
            $dataApi = array(
                array(
                    'order_total' => $total,
                    'shipping_fee' => $shipping_fee,
                    'order_date' => $order_date,
                    'email' => $authUser->email,
                    'telephone' => $authUser->cell_phone,
                    'first_name' => $authUser->first_name,
                    'last_name' => $authUser->last_name,
                    'fwi_order_id' => $order_id+1000,
                    'token' => $token,
                ),
            );
            DB::table('carts')->where('session_id', '=', $session_id)->delete();

            $client = new Client();
            $status = $client->request('POST', $this->_host . 'api/payment-fwi',
                [
                    'headers' => $this->_header,
                    'form_params' => $dataApi,
                ]);

            $status = (string)$status->getBody();

            if ($status == 'success') {
                $data = array(
                    array(
                        'user_id' => $user_id,
                        'payment_type' => $payment_type,
                        'order_total' => $total,
                        'shipping_fee' => $shipping_fee,
                        'order_date' => $order_date,
                        'email' => $authUser->email,
                        'telephone' => $authUser->cell_phone,
                        'full_name' => $authUser->first_name . ' ' . $authUser->last_name,
                    ),
                );

                Mail::to('sumonahmed123@gmail.com')->send(new OrderMail($data));
                //Mail::to('iazharul351@gmail.com')->send(new OrderMail($data));
                Mail::to('bizdev@freeworldimports.com')->send(new OrderMailTwo($data));

                $eUrl = 'https://epaymaker.com/fwi-payment/' . $token;
                return redirect($eUrl);
            }else {
                return 'something went wrong please try again';
            }


        }
        if ($request->payment_type == 'vpos' && $total > 0) {
            $full_name = $authUser->first_name . ' ' . $authUser->last_name;
            $telephone = $authUser->cell_phone;
            $email = $authUser->email;
            $comment = $request->comment;
            $shipping_amount = $request->shipping_amount;
            $data = array(
                array(
                    'user_id' => $user_id,
                    'order_total' => $total,
                    'shipping_amount' => $shipping_amount,
                    'full_name' => $full_name,
                    'telephone' => $telephone,
                    'email' => $email,
                    'comments' => $comment,
                ),
            );

            DB::table('vpos')->insert($data);
            $vpos_id = DB::table('vpos')->select('id')->orderBy('id', "DESC")->first()->id;

            $order_date = date("Y-m-d");
            $payment_type = 'vpos';
            $shipping_fee = $request->shipping_amount;
            $todayDate = Carbon::now();
            $data = array(
                array(
                    'user_id' => $user_id,
                    'payment_type' => $payment_type,
                    'order_total' => $total,
                    'shipping_fee' => $shipping_fee,
                    'order_date' => $order_date,
                ),
            );

            DB::table('orders')->insert($data);
            $order_id = DB::table('orders')->select('id')->orderBy('id', "DESC")->first()->id;

            foreach ($userCart as $cart) {
                $bid_info = DB::table('all_bids')->where('product_id', $cart->product_id)->orderBy('id', "DESC")->first();
                if (isset($bid_info->quantity)) {
                    $order_details = array(
                        array(
                            'order_id' => $order_id,
                            'vpos_id' => $vpos_id,
                            'user_id' => $user_id,
                            'product_id' => $bid_info->product_id,
                            'bid_price' => $bid_info->bid_price,
                            'quantity' => $bid_info->quantity,
                        ),
                    );
                    DB::table('order_details')->insert($order_details);
                    //$bid_info = DB::table('all_bids')->where('product_id',$cart->product_id)->orderBy('id',"DESC")->delete();
                }
            }
            $data = array(
                array(
                    'user_id' => $user_id,
                    'order_total' => $total,
                    'shipping_amount' => $shipping_amount,
                    'full_name' => $full_name,
                    'telephone' => $authUser->cell_phone,
                    'email' => $email,
                    'comments' => $comment,
                ),
            );
            Mail::to('sumonahmed123@gmail.com')->send(new OrderMail($data));
            Mail::to('bizdev@freeworldimports.com')->send(new OrderMailTwo($data));

            DB::table('carts')->where(['session_id' => $session_id])->delete();
            Session::flash('message', 'Thank You! A Virtual Point of Sale Operator (VPOS) will contact you to complete your order. ');
            return redirect('place-order-vpos');

        } else {

            //Bank Transfer
            $order_date = date("Y-m-d");
            $payment_type = $request->payment_type;
            $shipping_fee = $request->shipping_amount;
            $todayDate = Carbon::now();
            $InsertData = array(
                array(
                    'user_id' => $user_id,
                    'payment_type' => $payment_type,
                    'order_total' => $total,
                    'shipping_fee' => $shipping_fee,
                    'order_date' => $order_date,
                ),
            );

            DB::table('orders')->insert($InsertData);
            $order_id = DB::table('orders')->select('id')->orderBy('id', "DESC")->first()->id;

            $url = 'https://geniecashbox.com/pol/?cashbox=8002598076&amount=' . $total .
                '&orderid=100' . $order_id .
                '&cellphone=' . $authUser->cell_phone .
                '&email=' . $authUser->email .
                '&firstname=' . $authUser->first_name .
                '&lastname=' . $authUser->last_name .
                '&company=' .
                '&country=' . $authUser->country .
                '&address1=' . $authUser->address1 .
                '&address2=' . $authUser->address2 .
                '&city=' . $authUser->city .
                '&state=' . $authUser->states .
                '&zip=' . $authUser->zip_code .
                '&description=FreeWorldmports transsaction || ' . $todayDate .
                '&expiremin=10' .
                '&ReturnURL=https://geniecashbox.com/pol/result.php';

            foreach ($userCart as $cart) {
                $bid_info = DB::table('all_bids')->where('product_id', $cart->product_id)->orderBy('id', "DESC")->first();
                if (isset($bid_info->quantity)) {
                    $order_details = array(
                        array(
                            'order_id' => $order_id,
                            'vpos_id' => $vpos_id,
                            'user_id' => $user_id,
                            'product_id' => $bid_info->product_id,
                            'bid_price' => $bid_info->bid_price,
                            'quantity' => $bid_info->quantity,
                        ),
                    );
                    DB::table('order_details')->insert($order_details);
                    //$bid_info = DB::table('all_bids')->where('product_id',$cart->product_id)->orderBy('id',"DESC")->delete();
                }
            }

            $data = array(
                array(
                    'user_id' => $user_id,
                    'payment_type' => $payment_type,
                    'order_total' => $total,
                    'shipping_fee' => $shipping_fee,
                    // 'order_date' => $order_date,
                    'email' => $authUser->email,
                    'telephone' => $authUser->cell_phone,
                    'full_name' => $authUser->first_name . ' ' . $authUser->last_name,
                    // 'order_date' => $order_date,
                ),
            );

            Mail::to('sumonahmed123@gmail.com')->send(new OrderMail($data));
            // Mail::to('iazharul351@gmail.com')->send(new OrderMail($data));
            Mail::to('bizdev@freeworldimports.com')->send(new OrderMailTwo($data));
            // Mail::to('shifatnaznin11@gmail.com')->send(new OrderMailTwo($data));

            Session::flash('message', 'Thank You! Please complete payment process.');

            return redirect('place-order')->with('url', $url);
        }

        if ($order_id != 0 || $vpos_id != 0) {
            foreach ($userCart as $cart) {
                $bid_info = DB::table('all_bids')->where('product_id', $cart->product_id)->orderBy('id', "DESC")->first();
                if (isset($bid_info->quantity)) {
                    $order_details = array(
                        array(
                            'order_id' => $order_id,
                            'vpos_id' => $vpos_id,
                            'user_id' => $user_id,
                            'product_id' => $bid_info->product_id,
                            'bid_price' => $bid_info->bid_price,
                            'quantity' => $bid_info->quantity,
                        ),
                    );
                    DB::table('order_details')->insert($order_details);
                }
            }
        }

        DB::table('carts')->where('session_id', '=', $session_id)->delete();

        $url = 'https://geniecashbox.com/pol/?cashbox=8002598076&amount=' .
            $total . '&orderid=100' .
            $order_id . '&cellphone=' .
            $authUser->cell_phone . '&email=' .
            $authUser->email . '&firstname=' .
            $authUser->first_name . '&lastname=' .
            $authUser->last_name . '&company=&country=&address1=&address2=&city=&state=&zip=&description=&expiremin=10&ReturnURL=https://geniecashbox.com/pol/result.php ';

        //$link = "<script>window.open('$url', 'width=710,height=555,left=160,top=170')</script>";

        //file_get_contents($url, false);
        //echo $link;
        //dd('sucess');

        Mail::to('sumonahmed123@gmail.com')->send(new OrderMail($data));
        // Mail::to('iazharul351@gmail.com')->send(new OrderMail($data));
        Mail::to('bizdev@freeworldimports.com')->send(new OrderMailTwo($data));

        Session::flash('message', 'Thank You, Your order has been placed');
        return redirect('place-order')->with('url', $url);
    }

    public function orderDetails($id)
    {

        $billingInfo = DB::table('payments')
            ->where('payments.id', $id)
            ->join('products', 'payments.p_id', '=', 'products.id')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->select('payments.*', 'users.*', 'products.product_id', 'products.model')
            ->first();

        //dd($billingInfo);
        return view('admin.pages.order.view-details', compact('billingInfo'));

    }
}
