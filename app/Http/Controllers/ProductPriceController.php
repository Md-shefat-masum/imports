<?php

namespace App\Http\Controllers;

// use Auth;
use App\Product;
use App\User;
use App\WishList;
use App\HomeProductCategory;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPriceController extends Controller
{
   public function product_price_range(Request $request)
    {
        $ammount_start = (int) $request->ammount_start;
        $ammount_end = (int) $request->ammount_end;
        if ($ammount_start) {
            $product = Product::where('price', '>=', $ammount_start)
                ->where('price', '<=', $ammount_end)
                ->orderBy('price', 'asc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } elseif ($ammount_end) {
            $product = Product::where('price', '>=', $ammount_start)
                ->where('price', '<=', $ammount_end)
                ->orderBy('price', 'asc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } else {
            $product = Product::paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        }

    }
    public function product_low_high(Request $request)
    {
        $value_tyepe = $request->value_type;

        if ($value_tyepe == 'high_to_low') {
            $product = Product::where('status', '1')
                ->orderBy('price', 'desc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } elseif ($value_tyepe == 'low_to_high') {
            $product = Product::where('status', '1')
                ->orderBy('price', 'asc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } elseif ($value_tyepe == 'a_to_z') {
            $product = Product::where('status', '1')
                ->orderBy('p_name', 'asc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } elseif ($value_tyepe == 'z_to_a') {
            $product = Product::where('status', '1')
                ->orderBy('p_name', 'desc')
                ->paginate(40);
            return view('front_end.pages.product_price_range')->with(compact('product'));
        } elseif (value == 0) {
            return false;
        }
    }

    public function product_subcat(Request $request)
    {
        $sub_cat_id = $request->sub_cat_id;
        $product = Product::where('sub_cat_id', $sub_cat_id)
            ->where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(40);
        return view('front_end.pages.product_price_range')->with(compact('product'));
    }
    public function product_home_subcat(Request $request)
    {
        $home_sub_cat_id = $request->home_sub_cat_id;
    
        $group = Product::where('sub_cat_id', $home_sub_cat_id)
            ->where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(40);
           
        return view('front_end.pages.product_home_subcat')->with(compact('group'));
    }
    public function product_brand(Request $request)
    {
        $sub_brand_id = $request->sub_brand_id;
        // return $sub_brand_id;
        $product = Product::where('brand', $sub_brand_id)
            ->where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(40);
        // return $product;
        return view('front_end.pages.product_price_range')->with(compact('product'));
    }

    public function wishlist_page()
    {
        // $value=WishList::orderBy('id','ASC')->get();
        // return view('front_end.pages.wishlist',compact('value'));
        return view('front_end.pages.wishlist');
    }

    public function wishlist_delete(Request $request)
    {
        if (Auth::user()) {
            $wishlist_id = $request->wishlist_id;
            $value = DB::table('wish_lists')
                ->where('status', 1)
                ->where('id', $wishlist_id);

            if ($value->delete()) {
                $list_itme = WishList::where('user_id', Auth::user()->id)->get();
                $countval = count($list_itme);
                $view = view('front_end.pages.wishlist_remove')
                    ->withValue($value)
                    ->withCountval($countval)
                    ->render();
                return response()->json([
                    'view' => $view,
                    'countval' => $countval,
                ]);
                //  return view('front_end.pages.wishlist_remove')->with(compact('value','countval'));
            }
        }
    }

    // public function wishlist_delete(Request $request)
    // {
    //   $wishlist_id = $request->wishlist_id;
    //   $value= DB::table('wish_lists')->where('status',1)->where('id', $wishlist_id)->delete();

    //     return view('front_end.pages.wishlist_remove')->with(compact('value'));
    //   //  return $value;

    // }

    public function home_product_subcat(Request $request)
    {
        $get_cat_product = $request->get_cat_product;
        $products = Product::where('sub_cat_id', $get_cat_product)
            ->where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(40);
        // return $products;
        return view('front_end.pages.home_product_catshow')->with(compact('products'));
    }

    // use AuthenticatesUsers;
    public function addWishList(Request $request)
    {
        if (Auth::user()) {
            $slider = new WishList();
            $slider->product_id = $request->product_id;
            $slider->user_id = Auth::user()->id;
            $slider->save();

            $list_itme = WishList::where('user_id', Auth::user()->id)->get();
            return count($list_itme);
            // if($slider){return response()->json("success");}
        } else {
            return 'not_login';
        }
    }
    public function addWishList_flash(Request $request)
    {
        if (Auth::user()) {
            $slider = new WishList();
            $slider->flash_id = $request->flash_id;
            $slider->user_id = Auth::user()->id;
            $slider->save();

            $list_itme = WishList::where('user_id', Auth::user()->id)->get();
            return count($list_itme);
            // if($slider){return response()->json("success");}
        } else {
            return 'not_login';
        }
    }

}
