<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductCategory;
use App\Subcategory;
use Session;
use App\Product;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    //Blog Category Function Start
    public function index()
    {
        $cat = DB::table("blog_category")->orderBy('cat_name', 'asc')->get();

        return view('admin.pages.b_category.index', compact('cat'));
    }

    public function category_store(Request $request)
    {
        $this->validate($request,[
            'cat_name' => 'required',

        ]);

        DB::table('blog_category')->insert([
          'cat_name' => $request->cat_name,
          'status' => $request->status,
         ]);

         Session::flash('success','Category Added Successfully');
         return back();
    }

    public function b_category_destroy($id)
    {
        $cat= DB::table('blog_category')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }

    public function b_category_edit($id)
    {
         $cat= DB::table('blog_category')->find($id);
         return view('admin.pages.b_category.edit', compact('cat'));
    }


    public function b_category_update(Request $request, $id)
    {
        $this->validate($request,[
            'cat_name' => 'required',

        ]);
        $cat= DB::table('blog_category')->where('id', $id)->get();

        DB::table('blog_category')->where('id', $id)->update([
          'cat_name' => $request->cat_name,
          'status' => $request->status,
         ]);

        Session::flash('success','Category Updated Successfully');
        return redirect()->route('b_cat_index');
    }

    //Blog Category Function End

    //Blog Sub Category Function Start
    public function b_sub_index()
    {
        $cat = DB::table("blog_sub_cat")->orderBy('sub_cat_name', 'asc')->get();
        return view('admin.pages.b_sub_category.index', compact('cat'));
    }

    public function b_sub_category_store(Request $request)
    {

        $this->validate($request,[
            'cat_id' => 'required',
            'sub_cat_name' => 'required',
            'status' => 'required',

        ]);

        DB::table('blog_sub_cat')->insert([
          'cat_id' => $request->cat_id,
          'sub_cat_name' => $request->sub_cat_name,
          'status' => $request->status,
         ]);

         Session::flash('success','Category Added Successfully');
         return back();
    }

    public function b_sub_category_destroy($id)
    {
        $cat= DB::table('blog_sub_cat')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }

    public function b_sub_category_edit($id)
    {
         $cat= DB::table('blog_sub_cat')->find($id);
         return view('admin.pages.b_sub_category.edit', compact('cat'));
    }


    public function b_sub_category_update(Request $request, $id)
    {
        $this->validate($request,[
            'cat_id' => 'required',
            'sub_cat_name' => 'required',
            'status' => 'required',
        ]);

        $cat= DB::table('blog_sub_cat')->where('id', $id)->get();

        DB::table('blog_sub_cat')->where('id', $id)->update([
          'cat_id' => $request->cat_id,
          'sub_cat_name' => $request->sub_cat_name,
          'status' => $request->status,
         ]);

        Session::flash('success','Category Updated Successfully');
        return redirect()->route('b_sub_cat_index');
    }

    //Blog Sub Category Function End
}