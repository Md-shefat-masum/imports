<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Menu;
use App\ProductCategory;
use App\User;
use App\Supplier;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use App\Mail\SendMail;
use App\Mail\ReSendMail;
use App\Mail\EntrepreneurMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class UserController extends Controller
{
    use AuthenticatesUsers;
    public function login(Request $request){
        //return $request->path();
        $menu=Menu::all();
        $productCategory = ProductCategory::all();
        $session_id=Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        for ($i=0; $i < count($userCart); $i++) {

        }
        if($request->isMethod('post')){
            $data=$request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);
                return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
            }
            else{
                return redirect('/user-login')->with('error','Invalid User Or Password');
            }
        }
        return view('user.userLogin')->withMenu($menu)->withProductCategory($productCategory)->withI($i);
    }
    public  function login_home (){
        return redirect('/');
    }
    public function suppliersLogin(Request $request){
        //return $request->path();
        //dd($request->all());
        $menu=Menu::all();
        $productCategory = ProductCategory::all();
        $session_id=Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        for ($i=0; $i < count($userCart); $i++) {

        }

        if($request->isMethod('post')){
            $data=$request->input();
            $user = DB::table('users')->where('email', $data['email'])->first();
            if (!isset($user)) {
                return redirect()->route('supplierLogin')->with('error','Your are not registered yet');
            }else {
                if ($user->group_id !== 4) {
                    return redirect()->route('supplierLogin')->with('error','Invalid User Or Password Or Not a Supplier Member');
                }elseif ($user->user_action == 'pending') {
                    return redirect()->route('supplierLogin')->with('error','Your Member Request is on Pending');
                }elseif ($user->user_action == 'reject') {
                    return redirect()->route('supplierLogin')->with('error','Your Member Request is Rejected');
                }elseif ($user->user_action == 'active') {
                    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                        Session::put('frontSession',$data['email']);
                        return $this->authenticated($request, $this->guard()->user())
                        ?: redirect()->route('dashboard');
                    }
                    else{
                        return redirect()->route('supplierLogin')->with('error','Invalid User Or Password');
                    }
                }
            }

        }
        return view('user.userLogin')->withMenu($menu)->withProductCategory($productCategory)->withI($i);
    }
    public function enterpreunerLogin(Request $request){
        //return $request->path();
        //dd($request->all());
        $menu=Menu::all();
        $productCategory = ProductCategory::all();
        $session_id=Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        for ($i=0; $i < count($userCart); $i++) {

        }

        if($request->isMethod('post')){
            $data=$request->input();
            $user = DB::table('users')->where('email', $data['email'])->first();
            if (!isset($user)) {
                return redirect()->route('enterprenorLogin')->with('error','Your are not registered yet');
            }else {
                if ($user->group_id !== 5) {
                    return redirect()->route('enterprenorLogin')->with('error','Invalid User Or Password Or Not a Enterpreuner Member');
                }elseif ($user->user_action == 'pending') {
                    return redirect()->route('enterprenorLogin')->with('error','Your Member Request is on Pending');
                }elseif ($user->user_action == 'reject') {
                    return redirect()->route('enterprenorLogin')->with('error','Your Member Request is Rejected');
                }elseif ($user->user_action == 'active') {
                    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                        Session::put('frontSession',$data['email']);
                        return $this->authenticated($request, $this->guard()->user())
                        ?: redirect()->route('dashboard');
                    }
                    else{
                        return redirect()->route('enterprenorLogin')->with('error','Invalid User Or Password');
                    }
                }
            }
        }
        return view('user.userLogin')->withMenu($menu)->withProductCategory($productCategory)->withI($i);
    }
    public function register(Request $request){

        $token = isset($_GET['token']) ? $_GET['token'] : null;
        $databaseToken = $data = DB::table('verification')->where('token', $token)->first();

        if (isset($databaseToken)) {
            Session::put('email', $databaseToken->email);
            Session::put('phone', $databaseToken->phone);

            $menu=Menu::all();
            $productCategory = ProductCategory::all();
            $session_id=Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
            for ($i=0; $i < count($userCart); $i++) {

            }
            return view('user.login_register')->withMenu($menu)->withProductCategory($productCategory)->withI($i);
        }else {
            Session::put('user_type', 'user');
            return redirect()->route('user_email_check');
        }

    }

    public function register_user(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();

            $userCount=User::where('email',Session::get('email'))->count();

            if($userCount>0){
                return redirect()->back()->with('error','Email Already Exists');
            }else{

                $countryName = DB::table('countries')->where('id', $data['country'])->select('name')->first();

                $user=new User();
                $user->email= Session::get('email');
                $user->cell_phone=Session::get('phone');
                $user->home_phone=$data['home_phone'];
                $user->password=Hash::make($data['password']);
                $user->first_name=$data['first_name'];
                $user->last_name=$data['last_name'];
                $user->dop=$data['dop'];
                $user->address=$data['address'];
                $user->apts=$data['apts'];
                $user->city=$data['city'];
                $user->country= $countryName->name;
                $user->states=$data['states'];
                $user->zip_code=$data['zip_code'];
                $user->user_action = 'active';
                $user->email_verified_at= Carbon::now();
                Session::put('frontSession',Session::get('email'));
                $user->save();
                Session::flush('success','Thanks For Registration.Now lats go to enjoy !!');

                $user=User::where('email',Session::get('email'))->first();


                Session::put('frontSession',Session::get('email'));
                return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
            }
        }else{
            return view('user.login_register')->withMenu($menu)->withProductCategory($productCategory)->withI($i);
        }
    }

    public function statesName(Request $request)
    {
        if ($request->id){
            $id = $request->id;
            $states = DB::table('states')->where('country_id', $id)->select('name')->get();

            if (count($states)>0)
           {
               foreach ($states as $state)
               {
                   echo '<option value="'. $state->name  .'"> '. $state->name .'</option>';
               }
           }elseif (count($states) == null) {
               echo '<option value=""> - - '. 'No State' .' - - </option>';
           }
        }

    }

    public function entrepreneurs(){

        $token = isset($_GET['token']) ? $_GET['token'] : null;
        $databaseToken = $data = DB::table('verification')->where('token', $token)->first();

        if (isset($databaseToken)) {

            Session::put('email', $databaseToken->email);
            Session::put('phone', $databaseToken->phone);

            $menu=Menu::all();
            $productCategory = ProductCategory::all();
            $session_id=Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
            for ($i=0; $i < count($userCart); $i++) {

            }

            return view('user.supplier_register')->withMenu($menu)->withProductCategory($productCategory)->withI($i);

        }else {
            Session::put('user_type', 'entrepreneurs');
            return redirect()->route('user_email_check');
        }


    }

    public function userResendEmail($id){
        $user = User::findOrFail($id);

       $token_key = Str::random(150);
       $url = 'user-verification?verification='.$user->email . '&' .'_token='. $token_key;
       //$url = 'suppliers-login?verification=' . $email . '&' . '_token=' . $token_key . '&userType=supplier';

       DB::table('users')->where('id', $id)->update([
           'verify_token' => $token_key,
       ]);

       $time = Carbon::now();
       $data = array(
           'email'   => $user->email,
           'url' => $url,
           'time' => $time,
       );

       Mail::to($data['email'])->send(new ReSendMail($data));

       Session::flash('success', 'Email Send Successfully');
       return redirect()->back();
    }


    public function entrepreneursPost(Request $request){

        $this->validate($request, [
            'password' => 'string|min:6|confirmed',
        ]);

        $countryName = DB::table('countries')->where('id', $request->country)->select('name')->first();

        $data = $request->all();
        $token_key = Str::random(150);
        $email =  Session::get('email');

        $emailMatch = User::where('email', $email)->first();

        if (isset($emailMatch)) {
            return redirect()->back()->with('email-exists', 'Your email address already exists');
        }else {

            $user=new User();
            $user->first_name=$request->first_name;
            $user->email=$email;
            $user->reference= '';
            $user->country=$countryName->name;
            $user->cell_phone= Session::get('phone');
            $user->states=$request->states;
            $user->address=$request->address;
            $user->password= Hash::make($request->password);
            $user->user_type= 'entrepreneur';
            $user->group_id= '5';
            $user->verify_token= $token_key;
            $user->email_verified_at= Carbon::now();
            $user->save();


            return redirect()->route('enterprenorLogin')->with('success','Thanks For Registration !!');
        }

    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }

    public function editProfile(){
        $menu=Menu::all();
        $productCategory=ProductCategory::all();
        $user_id = \Auth::user()->id;
        $session_id=Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        for ($i=0; $i < count($userCart); $i++) {

        }
        $details = User::find($user_id);
        return view('front_end.pages.edit-profile')->withMenu($menu)->withProductCategory($productCategory)->withI($i)->withDetails($details);
    }

    public function updateProfile(Request $request){
        $user_id = \Auth::user()->id;
        $user = User::find($user_id);
        $user->home_phone=$request['home_phone'];
        $user->dop=$request['dop'];
        $user->first_name=$request['first_name'];
        $user->last_name=$request['last_name'];
        $user->address=$request['address'];
        $user->apts=$request['apts'];
        $user->city=$request['city'];
        $user->states=$request['states'];
        $user->zip_code=$request['zip_code'];
        $user->save();
        return redirect('my-profile')->with('success', "“Profile Successfully Updated!”");
    }
}
