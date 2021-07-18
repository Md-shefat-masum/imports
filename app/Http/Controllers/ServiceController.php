<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Submenu;
use App\Service;
use Session;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu=Menu::all();
        $submenu=Submenu::orderBy('created_at', 'DESC')->get();
        $service=Service::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.service.index')->withSubmenu($submenu)->withMenu($menu)->withService($service);
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
        $this->validate($request,[
            'step_no' => 'required', 
            'step_title' => 'required'
        ]);
        $service=new Service;
        $service->step_no=$request->step_no;
        $service->step_title=$request->step_title;
        $service->step_link=$request->step_link;
        $service->step_description=$request->step_description;
        $service->status=$request->status;
        $service->save();
        Session::flash('success','Services Added Successfully');
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
        $service=Service::find($id);
        $menu=Menu::all();
        $submenu=Submenu::all();
        return view('admin.pages.service.edit')->withSubmenu($submenu)->withMenu($menu)->withService($service);
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
        $service=Service::find($id);
        $service->step_no=$request->step_no;
        $service->step_title=$request->step_title;
        $service->step_link=$request->step_link;
        $service->step_description=$request->step_description;
        $service->status=$request->status;
        $service->save();
        Session::flash('success','Service Updated Successfully');
        return redirect('/pages/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service=Service::find($id);
        $service->delete();
        Session::flash('success','Service Deleted Successfully');
        return redirect('/pages/services');
    }
}