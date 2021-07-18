<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeProductCategory;
use App\ProductCategory;
use App\Unit;
use App\Subcategory;
use App\BlogComment;
use App\Product;
use App\User;
use Session;
use Auth;
use DB;
use Carbon\Carbon;

class HomeProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $homecats = HomeProductCategory::get();
         return view('admin.pages.homecatProduct.index', compact('homecats'));
     }

     public function addHomecat(Request $request)
     {
         $product=ProductCategory::where('status',1)->get();
         return view('admin.pages.homecatProduct.add_home_cat', compact('product'));
     }

     public function addToHomecat(Request $request)
     {
         $slider = new HomeProductCategory;
         $slider->cat_id =$request->cat_id;
         $slider->save();

         return redirect()->route('homecatProduct');
     }
    
     public function editHomecat(Request $request)
     {
         if (isset($request->cat_id) && isset($request->status)) {
             DB::table('home_product_categories')->where('id', $request->slider_id)->where('cat_id', $request->cat_id)->update([
                 'cat_status' => $request->status,
             ]);
         }

         $request->session()->flash('success', 'Successfully Updated !');
         return back();

     }

     public function homecatDelete(Request $request, $id)
     {
        $slider = HomeProductCategory::find($id);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
     }
     
}