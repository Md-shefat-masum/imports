<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.setting.index');
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $setting=new Setting;
        $setting->c_name=$request->c_name;
        if($request->hasFile('c_logo')) {
            $image = $request->file('c_logo');
            $path=$request->c_logo->getClientOriginalName();
           
            $image->move(public_path('/images/setting'), $path);
            $setting->c_logo = $path;
        }
        $setting->c_address=$request->c_address;
        $setting->c_phone=$request->c_phone;
        $setting->c_email=$request->c_email;
        $setting->c_fb_link=$request->c_fb_link;
        $setting->c_ins_link=$request->c_ins_link;
        $setting->c_tw_link=$request->c_tw_link;
        $setting->c_gPlus_link=$request->c_gPlus_link;
        $setting->c_skype_link=$request->c_skype_link;
        $setting->c_flicker_link=$request->c_flicker_link;
        $setting->c_location=$request->c_location;
        $setting->c_vedio=$request->c_vedio;
        
        $setting->save();
        Session::flash('success','Setting Added Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
