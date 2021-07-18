<?php

namespace App\Http\Controllers;

use App\HotsaleOfferProduct;
use App\Product;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class HotsaleOfferProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotsales = HotsaleOfferProduct::get();
        return view('admin.pages.hotsale-offer-product.index', compact('hotsales'));
    }

    public function addhotsale(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.hotsale-offer-product.add_hotsale', compact('product'));
    }
 
    public function addTohotsale(Request $request)
    {
        $hotsale = new HotsaleOfferProduct;
        $hotsale->pro_id = $request->pro_id;
        $hotsale->hotsale_position = $request->status;
        $hotsale->save();

        return redirect()->route('hotsaleProduct');
    }
 

    public function edithotsale(Request $request)
    {
        if (isset($request->pro_id) && isset($request->status)) {
            DB::table('hotsale_offer_products')->where('pro_id', $request->pro_id)->update([
                'hotsale_position' => $request->status,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }
    public function hotsaleDelete(Request $request, $id)
    {
        $hotsale = HotsaleOfferProduct::find($id);
        $hotsale->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }

    public function add_hotsale_rate(Request $request)
    {
        if (isset($request->pro_id) && isset($request->hotsale_rate)) {
            DB::table('hotsale_offer_products')->where('id', $request->hotsale_id)->where('pro_id', $request->pro_id)->update([
                'hotsale_rate' => $request->hotsale_rate,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }

}
