<?php

namespace App\Http\Controllers\admin;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB,Session,Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        //dd($request->all());
        $group_id = \Auth::user()->group_id;
        //$user_list = User::where('group_id','=', '1')->get();
        //$where = "'group_id','=', '1'";
        //$where = "id>0";
        //$user_list = User::where('id','>',0)->get();

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
        return view('admin.user.index',compact('user_list'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $group_id = \Auth::user()->group_id;
        if($group_id==2)
        {
            $where = "id>1";
        }
        else if($group_id==3)
        {
            $where = "id>3";
        } else {
            $where = "status=1";
        }
        $user_type = DB::table('user_group')->whereRaw($where)->get();

        return view('admin.user.create',compact('user_type'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        //dd($request);
        $group_id = \Auth::user()->group_id;

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = new User();
        $data->group_id = $request->group_id;
        $data->first_name = $request->first_name;
        $data->email = $request->email;
        $data->cell_phone = $request->cell_phone;
        $data->password =  Hash::make($request->password);
        $data->status = 1;
        if($data->save())
        {
            Session::flash('success', 'User create successfully completed!');
            return redirect('user-list');
        }else{
            Session::flash('error', 'Sorry form submission fail!');
            return redirect()->back();
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user_type = DB::table('user_group')->where('status','=','1')->get();

        $item = User::where(['id' => $id])->first();
        return view('admin.user.edit',compact('item','user_type'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $is_email= DB::table('users')
        ->select('*')
        ->whereRaw('`email`='."'".$request->email."'".' AND `id`!='.$id)
        ->get();

        if(count($is_email)>0)
        {
            Session::flash('error', 'Email "'.$request->email.'" already exist!');
            return redirect()->back();
        }

        $data = User::find($id);
        $data->group_id = $request->group_id;
        $data->first_name = $request->first_name;
        $data->email = $request->email;
        $data->cell_phone = $request->cell_phone;

        if(isset($request->password) && strlen($request->password)>5)
        {
            $data->password = bcrypt($request->password);
        }

        if($data->save())
        {
            Session::flash('success', 'user successfully updated!');
            return redirect('user-list');
        }else{
            Session::flash('error', 'Sorry updated fail!');
            return redirect()->back();
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        if(Auth::user()->group_id !=1)
        {
            return redirect('404');
        }
        $item = User::find($id);
        $item->delete();
        return redirect('user-list')->with('success', 'User deleted!');
    }

}
