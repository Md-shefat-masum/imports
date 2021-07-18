<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Submenu;
use Session;
use App\Megamenu;
class ManageMenusController extends Controller
{   
    
    public function index(){
        $menu=Megamenu::orderBy('created_at', 'DESC')->paginate(4);
    	return view('admin.pages.megamenus.index')->withMenu($menu);
    }
    public function menus(){
    	$menu=Menu::orderBy('created_at', 'DESC')->paginate(4);
    	return view('admin.pages.menus.index')->withMenu($menu);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'menu' => 'required', 
        ]);
        $menu=new Megamenu;
        $menu->menu=$request->menu;
        $menu->slug=$request->slug;
        $menu->status=$request->status;
        $menu->save();
        Session::flash('success','Menu Added Successfully');
        return back();
    }
    
    public function edit($id)
    {
        $menu=Megamenu::find($id);
        return view('admin.pages.megamenus.edit')->withMenu($menu);
    }
    
    public function update(Request $request, $id)
    {
        $menu=Megamenu::find($id);
        $menu->menu=$request->menu;
        $menu->slug=$request->slug;
        $menu->status=$request->status;
        $menu->save();
        Session::flash('success','Menu Updated Successfully');
        return redirect('/pages/megamenus');
    }
    
    
    public function post_menus(Request $request){
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
        // if($request->ajax()){
        //     // $menu = Menu::creaet($request->all());
        //     // response($menu);
        //     return response($request->all());
        // }

    }
    public function update_menus(Request $request, $id){
        $menu=Menu::find($id);
        $menu->menu=$request->input('menu');
        $menu->menu_link=$request->input('menu_link');
        
        $menu->save();
        return redirect()->route('menu.index');
    }
    public function destroy($id)
    {
        //
        $menu=Menu::find($id);
        
      
        
        $menu->delete();
        return redirect()->route('menu.index');
    }
    
}
