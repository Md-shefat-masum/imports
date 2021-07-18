<?php

namespace App\Http\Controllers;

use App\DiscountProduct;
use App\Product;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class DiscountProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = DiscountProduct::get();
        return view('admin.pages.discountProduct.index', compact('discounts'));
    }

    public function adddiscount(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.discountProduct.add_discount', compact('product'));
    }
    public function addHome(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.homeProduct.add_home_product', compact('product'));
    }
    public function addTodiscount(Request $request)
    {
        $discount = new DiscountProduct;
        $discount->pro_id = $request->pro_id;
        $discount->discount_position = $request->status;
        $discount->save();

        return redirect()->route('discountProduct');
    }
    public function addToHome(Request $request)
    {

        DB::table('front_page_product')->insert([
            'product_id' => $request->pro_id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('homeProduct');
    }
    public function addToAuction(Request $request)
    {

        DB::table('current_auction_product')->insert([
            'product_id' => $request->pro_id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('auctionProduct');
    }
    public function editdiscount(Request $request)
    {
        if (isset($request->pro_id) && isset($request->status)) {
            DB::table('discount_products')->where('pro_id', $request->pro_id)->update([
                'discount_position' => $request->status,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }
    public function discountDelete(Request $request, $id)
    {
        $discount = DiscountProduct::findOrFail($id);
        $discount->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }

    public function add_discount_rate(Request $request)
    {
        if (isset($request->pro_id) && isset($request->discount_rate)) {
            DB::table('discount_products')->where('id', $request->discount_id)->where('pro_id', $request->pro_id)->update([
                'discount_rate' => $request->discount_rate,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }

}
