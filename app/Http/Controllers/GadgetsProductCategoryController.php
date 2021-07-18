<?php

namespace App\Http\Controllers;

use App\GadgetsProductCategory;
use App\ProductCategory;
use DB;
use Illuminate\Http\Request;
use Session;

class GadgetsProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homecats = GadgetsProductCategory::get();
        return view('admin.pages.gadgetscatProduct.index', compact('homecats'));
    }

    public function addGadgetscat(Request $request)
    {
        $product = ProductCategory::where('status', 1)->get();
        return view('admin.pages.gadgetscatProduct.add_home_cat', compact('product'));
    }

    public function addToGadgetscat(Request $request)
    {
        $slider = new GadgetsProductCategory;
        $slider->cat_id = $request->cat_id;
        $slider->save();

        return redirect()->route('gadgetscatProduct');
    }

    public function editGadgetscat(Request $request)
    {
        if (isset($request->cat_id) && isset($request->cat_status)) {
            DB::table('gadgets_product_categories')->where('cat_id', $request->cat_id)->update([
                'cat_status' => $request->cat_status,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }

    public function GadgetscatDelete(Request $request, $id)
    {
        $slider = GadgetsProductCategory::find($id);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }

}
