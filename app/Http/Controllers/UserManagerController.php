<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Supplier;
use DB,Session,Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class UserManagerController extends Controller
{
    public function index()
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;

        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->get();


        return view('admin.usermanage.index',compact('user_list'));
    }
    public function verified()
    {

        $group_id = \Auth::user()->group_id;

        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')->where('email_verified_at', '!=', null)
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->paginate(20);

        //dd($user_list);
        return view('admin.user.index',compact('user_list'));
    }
    public function unverified()
    {

        $group_id = \Auth::user()->group_id;

        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')->where('email_verified_at', null)
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->paginate(20);

        //dd($user_list);
        return view('admin.user.index',compact('user_list'));
    }

    public function userAction(Request $request, $id)
    {
        $status = $request->user_action;

        $users = User::findOrFail($id);

        $group = DB::table('user_group')->where('id', $users->group_id)->first();

        if ($group->name == 'Supplier' || $group->name == 'Entrepreneur') {

            $user=User::find($id);
            $user->user_action=$request->user_action;
            $user->save();

            Session::flash('success', 'User '. ucfirst($status) .' successfully completed!');
            return back();
        }else {
            Session::flash('error', 'Sorry form submission fail!');
            return back();
        }
    }

    public function supEntAction(Request $request)
    {
        $useraction = $request->status;
        $user_id = $request->user_id;

        if ($useraction == 'pending') {
            $status = '1';
        }elseif ($useraction == 'active') {
            $status = '0';
        }else {
            $status = '4';
        };

        User::where('id', $user_id)->update([
            'user_action'=>$useraction,
            'status'=>$status,
        ]);

        Session::flash('success', 'User '. ucfirst($status) .' successfully completed!');
        return back();
    }

    public function userDelete($id)
    {

        $users = User::findOrFail($id);

        $group = DB::table('user_group')->where('id', $users->group_id)->first();

        if ($group->name == 'Supplier' || $group->name == 'Entrepreneur') {
            $users->delete();

            Session::flash('success', 'User Remove successfully completed!');
            return back();
        }else {
            Session::flash('error', 'Sorry form submission fail!');
            return back();
        }
    }
    public function userSuppliers()
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;


        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->get();

        //dd($user_list);
        $suppliers = User::where('user_type', 'supplier')
        ->where('user_action', 'pending')
        ->where('first_name', '!=', null)
        ->get();


        return view('admin.pages.partner.suppliers',compact('user_list', 'suppliers'));
    }
    public function suppliersList()
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;


        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->get();

        //dd($user_list);
        $suppliers = User::where('user_type', 'supplier')
        ->where('user_action', 'active')
        ->get();

        return view('admin.pages.partner.suppliers_list',compact('user_list', 'suppliers'));
    }
    public function enterprenorList()
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;


        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->get();

        //dd($user_list);
        $suppliers = User::where('user_type', 'entrepreneur')
        ->where('user_action', 'active')
        ->get();

        return view('admin.pages.partner.entrepreneurs_list',compact('user_list', 'suppliers'));
    }
    public function enterprenorSales()
    {
        if(isset($_GET['action']))
        {
            if ($_GET['action'] == 'deliver') {
                $id = $request->id;

                DB::table('orders')->where('id', $id)->update(['status' => 2]);

                return redirect('pages/shipping')->with('message', "Thanks you operation completed!");
            }
        }
        $user_id = Auth::user()->id;

        $orders = DB::table('orders')
        ->join('users', 'orders.user_id','=','users.id')
        ->select('orders.*','users.first_name','users.last_name','users.cell_phone')
        ->where('user_id', $user_id)
        ->orderBy('orders.id', 'DESC')->get();



        return view('admin.pages.partner.entrepreneurs_sales',compact('orders'));
    }
    public function userEntrepreneurs()
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;

        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = User::where('user_type', 'entrepreneur')
        ->where('user_action', 'pending')
        ->get();
        return view('admin.pages.partner.entrepreneurs',compact('user_list'));
    }
    public function adminAddedNewUser(Request $request)
    {
        $this->validate($request, [
            'email'  =>  'required|email',
            'password' => 'string|min:6|confirmed',
        ]);

        if ($request->group_id == 'Admin') {

            $email = $request->email;
            $token_key = str_random(150);
            $url = 'verification='.$email . '&' .'_token='. $token_key . '&userType=entrepreneur';
            $time = Carbon::now();
            $data = array(
                'email'   =>   $email,
                'url' => $url,
                'time' => $time,
                'userType' => 'Admin'
            );

            $emailMatch = User::where('email', $email)->first();
            if (count($emailMatch)>0) {
                return redirect()->back()->with('email-exists', 'Your email address already exists');
            }else {

                $user=new User();
                $user->first_name=$request->first_name;
                $user->email=$email;
                $user->cell_phone=$request->cell_phone;
                $user->password= Hash::make($request->password);
                $user->user_type= 'admin';
                $user->user_action= 'active';
                $user->group_id= '1';
                $user->verify_token= $token_key;
                $user->save();

                Mail::to($data['email'])->send(new SendMail($data));
                return redirect()->route('user-list.index')->with('error','Thanks For Registration. Verify your email !!');
            }
        }elseif ($request->group_id == 'vops') {

            $email = $request->email;
            $token_key = str_random(150);
            $url = 'verification='.$email . '&' .'_token='. $token_key . '&userType=entrepreneur';
            $time = Carbon::now();
            $data = array(
                'email'   =>   $email,
                'url' => $url,
                'time' => $time,
                'userType' => 'VOPS'
            );

            $emailMatch = User::where('email', $email)->first();
            if (count($emailMatch)>0) {
                return redirect()->back()->with('email-exists', 'Your email address already exists');
            }else {

                $user=new User();
                $user->first_name=$request->first_name;
                $user->email=$email;
                $user->cell_phone=$request->cell_phone;
                $user->password= Hash::make($request->password);
                $user->user_type= 'vops';
                $user->user_action= 'active';
                $user->group_id= '2';
                $user->verify_token= $token_key;
                $user->save();

                Mail::to($data['email'])->send(new SendMail($data));
                return redirect()->route('user-list.index')->with('error','Thanks For Registration. Verify your email !!');
            }

        }elseif ($request->group_id == 'Shipping') {

            $email = $request->email;
            $token_key = str_random(150);
            $url = 'verification='.$email . '&' .'_token='. $token_key . '&userType=entrepreneur';
            $time = Carbon::now();
            $data = array(
                'email'   =>   $email,
                'url' => $url,
                'time' => $time,
                'userType' => 'Shipping Manager'
            );

            $emailMatch = User::where('email', $email)->first();
            if (count($emailMatch)>0) {
                return redirect()->back()->with('email-exists', 'Your email address already exists');
            }else {

                $user=new User();
                $user->first_name=$request->first_name;
                $user->email=$email;
                $user->cell_phone=$request->cell_phone;
                $user->password= Hash::make($request->password);
                $user->user_type= 'shipping';
                $user->user_action= 'active';
                $user->group_id= '2';
                $user->verify_token= $token_key;
                $user->save();

                Mail::to($data['email'])->send(new SendMail($data));
                return redirect()->route('user-list.index')->with('error','Thanks For Registration. Verify your email !!');
            }

        }else {
            return 'You make system damage';
        }
    }
    public function passwordReset(Request $request)
    {
        $group_id = \Auth::user()->group_id;

        if($group_id==2)
        {
            $where = "group_id>2 ";
        }
        else if($group_id==3)
        {
            $team_id = \Auth::user()->team_id;
            $where = "group_id=4 AND team_id =".$team_id;
        }
        else if($group_id==4)
        {
            $team_id = \Auth::user()->team_id;
            $where = "users.id =".\Auth::user()->id;
        } else {
            $where = "users.id>0";
        }

        $user_list = DB::table('users')
        ->join('user_group', 'user_group.id', '=', 'users.group_id')
        ->select('users.*','user_group.name as type')
        ->whereRaw($where)
        ->orderBy('users.group_id','asc')
        ->get();

        return view('admin.usermanage.password_reset', compact('user_list'));
    }
    public function passwordResetEdit($id)
    {
        $user_type = DB::table('users')->where('status','=','1')->get();

        $item = User::where(['id' => $id])->first();
        return view('admin.usermanage.password_reset_edit',compact('item','user_type'));
        //return 'Comming soon';
    }
    public function passwordResetUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);


        $data = User::find($id);

        if(isset($request->password) && strlen($request->password)>5)
        {
            $data->password =  Hash::make($request->password);
        }

        if($data->save())
        {
            Session::flash('success', 'user successfully updated!');
            return redirect()->route('passwordReset');
        }else{
            Session::flash('error', 'Sorry updated fail!');
            return redirect()->route('passwordReset');
        }
    }
}