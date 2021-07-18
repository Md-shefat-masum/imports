<?php

namespace App\Http\Controllers;

use App\AllBid;
use App\Brand;
use App\Cart;
use App\Delevery_Address;
use App\Menu;
use App\Product;
use App\ProductCategory;
use App\Subcategory;
use App\Unit;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = ProductCategory::all();

        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;
        if ($group_id == 1) {
            $product = Product::orderBy('created_at', 'DESC')->get();
        } else if ($group_id == 4 || $group_id == 5) {
            $product = Product::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        } else {
            return redirect('404');
        }

        $unit = Unit::all();
        $subCategory = Subcategory::all();
        $brand = Brand::all();

        $edit = Product::where('p_name', 'Hixsee Camera')->where('price', '12')->get();
        //dd($edit);
        // foreach ($edit as $item) {
        //
        //     $item->update(['status' => 0]);
        // };
        //dd($edit);

        return view('admin.pages.product.index')->withCategory($category)->withProduct($product)->withUnit($unit)->withSubCategory($subCategory)->withBrand($brand);

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
        $user_id = \Auth::user()->id;

        if ($user_id == 4 || $user_id == 5) {
            $status = '0';
        } else {
            $status = $request->status;
        }
        $product = new Product;
        $product->user_id = $user_id;
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->p_name = $request->p_name;
        $product->unit = $request->unit;
        $product->p_description = $request->p_description;
        $product->link = $request->link;
        $product->p_quientity = $request->p_quientity;
        $product->min_quientity = $request->min_quientity;
        $product->price = $request->price;
        $product->bundle_price = $request->bundle_price;
        $product->model = $request->model;
        $product->brand = $request->brand;
        $product->status = $status;
        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/images/product', $name);
                $data[] = $name;
            }
        } else {
            $data = '{}';
        }
        $product->image = json_encode($data);
        $product->save();
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
        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;

        $category = ProductCategory::all();
        $unit = Unit::all();
        $subCategory = Subcategory::all();

        if ($group_id == 1) {
            $product = Product::find($id);

        } else {
            $product = Product::where('id', $id)->where('user_id', $user_id)->first();
        }

        return view('admin.pages.product.edit')->withProduct($product)->withUnit($unit)->withCategory($category)->withSubCategory($subCategory);
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
        //return $request->all();
        $product = Product::find($id);
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->p_name = $request->p_name;
        $product->unit = $request->unit;
        $product->p_description = $request->p_description;
        $product->link = $request->link;
        $product->p_quientity = $request->p_quientity;
        $product->min_quientity = $request->min_quientity;
        $product->price = $request->price;
        $product->bundle_price = $request->min_quientity * $request->price;
        $product->model = $request->model;
        $product->brand = $request->brand;
        $product->status = $request->status;
        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/images/product', $name);
                $data[] = $name;
                $product->image = json_encode($data);
            }
        } else {
            $data = '{}';
        }

        $product->save();

        return redirect('pages/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (isset($product)) {
            $product->delete();
            Session::flash('success', ' Product Deleted Successfully');
            return back();
        } else {
            Session::flash('success', ' Product Deleted Failed');
            return back();
        }
    }

    public function addCart(Request $request)
    {

        $menu = Menu::all();
        $productCategory = ProductCategory::all();
        $data = $request->all();

        if (empty($data['user_email'])) {
            $data['user_email'] = '';
        }

        if (!isset($data['reference'])) {
            $data['reference'] = null;
        }

        $session_id = Session::get('session_id');

        if (empty($session_id)) {
            $session_id = Str::random(40);
            Session::put('session_id', $session_id);
        }
        $productHave = DB::table('carts')->where('session_id', $session_id)->where('product_id', $data['product_id'])->first();

        if (isset($productHave)) {
            $cart = Cart::find($productHave->id);

            $cart->price = $productHave->price + $data['price'];
            $cart->quantity = $productHave->quantity + $data['quantity'];
            $cart->save();
            // DB::table('carts')->update([
            //     'price'=> $productHave->price + $data['price'],
            //     'quantity'=> $productHave->quantity + $data['quantity'],
            // ]);

            return back();

        } else {
            DB::table('carts')->insert([
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'reference' => $data['reference'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'user_email' => $data['user_email'],
                'session_id' => $session_id,
            ]);

            return back();
        }
    }
    public function cart()
    {

        $menu = Menu::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
        // dd($userCart);

        if (!$userCart->isEmpty()) {

            $i = 0;
            foreach ($userCart as $key => $product) {
                $i++;
                $productdetails = Product::where('id', $product->product_id)->first();
                $userCart[$key]->image = $productdetails->image;
            }

            return view('front_end.pages.shopingcart')->withUserCart($userCart)->withMenu($menu)->withProductCategory($productCategory)->withI($i);
        } else {
            return redirect()->route('frontMain');
        }
    }

    public function delete_cart_product($id = null)
    {
        DB::table('carts')->where('id', $id)->delete();
        return redirect('cart')->with('delete_product_cart', 'Product has been deleted form cart !!');
    }
    public function update_cart_quentity()
    {

    }

    public function checkout(Request $request)
    {

        $menu = Menu::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $bidPrice = Session::get('bidPrice');

        $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
        // dd( $userCart);
        $i = 0;
        foreach ($userCart as $key => $product) {
            $i++;
            $productdetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productdetails->image;
        }
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);

        // shipping check
        $shippingCount = Delevery_Address::where('user_id', $user_id)->count();
        if ($shippingCount > 0) {
            $shipping_details = Delevery_Address::where('user_id', $user_id)->first();
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            User::where('id', $user_id)->update(['first_name' => $data['billing_name'], 'address' => $data['billing_address'], 'city' => $data['billing_city'], 'states' => $data['billing_state'], 'zip_code' => $data['billing_postcode'], 'cell_phone' => $data['billing_mobile']]);
            if ($shippingCount > 0) {
                Delevery_Address::where('user_id', $user_id)->update(['first_name' => $data['shipping_name'], 'address' => $data['shipping_address'], 'city' => $data['shipping_city'], 'states' => $data['shipping_state'], 'zip_code' => $data['shipping_postcode'], 'cell_phone' => $data['shipping_mobile']]);
            } else {
                $shipping = new Delevery_Address;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->first_name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->states = $data['shipping_state'];
                $shipping->zip_code = $data['shipping_postcode'];
                $shipping->cell_phone = $data['shipping_mobile'];
                $shipping->save();

                return redirect()->back()->with('success_submit', 'Your Billing And Shipping Successfully Sent');
            }
        }

        return view('front_end.pages.payment', compact('bidPrice', 'userDetails'))->withMenu($menu)->withProductCategory($productCategory)->withI($i)->withUserDetails($userDetails);
    }

    public function shoppingCartBid(Request $request)
    {

        foreach ($request->product_id as $k => $v) {
            if ($v == 0 || $request->bid_price[$k] == 0 || $request->quantity[$k] == 0) {

                return redirect()->back()->with('error', 'Sorry invalid request');
            }
        }

        $menu = Menu::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();

        $i = 0;
        foreach ($userCart as $key => $product) {
            $i++;
            $productdetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productdetails->image;
        }
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);

        /*
        foreach($request->product_id as $k=>$product_id)
        {
        $bid_price = $request->bid_price[$k];
        $price = DB::table('all_bids')->where('product_id',$product_id)->max('bid_price');
        if($price > $bid_price)
        {
        //echo $price." - ".$bid_price; exit;
        return back()->with('bidMessage','please enter big price');
        }
        }

        foreach($request->product_id as $k=>$product_id)
        {
        $your_bid = $request->your_bid[$k];
        $price = DB::table('all_bids')->where('product_id',$product_id)->max('bid_price');
        if($price > $bid_price)
        {
        //echo $price." - ".$bid_price; exit;
        return back()->with('bidMessage','please enter big price');
        }
        }
         */
