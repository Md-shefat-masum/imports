<?php

namespace App\Http\Controllers;

use App\Blog;
use App\PopupBlogProduct;
use DB;
use Illuminate\Http\Request;
use Session;

class BlogPopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popup = PopupBlogProduct::orderBy('id','Desc')->get();
        return view('admin.pages.blog-popup.index', compact('popup'));
    }

    // public function addhotsale(Request $request)
    // {
    //     $product = Product::get();
    //     return view('admin.pages.blog-popup.add_hotsale', compact('product'));
    // }
    // public function addhotsale(Request $request)
    // {
    //     $product = Blog::get();
    //     return view('admin.pages.blog-popup.add_popup', compact('product'));
    // }
    public function addblogpopup(Request $request)
    {
        $product = Blog::where('category', 34)->where('sub_category', 59)->where('status', 1)->orderBy('add_to_latest', 'DESC')->get();
        return view('admin.pages.blog-popup.add_popup', compact('product'));
    }
    public function addToblogpopup(Request $request)
    {
        $blogpopup = new PopupBlogProduct;
        $blogpopup->blog_id = $request->blog_id;
        // $blogpopup->blog_position = $request->status;
        $blogpopup->save();

        return redirect()->route('blogpopupProduct');
    }

    public function editblogpopup(Request $request)
    {
        if (isset($request->blog_id) && isset($request->status)) {
            DB::table('popup_blog_products')->where('blog_id', $request->blog_id)->update([
                'blog_position' => $request->status,
            ]);
        }

        $request->session()->flash('success', 'Successfully Updated !');
        return back();

    }
    public function blogpopupDelete(Request $request, $id)
    {
        $blogpopup = PopupBlogProduct::find($id);
        $blogpopup->delete();

        $request->session()->flash('danger', 'Successfully deleted!');
        return back();
    }

}
