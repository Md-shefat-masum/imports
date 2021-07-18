<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Session;
use Auth;
class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;

        if($group_id==1)
        {
            $blog=Blog::orderBy('created_at', 'DESC')->get();

        } else if($group_id == 4) {

            $blog=Blog::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();

        } elseif ($group_id == 5) {

            $blog=Blog::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();

        } else {

            return redirect('404');
        }

        return view('admin.pages.blog.index')->withBlog($blog);
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
            'title' => 'required',
            'image' => 'nullable',
        ]);
        $group_id = \Auth::user()->group_id;
        $user_id = \Auth::user()->id;

        if ($group_id==1) {
             $type = $request->type;
        }elseif ($group_id==4) {
            $type='supplier';
        }elseif ($group_id==5) {
            $type='entrepreneur';
        }

        $blog=new Blog;
        $blog->user_id = $user_id;
        $blog->type = $type;
        $blog->title=$request->title;
        $blog->details=$request->details;
        $blog->category=$request->category;
        $blog->sub_category=$request->sub_category;
        $blog->auther_id=$request->auther_id;
        $blog->status= '0';
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/blog'), $path);
            $blog->image = $path;
        }
        $blog->save();
        Session::flash('success','Forum Added Successfully');
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

        if($group_id==1)
        {
            $blog=Blog::find($id);
        } else {
            $blog=Blog::where('id',$id)->where('user_id',$user_id)->first();
        }

        return view('admin.pages.blog.edit')->withBlog($blog);
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
        //dd($request->all());
        $user_id = \Auth::user()->id;
        $group_id = \Auth::user()->group_id;

        $blog=Blog::find($id);

        $blog->title=$request->title;
        $blog->details=$request->details;
        $blog->category=$request->category;
        $blog->sub_category=$request->sub_category;
        $blog->auther_id=$request->auther_id;
        $blog->type=$request->type;
        if ($group_id == 1) {
            $blog->status=$request->status;
        }else {
            $blog->status = '2';
        }

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/blog'), $path);
            $blog->image = $path;
        }

        $blog->save();
        Session::flash('success','Blog/News Updated Successfully');
       return redirect('/pages/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::find($id);
        $blog->delete();
        Session::flash('success','Blog/News Deleted Successfully');
        return back();
    }
}