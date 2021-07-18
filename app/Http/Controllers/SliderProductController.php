<?php

namespace App\Http\Controllers;

use App\BlogComment;
use App\Product;
use App\ProductCategory;
use App\SliderProduct;
use App\Subcategory;
use App\Unit;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class SliderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = SliderProduct::get();
        return view('admin.pages.sliderProduct.index', compact('sliders'));
    }

    public function homeProduct()
    {
        $sliders = DB::table('front_page_product')->get();
        return view('admin.pages.homeProduct.index', compact('sliders'));
    }
    public function auctionProduct()
    {

        $sliders = DB::table('current_auction_product')->get();
        return view('admin.pages.auctionProduct.index', compact('sliders'));
    }
    public function addAuction(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.auctionProduct.add_auction_product', compact('product'));
    }
    public function addSlider(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.sliderProduct.add_slider', compact('product'));
    }
    public function addHome(Request $request)
    {
        $product = Product::get();
        return view('admin.pages.homeProduct.add_home_product', compact('product'));
    }
    public function addToSlider(Request $request)
    {
        $slider = new SliderProduct;
        $slider->pro_id = $request->pro_id;
        $slider->slider_position = $request->status;
        $slider->save();

        return redirect()->route('sliderProduct');
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
    public function editSlider(Request $request)
    {
        if (isset($request->pro_id) && isset($request->status)) {
            DB::table('slider_products')->where('id', $request->slider_id)->where('pro_id', $request->pro_id)->update([
                'slider_position' => $request->status,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }
    public function sliderDelete(Request $request, $id)
    {
        $slider = SliderProduct::find($id);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }
    public function homeDelete(Request $request, $id)
    {

        $slider = DB::table('front_page_product')->where('id', $id);
        //dd($slider);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }
    public function auctionDelete(Request $request, $id)
    {
        $slider = DB::table('current_auction_product')->where('id', $id);
        //dd($slider);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }
    public function proSearchForSlider(Request $request)
    {
        $key = $request->search;

        $proCat = ProductCategory::where('cat_name', $key)->first();
        if (isset($proCat)) {
            $product = Product::where('cat_id', $proCat->id)->get();
        } else {

            $product = Product::where('p_name', $key)
                ->orWhere('p_name', 'like', '%' . $key . '%')
                ->orWhere('brand', 'like', '%' . $key . '%')
                ->orWhere('model', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('p_quientity', 'like', '%' . $key . '%')
                ->get();
            if (count($product) < 1) {

                $proCat = ProductCategory::where('cat_name', $key)
                    ->orWhere('cat_name', 'like', '%' . $key . '%')
                    ->first();
                if (isset($proCat)) {
                    $product = Product::where('cat_id', $proCat->id)->get();
                }

            }
        }

        return view('admin.pages.sliderProduct.add_slider', compact('product'));
    }
    public function proSearchForHome(Request $request)
    {
        $key = $request->search;

        $proCat = ProductCategory::where('cat_name', $key)->first();
        if (isset($proCat)) {
            $product = Product::where('cat_id', $proCat->id)->get();
        } else {

            $product = Product::where('p_name', $key)
                ->orWhere('p_name', 'like', '%' . $key . '%')
                ->orWhere('brand', 'like', '%' . $key . '%')
                ->orWhere('model', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('p_quientity', 'like', '%' . $key . '%')
                ->get();
            if (count($product) < 1) {

                $proCat = ProductCategory::where('cat_name', $key)
                    ->orWhere('cat_name', 'like', '%' . $key . '%')
                    ->first();
                if (isset($proCat)) {
                    $product = Product::where('cat_id', $proCat->id)->get();
                }

            }
        }

        return view('admin.pages.homeProduct.add_home_product', compact('product'));
    }
    public function proSearchForAuctin(Request $request)
    {
        $key = $request->search;

        $proCat = ProductCategory::where('cat_name', $key)->first();
        if (isset($proCat)) {
            $product = Product::where('cat_id', $proCat->id)->get();
        } else {

            $product = Product::where('p_name', $key)
                ->orWhere('p_name', 'like', '%' . $key . '%')
                ->orWhere('brand', 'like', '%' . $key . '%')
                ->orWhere('model', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('p_quientity', 'like', '%' . $key . '%')
                ->get();
            if (count($product) < 1) {

                $proCat = ProductCategory::where('cat_name', $key)
                    ->orWhere('cat_name', 'like', '%' . $key . '%')
                    ->first();
                if (isset($proCat)) {
                    $product = Product::where('cat_id', $proCat->id)->get();
                }

            }
        }

        return view('admin.pages.auctionProduct.search-auction', compact('product'));
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
        $sliderProduct = new SliderProduct;
        $sliderProduct->cat_id = $request->cat_id;
        $sliderProduct->sub_cat = $request->sub_cat;
        $sliderProduct->p_name = $request->p_name;
        $sliderProduct->unit = $request->unit;
        $sliderProduct->p_description = $request->p_description;
        $sliderProduct->link = $request->link;
        $sliderProduct->p_quientity = $request->p_quientity;
        $sliderProduct->price = $request->price;
        $sliderProduct->status = $request->status;

        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/images/sliderProduct', $name);
                $data[] = $name;
            }
        } else {
            $data = '{}';
        }
        $sliderProduct->image = json_encode($data);
        $sliderProduct->save();
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
        $category = ProductCategory::all();
        $subCategory = Subcategory::all();

        $unit = Unit::all();
        $sliderProduct = SliderProduct::find($id);
        return view('admin.pages.sliderProduct.edit')->withSliderProduct($sliderProduct)->withCategory($category)->withUnit($unit)->withSubCategory($subCategory);
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
        $sliderProduct = SliderProduct::find($id);
        $sliderProduct->cat_id = $request->cat_id;
        $sliderProduct->sub_cat = $request->sub_cat;
        $sliderProduct->p_name = $request->p_name;
        $sliderProduct->unit = $request->unit;
        $sliderProduct->p_description = $request->p_description;
        $sliderProduct->link = $request->link;
        $sliderProduct->p_quientity = $request->p_quientity;
        $sliderProduct->price = $request->price;
        $sliderProduct->status = $request->status;
        $sliderProduct->slider_position = $request->slider_position;
        if ($request->hasfile('image')) {

            foreach ($request->file('image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/images/sliderProduct', $name);
                $data[] = $name;
            }
        } else {
            $data = '{}';
        }
        if ($data != '{}') {
            $sliderProduct->image = json_encode($data);
        }

        $sliderProduct->save();
        return redirect('/pages/slider_product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliderProduct = SliderProduct::find($id);
        $sliderProduct->delete();
        Session::flash('success', 'Slider Product Deleted Successfully');
        return back();
    }

    //Product Approved Section

    public function supplierApprove()
    {
        $user_id = Auth::user()->id;

        $product = Product::where('user_id', $user_id)->where('status', '1')->get();

        return view('admin.pages.product.approve_supplier_product', compact('product'));
    }

    public function supplier_pro_request()
    {

        $product = Product::where('status', '0')->get();

        return view('admin.pages.product.request_supplier_product', compact('product'));
    }

    public function single_supplier_pro(Request $request)
    {

        $suplier_id = $request->memId;

        $userSupplier = DB::table('users')->where('id', $suplier_id)->first();

        $product = Product::where('status', '0')->where('user_id', $suplier_id)->get();

    }

    public function supplier_pro_approve()
    {
        $product = Product::where('status', '1')->get();
        return view('admin.pages.product.supplier_approve_product', compact('product'));
    }

    public function supplierApproveUpdate(Request $request, $id)
    {
        $product = Product::find($id);

        $product->status = '1';

        $product->save();

        return redirect()->route('supplierApprove');
    }

    public function enterprenorApprove()
    {
        $product = Product::get();
        return view('admin.pages.product.approve_enterprener_product', compact('product'));
    }

    public function enterprenorApproveUpdate(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = '1';
        $product->save();

        return redirect()->route('enterprenorApprove');
    }
    public function commentSection()
    {
        return view('admin.pages.blog.comment.comment_section');
    }
    public function commentSectionEdit($id)
    {
        $comment = DB::table('blog_comments')->where('id', $id)->first();

        return view('admin.pages.blog.comment.comment_edit', compact('comment'));
    }
    public function commentSectionUpdate(Request $request, $id)
    {
        DB::table('blog_comments')->where('id', $id)->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $request->session()->flash('success', 'Successfully Updated !');
        return redirect()->route('commentSection');
    }
    public function commentSectionDelete(Request $request, $id)
    {
        $slider = BlogComment::findOrFail($id);
        $slider->delete();

        $request->session()->flash('success', 'Successfully Delete !');
        return redirect()->route('commentSection');
    }
    public function commentSectionApproved(Request $request, $id)
    {
        DB::table('blog_comments')->where('id', $id)->update([
            'status' => '1',
        ]);

        $request->session()->flash('success', 'Successfully Approved !');
        return redirect()->route('commentSection');
    }
}
