<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $group_id = Auth::user()->group_id;
                if($group_id<6)
                    return redirect('/dashboard');
                else
                    return redirect('/user-login');
            }
            else{
                return redirect('/admin-login')->with('error','Invalid User Or Password');
            }
        }
        return view('admin.login');
    }
    public function logout(){
        Session::flush();
        return redirect('/admin-login')->with('success','Logged Out Successfully');
    }
    public function dashboard(){
        $group_id = Auth::user()->group_id;
        $user_id = Auth::user()->id;

        if($group_id ==6) return redirect('/user-login');

        return view('admin.dashboard');
    }
    public function ManageSales(){

        if(isset($_GET['verification']) && isset($_GET['_token']))
        {
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

        if(isset($_GET['action']))
        {
            if ($_GET['action'] == 'process') {
                $id = $request->id;
                $token_key = str_random(150);

                DB::table('orders')->where('id', $id)->update([
                    'status' => 3,
                    'order_verification' => $token_key,
                ]);


                $user = User::findOrFail($id);

                $data = array(
                    'name'      =>  $user->first_name .' '. $user->first_name,
                    'email'     => $user->email,
                    'message'    => 'Your Shipping is on Processing',
                    'token'     => $token_key,
                    'id'      => $user->id,
                );

                Mail::to('sumonahmed123@gmail.com')->send(new ShippingMail($data));

                return redirect('pages/verification-status')->with('message', "Thanks you operation completed!");
            }elseif ($_GET['action'] == 'deliver') {
                $id = $request->id;

                DB::table('orders')->where('id', $id)->update(['status' => 2]);

                return redirect('pages/shipping-delivered')->with('message', "Thanks you operation completed!");
            }
        }

        $orders = DB::table('orders')
        ->join('users', 'orders.user_id','=','users.id')
        ->select('orders.*','users.first_name','users.last_name','users.cell_phone')
        ->orderBy('orders.id', 'DESC')->paginate(10);

        return view('admin.pages.order.viewOrder',compact('orders'));
    }
}