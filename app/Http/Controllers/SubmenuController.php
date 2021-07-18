<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Submenu;
use Session;
class SubmenuController extends Controller
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
        return view('admin.pages.submenu.index')->withSubmenu($submenu)->withMenu($menu);
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
            'menu_id' => 'required', 
            'submenu' => 'required', 
        ]);
        $submenu=new Submenu;
        $submenu->submenu=$request->submenu;
        $submenu->menu_id=$request->menu_id;
        $submenu->link=$request->link;
        $submenu->status=$request->status;
        $submenu->save();
        Session::flash('success','Submenu Added Successfully');
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
        $submenu=Submenu::find($id);
        $menu=Menu::all();
        return view('admin.pages.submenu.edit')->withSubmenu($submenu)->withMenu($menu);
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
        $submenu=Submenu::find($id);
        $submenu->submenu=$request->submenu;
        $submenu->menu_id=$request->menu_id;
        $submenu->link=$request->link;
        $submenu->status=$request->status;
        $submenu->save();
        Session::flash('success','Submenu Updated Successfully');
        return redirect('/pages/submenus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submenu=Submenu::find($id);
        $submenu->delete();
        Session::flash('success','Submenu Deleted Successfully');
        return redirect('/pages/submenus');
    }
}