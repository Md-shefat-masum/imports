<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function submenus(){
    	return view('admin.pages.submenus.index');
    }
    public function megamenus(){
    	return view('admin.pages.megamenus.index');
    }
    public function about(){
    	return view('admin.pages.about.index');
    }
    public function slider(){
    	return view('admin.pages.slider.index');
    }
}
