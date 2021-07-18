<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderProduct;
use App\ProductCategory;
use App\HotSaleProduct;
use App\Unit;
use App\Subcategory;
use App\BlogComment;
use App\Product;
use App\User;
use Session;
use Auth;
use DB;
use Carbon\Carbon;

class HotSaleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $sliders = HotSaleProduct::get();
         return view('admin.pages.hotSaleProduct.index', compact('sliders'));
     }

       public function addHotSale(Request $request)
     {
         $product=Product::get();
         return view('admin.pages.hotSaleProduct.add_hot_sale', compact('product'));
     }
     public function addToHotSale(Request $request)
     {
         $slider = new HotSaleProduct;
         $slider->pro_id =$request->pro_id;
         $slider->save();

         return redirect()->route('addHotSale');
     }

     public function editHotSale(Request $request)
     {
         if (isset($request->pro_id) && isset($request->status)) {
             DB::table('hot_sale_products')->where('id', $request->slider_id)->where('pro_id', $request->pro_id)->update([
                 'hot_sale_status' => $request->status,
             ]);
         }

         $request->session()->flash('success', 'Successfully Updated !');
         return back();

     }

     public function hot_sale_Delete(Request $request, $id)
     {
        $slider = HotSaleProduct::find($id);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
     }
     
}