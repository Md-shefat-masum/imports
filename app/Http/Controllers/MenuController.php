<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Session;
class MenuController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu=Menu::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.menus.index')->withMenu($menu);
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
            'menu' => 'required', 
        ]);
        $menu=new Menu;
        $menu->menu=$request->menu;
        $menu->slug=$request->slug;
        $menu->status=$request->status;
        $menu->save();
        Session::flash('success','Menu Added Successfully');
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
        $menu=Menu::find($id);
        return view('admin.pages.menus.edit')->withMenu($menu);
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
        $menu=Menu::find($id);
        $menu->menu=$request->menu;
        $menu->slug=$request->slug;
        $menu->status=$request->status;
        $menu->save();
        Session::flash('success','Menu Updated Successfully');
        return redirect('/pages/menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu=Menu::find($id);
        $menu->delete();
        Session::flash('success','Menu Deleted Successfully');
        return back();
    }
}