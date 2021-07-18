<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductCategory;
use App\Subcategory;
use Session;
use App\Product;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategory=Subcategory::all();
        $cat=ProductCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.p_category.index')->withCat($cat)->withSubCategory($subCategory);
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
        $this->validate($request,[
            'cat_name' => 'required',
            
        ]);

        $cat=new ProductCategory;
        $cat->cat_name=$request->cat_name;
        $cat->sub_cat=$request->sub_cat;
        $cat->cat_description=$request->cat_description  ;
        $cat->status=$request->status;
        $cat->save();
        Session::flash('success','Category Added Successfully');
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
         $subCategory=Subcategory::all();
         $cat=ProductCategory::find($id);
        return view('admin.pages.p_category.edit')->withCat($cat)->withSubCategory($subCategory);
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
        $cat=ProductCategory::find($id);
        $cat->cat_name=$request->cat_name;
        $cat->sub_cat=$request->sub_cat;
        $cat->cat_description=$request->cat_description  ;
        $cat->status=$request->status;
        $cat->save();
        Session::flash('success','Category Updated Successfully');
       return redirect('/pages/p_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=ProductCategory::find($id);
        $cat->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }
}