<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcomarceFunctioalityController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }
    public function brand(){
    	return view('admin.pages.brand.index');
    }
    // public function p_category(){
    // 	return view('admin.pages.p_category.index');
    // }
    // public function product(){
    // 	return view('');
    // }
}