// dd($request->all());
        foreach ($request->product_id as $k => $product_id) {
            $ref = DB::table('carts')->where('product_id', $product_id)
                ->where('quantity', $request->quantity[$k])
                ->where('discount', $request->discount[$k])
                ->where('session_id', $session_id)
                ->first();

            $bidPrice = new AllBid;
            $bidPrice->quantity = $request->quantity[$k];
            $bidPrice->bid_price = $request->bid_price[$k];
            $bidPrice->your_bid = $request->your_bid[$k];
            $bidPrice->user_id = $user_id;
            $bidPrice->product_id = $product_id;
            // $bidPrice->discount = $request->discount[$k];
            $bidPrice->discount_rate = $request->discount[$k];
            $bidPrice->discount_price = $request->discount_price[$k];

            if (isset($ref)) {
                $bidPrice->reference = $ref->reference;
            }
            $bidPrice->save();
            // dd($bidPrice);
        }

        return view('front_end.pages.checkout')->withMenu($menu)->withProductCategory($productCategory)->withI($i)->withUserDetails($userDetails);

    }
    public function shoppingCartBidnoti(Request $request)
    {
        // dd($request->all());

        foreach ($request->product_id as $k => $v) {
            if ($v == 0 || $request->bid_price[$k] == 0 || $request->quantity[$k] == 0) {

                return redirect()->back()->with('error', 'Sorry invalid request');
            }
        }

        $menu = Menu::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();

        $i = 0;
        foreach ($userCart as $key => $product) {
            $i++;
            $productdetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productdetails->image;
        }
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);

        foreach ($request->product_id as $k => $product_id) {
            $ref = DB::table('carts')->where('product_id', $product_id)
                ->where('quantity', $request->quantity[$k])
                ->where('discount', $request->discount[$k])
                ->where('session_id', $session_id)
                ->first();

            $bidPrice = new AllBid;
            $bidPrice->quantity = $request->quantity[$k];
            $bidPrice->bid_price = $request->bid_price[$k];
            $bidPrice->your_bid = $request->your_bid[$k];
            $bidPrice->user_id = $user_id;
            $bidPrice->product_id = $product_id;
            $bidPrice->discount_rate = $request->discount[$k];
            $bidPrice->discount_price = $request->discount_price[$k];

            if (isset($ref)) {
                $bidPrice->reference = $ref->reference;
            }
            $bidPrice->save();
            // dd($bidPrice);
        }

        return view('admin.order_notification')->withMenu($menu)->withProductCategory($productCategory)->withI($i)->withUserDetails($userDetails);

    }
}
