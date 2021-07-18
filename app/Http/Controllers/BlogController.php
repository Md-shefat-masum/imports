<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BidReset;
use App\RelatedForum;
use Session;
use Carbon\Carbon;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestBlog()
    {

        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;
        if($group_id==1)
        {
            $blog=Blog::where('status', '0')->orWhere('status', '2')->orderBy('created_at', 'DESC')->get();

        } else if($group_id==4 || $group_id==5) {
            $blog=Blog::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();

        } else {
            return redirect('404');
        }

        return view('admin.pages.blog.request_blog')->withBlog($blog);
    }
    public function blogList()
    {
        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;
        if($group_id==1)
        {
            $blog=Blog::orderBy('created_at', 'DESC')->paginate(10);
        } else if($group_id==4 || $group_id==5) {
            $blog=Blog::where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            return redirect('404');
        }


        return view('admin.pages.blog.blog_list')->withBlog($blog);
    }
    public function approveBlog(Request $request, $id)
    {
        $blog=Blog::find($id);

        $blog->status= '1';
        $blog->save();

        Session::flash('success','Blog/News Approve Successfully');
        return redirect()->route('blogList');
    }
    public function removeBlog($id)
    {
        $blog=Blog::find($id);
        $blog->delete();
        Session::flash('success','Blog/News Deleted Successfully');
        return back();
    }
    public function blogDescription($id)
    {
        $blog=Blog::find($id);
        return view('admin.pages.blog.blog_details')->withBlog($blog);
    }

    public function getSubscribe()
    {
        return view('admin.pages.subscribe.index');
    }

    public function subscribe_delete(Request $request)
    {

        $request->validate([
             'mail_id' => 'required',
         ],
         [
             'mail_id.required'  => 'Please select item',
         ]);


         foreach ($request->mail_id as $item) {
             DB::table('subscribes')->where('id', $item)->delete();
             
         }

        \Session::flash('success', 'Successful delete selected items!');
        return back();
    }
    public function bid_reset()
    {
        return view('admin.pages.subscribe.bid_reset');
    }
    public function bid_reset_submit(Request $request)
    {
        // dd();
        BidReset::insert([
            'reset_at' => $request->reset_time,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect()->back()->with('success','bid time reseted');
    }


    public function relatedBlog(){
        $blog=RelatedForum::orderBy('id','desc')->get();
        return view('admin.pages.blog.related_blog',compact('blog'));
    }
    public function relatedBlogAdd(Request $request){


        $add=new RelatedForum;
        $add->blog_id=$request->blog_id;
        $add->related_blog=json_encode($request->related_blog);
        $add->flash_sale=json_encode($request->flash_sale);


        $add->save();

        if($add) {
            return back()->with('success', 'Addred');
        }

        else {
            return back()->with('error', 'value');
        }

    }

    public function delete_releted_blog(Request $request, $id)
    {
        $data = RelatedForum::findOrFail($id);

        $data->delete();
        // $data->save();
        if ($data) {
            return back()->with('success-two', 'value');
        } else {
            return back()->with('error', 'value');
        }
    }
    public function update_releted_blog(Request $request, $id)
    {
        $blog=RelatedForum::find($id);
        return view('admin.pages.blog.edit_rblog',compact('blog'));
    }
    public function edit_releted_blog(Request $request)
    {
        // dd($request->id);
        // $gg=$request->id;
        $add=RelatedForum::find($request->id);
        $add->blog_id=$request->blog_id;
        $add->related_blog=json_encode($request->related_blog);
        $add->flash_sale=json_encode($request->flash_sale);

    // DB::table('related_forums')->where('id','=',$id)->update($values);

    // DB::table('related_forums')
    // ->where('id', $request->get('id'))
    // // ->where('blog_id', $request->get('blog_id'))
    // ->update(array(
    //           'blog_id'=>$request->get('blog_id'),
    //           'related_blog'=>$request->get('related_blog'),
    //           'flash_sale'=>$request->get('flash_sale'),
    //  ));


       $add->save();

        if($add) {
            return redirect()->route('related_blog')->with('success-u', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }
}
