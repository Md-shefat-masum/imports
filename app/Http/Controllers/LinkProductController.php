<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkProduct;
use App\ProductCategory;
use App\Unit;
use App\Subcategory;
use App\BlogComment;
use App\Product;
use Session;
use DB;
use Carbon\Carbon;

class LinkProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

         $sliders = LinkProduct::get();
         return view('admin.pages.linkProduct.index', compact('sliders'));
     }

     public function addLink(Request $request)
     {
         $product=Product::get();
         return view('admin.pages.linkProduct.add_link', compact('product'));
     }

     public function addHome(Request $request)
     {
         $product=Product::paginate(10);
         return view('admin.pages.homeProduct.add_home_product', compact('product'));
     }
     public function addToLink(Request $request)
     {
         $random_string = md5(microtime());
         $link = 'https://www.freeworldimports.com/porduct_details/' . $request->pro_id . '?ref='. $random_string;

         $slider = new LinkProduct;
         $slider->pro_id =$request->pro_id;
         $slider->pro_link = $link;
         $slider->save();

         return redirect()->route('linkProduct');
     }
     public function addToHome(Request $request)
     {

         DB::table('front_page_product')->insert([
                 'product_id' => $request->pro_id,
                 'created_at' => Carbon::now(),
             ]);

         return redirect()->route('homeProduct');
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
     public function linkDelete(Request $request, $id)
     {
        $slider = LinkProduct::find($id);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
     }
     public function homeDelete(Request $request, $id)
     {

        $slider =  DB::table('front_page_product')->where('id', $id);
        //dd($slider);
        $slider->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
     }
     public function proSearchForLink(Request $request)
     {
         $key = $request->search;

         $proCat = ProductCategory::where('cat_name',  $key)->first();
         if (isset($proCat)) {
             $product = Product::where('cat_id', $proCat->id)->paginate(50);
         }else {

             $product = Product::where('p_name', $key)
                                 ->orWhere('p_name', 'like', '%' . $key . '%')
                                 ->orWhere('brand', 'like', '%' . $key . '%')
                                 ->orWhere('model', 'like', '%' . $key . '%')
                                 ->orWhere('price', 'like', '%' . $key . '%')
                                 ->orWhere('p_quientity', 'like', '%' . $key . '%')
                                 ->paginate(50);
             if (count($product) < 1) {

                 $proCat = ProductCategory::where('cat_name',  $key)
                                         ->orWhere('cat_name', 'like', '%' . $key . '%')
                                         ->first();
                 if (isset($proCat)) {
                     $product = Product::where('cat_id', $proCat->id)->paginate(50);
                 }

             }
         }

         return view('admin.pages.linkProduct.add_link', compact('product'));
     }
     public function searchProduct(Request $request)
     {
         $key = $request->search;

         $proCat = ProductCategory::where('cat_name',  $key)->first();
         if (isset($proCat)) {
             $product = Product::where('cat_id', $proCat->id)->paginate(500);
         }else {

             $product = Product::where('p_name', $key)
                                 ->orWhere('p_name', 'like', '%' . $key . '%')
                                 ->orWhere('brand', 'like', '%' . $key . '%')
                                 ->orWhere('model', 'like', '%' . $key . '%')
                                 ->orWhere('price', 'like', '%' . $key . '%')
                                 ->orWhere('p_quientity', 'like', '%' . $key . '%')
                                 ->paginate(500);
             if (count($product) < 1) {

                 $proCat = ProductCategory::where('cat_name',  $key)
                                         ->orWhere('cat_name', 'like', '%' . $key . '%')
                                         ->first();
                 if (isset($proCat)) {
                     $product = Product::where('cat_id', $proCat->id)->paginate(500);
                 }

             }
         }
         $category=ProductCategory::all();
         $unit=Unit::all();
         $subCategory=Subcategory::all();
         return view('admin.pages.product.index')->withCategory($category)->withProduct($product)->withUnit($unit)->withSubCategory($subCategory);
     }
     public function proSearchForHome(Request $request)
     {
         $key = $request->search;

         $proCat = ProductCategory::where('cat_name',  $key)->first();
         if (isset($proCat)) {
             $product = Product::where('cat_id', $proCat->id)->paginate(10);
         }else {

             $product = Product::where('p_name', $key)
                                 ->orWhere('p_name', 'like', '%' . $key . '%')
                                 ->orWhere('brand', 'like', '%' . $key . '%')
                                 ->orWhere('model', 'like', '%' . $key . '%')
                                 ->orWhere('price', 'like', '%' . $key . '%')
                                 ->orWhere('p_quientity', 'like', '%' . $key . '%')
                                 ->paginate(10);
             if (count($product) < 1) {

                 $proCat = ProductCategory::where('cat_name',  $key)
                                         ->orWhere('cat_name', 'like', '%' . $key . '%')
                                         ->first();
                 if (isset($proCat)) {
                     $product = Product::where('cat_id', $proCat->id)->paginate(10);
                 }

             }
         }

         return view('admin.pages.homeProduct.add_home_product', compact('product'));
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
        $sliderProduct=new SliderProduct;
        $sliderProduct->cat_id=$request->cat_id;
        $sliderProduct->sub_cat=$request->sub_cat;
        $sliderProduct->p_name=$request->p_name;
        $sliderProduct->unit=$request->unit;
        $sliderProduct->p_description=$request->p_description;
        $sliderProduct->link=$request->link;
        $sliderProduct->p_quientity=$request->p_quientity;
        $sliderProduct->price=$request->price;
        $sliderProduct->status=$request->status;


         if($request->hasfile('image'))
         {

            foreach($request->file('image') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/images/sliderProduct', $name);
                $data[] = $name;
            }
         }
         else{
             $data='{}';
         }
         $sliderProduct->image=json_encode($data);
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
         $category=ProductCategory::all();
        $subCategory=Subcategory::all();

        $unit=Unit::all();
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
        $sliderProduct=SliderProduct::find($id);
        $sliderProduct->cat_id=$request->cat_id;
        $sliderProduct->sub_cat=$request->sub_cat;
        $sliderProduct->p_name=$request->p_name;
        $sliderProduct->unit=$request->unit;
        $sliderProduct->p_description=$request->p_description;
        $sliderProduct->link=$request->link;
        $sliderProduct->p_quientity=$request->p_quientity;
        $sliderProduct->price=$request->price;
        $sliderProduct->status=$request->status;
        $sliderProduct->slider_position=$request->slider_position;
         if($request->hasfile('image'))
         {

            foreach($request->file('image') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/images/sliderProduct', $name);
                $data[] = $name;
            }
         }
         else{
             $data='{}';
         }
         if($data!='{}'){
             $sliderProduct->image=json_encode($data);
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
        $sliderProduct=SliderProduct::find($id);
        $sliderProduct->delete();
        Session::flash('success','Slider Product Deleted Successfully');
        return back();
    }



    //Product Approved Section

    public function supplierApprove()
    {
        $product = Product::paginate(10);
        return view('admin.pages.product.approve_supplier_product', compact('product'));
    }
    public function supplierApproveUpdate(Request $request, $id)
    {
        $product=Product::find($id);

        $product->status= '1';

        $product->save();

        return redirect()->route('supplierApprove');
    }

    public function enterprenorApprove()
    {
        $product = Product::paginate(10);
        return view('admin.pages.product.approve_enterprener_product', compact('product'));
    }

    public function  enterprenorApproveUpdate(Request $request, $id)
    {
        $product=Product::find($id);
        $product->status= '1';
        $product->save();

        return redirect()->route('enterprenorApprove');
    }
    public function  commentSection()
    {
        return view('admin.pages.blog.comment.comment_section');
    }
    public function  commentSectionEdit($id)
    {
        $comment = DB::table('blog_comments')->where('id', $id)->first();

        return view('admin.pages.blog.comment.comment_edit', compact('comment'));
    }
    public function  commentSectionUpdate(Request $request, $id)
    {
        DB::table('blog_comments')->where('id', $id)->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $request->session()->flash('success', 'Successfully Updated !');
        return redirect()->route('commentSection');
    }
    public function  commentSectionDelete(Request $request, $id)
    {
        $slider = BlogComment::findOrFail($id);
        $slider->delete();

        $request->session()->flash('success', 'Successfully Delete !');
        return redirect()->route('commentSection');
    }
    public function  commentSectionApproved(Request $request, $id)
    {
        DB::table('blog_comments')->where('id', $id)->update([
            'status' => '1',
        ]);

        $request->session()->flash('success', 'Successfully Approved !');
        return redirect()->route('commentSection');
    }
}