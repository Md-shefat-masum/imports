<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Vpos;
use App\Order;
use App\Product;
use App\ProductCategory;
use App\Unit;
use App\Menu;
use App\Subcategory;
use App\Delevery_Address;
use App\User;
use DB;
use App\AllBid;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShippingMail;
use Carbon\Carbon;
use App\Mail\OrderMail;

class OrderLogsController extends Controller
{

    public function update_order_log(Request $request, $id)
    {
        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_zip_code' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zip_code' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'product_id' => 'required',
            'shipping_fee' => 'required',
            'order_total' => 'required',
        ]);

        //dd($request->all());
        $order_logs = DB::table('orders_logs')->where('id', $id)->first();

        if(isset($order_logs)){
            //Create Order Logs START
            DB::table('orders_logs')->where('id', $order_logs->id)->update([
                'shipping_fee' =>  $request->shipping_fee,
                'order_total' =>  $request->order_total,
            ]);
            //Create Order Logs END


            //Create Order logs details START
            $items = count($request->product_id);
            for ($x = 0; $x < $items; $x++) {
               $test = DB::table('order_log_details')
                    ->where('order_log_id', $order_logs->id)
                    ->where('product_id', $request->product_id[$x])
                    ->update([
                        'bid_price' => $request->unit_price[$x],
                        'quantity' => $request->quantity[$x],
                    ]);
            }
            //Create Order logs details END

            // Create order_log_billing_address Start
            DB::table('order_log_billing_address')
                ->where('order_log_id', $order_logs->id)
                ->update([
                'name' =>  $request->billing_name,
                'email' =>  $request->billing_email,
                'address' =>  $request->billing_address,
                'city' =>  $request->billing_city,
                'state' =>  $request->billing_state,
                'zip_code' =>  $request->billing_zip_code,
                'phone_number' =>  $request->billing_phone_number,
            ]);
            // Create order_log_billing_address End

            // Create  order_log_shipping_address START
            DB::table('order_log_shipping_address')
                ->where('order_log_id', $order_logs->id)
                ->update([
                    'name' =>  $request->shipping_name,
                    'email' =>  $request->shipping_email,
                    'address' =>  $request->shipping_address,
                    'city' =>  $request->shipping_city,
                    'state' =>  $request->shipping_state,
                    'zip_code' =>  $request->shipping_zip_code,
                    'phone_number' =>  $request->shipping_phone_number,
                ]);
            // Create  order_log_shipping_address END


            $request->session()->flash('alert-success', 'Successfully updated order log');
            return redirect()->back();
        }else{
            $request->session()->flash('alert-danger', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function delete_order_log($id){

        DB::table('orders_logs')->where('id', $id)->delete();

        Session::flash('alert-success','Delete Successfully..');
        return redirect()->back()->with('message', "Thanks you operation completed!");
    }

    public function create_order_log(Request $request, $id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (isset($order)) {

            $find_order_log = DB::table('orders_logs')->where('order_id', $order->id)->first();

            if (isset($find_order_log)){
                $request->session()->flash('alert-danger', 'Already Created');
                return redirect()->back();
            }else{
                //Create Order Logs START
                $last_order_id = DB::table('orders_logs')->insertGetId([
                    'order_id' =>  $order->id,
                    'user_id' =>  $order->user_id,
                    'payment_type' =>  $order->payment_type,
                    'reference' =>  $order->reference,
                    'shipping_fee' =>  $order->shipping_fee,
                    'order_total' =>  $order->order_total,
                    'order_date' =>  $order->order_date,
                    'status' =>  $order->status,
                    'order_verification' =>  $order->order_verification,
                    'created_at' =>  $order->created_at,
                    'updated_at' =>  $order->updated_at,
                ]);
                //Create Order Logs END


                //Create Order logs details START
                $order_details = DB::table('order_details')->where('order_id', $order->id)->get();
                foreach ($order_details as $order_detail) {
                    DB::table('order_log_details')->insert([
                        'order_id' => $order_detail->order_id,
                        'order_log_id' => $last_order_id,
                        'vpos_id' => $order_detail->vpos_id,
                        'user_id' => $order_detail->user_id,
                        'product_id' => $order_detail->product_id,
                        'bid_price' => $order_detail->bid_price,
                        'quantity' => $order_detail->quantity,
                        'created_at' => $order_detail->created_at,
                        'updated_at' => $order_detail->updated_at,
                    ]);
                }
                //Create Order logs details END

                // Create order_log_billing_address Start
                $user = DB::table('users')->where('id', $order->user_id)->first();

                DB::table('order_log_billing_address')->insert([
                    'order_log_id' =>  $last_order_id,
                    'user_id' =>  $user->id,
                    'name' =>  $user->first_name. ' '. $user->last_name,
                    'email' =>  $user->email,
                    'address' =>  $user->address,
                    'city' =>  $user->city,
                    'state' =>  $user->states,
                    'zip_code' =>  $user->zip_code,
                    'phone_number' =>  $user->cell_phone,
                    'created_at' =>  $order->created_at,
                    'updated_at' =>  $order->updated_at,
                ]);
                // Create order_log_billing_address End

                // Create  order_log_shipping_address START
                $shipping_address = DB::table('delevery__addresses')->where('user_id', $user->id)->first();
                DB::table('order_log_shipping_address')->insert([
                    'order_log_id' =>  $last_order_id,
                    'user_id' =>  $user->id,
                    'name' =>  $user->first_name. ' '. $user->last_name,
                    'email' =>  $shipping_address->user_email,
                    'address' =>  $shipping_address->address,
                    'city' =>  $shipping_address->city,
                    'state' =>  $shipping_address->states,
                    'zip_code' =>  $shipping_address->zip_code,
                    'phone_number' =>  $shipping_address->cell_phone,
                    'created_at' =>  $shipping_address->created_at,
                    'updated_at' =>  $shipping_address->updated_at,
                ]);
                // Create  order_log_shipping_address END


                $request->session()->flash('alert-success', 'Successfully created order log');
                return redirect()->back();
            }

        }

    }

    public function edit_order_log(Request $request, $id)
    {
        $order_logs = DB::table('orders_logs')->where('id', $id)->first();

        return view('admin.pages.order_logs.edit_order_log', compact('order_logs'));
    }

    public function view_order_log(Request $request)
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


        $orders = DB::table('orders_logs')
            ->join('users', 'orders_logs.user_id', '=', 'users.id')
            ->select('orders_logs.*', 'users.first_name', 'users.last_name', 'users.cell_phone')
            ->orderBy('orders_logs.id', 'DESC')->paginate(20);


        $vpos_order = DB::table('vpos')->orderBy('id', 'desc')->get();

        return view('admin.pages.order_logs.view_order_log', compact('orders', 'vpos_order'));
    }
}
