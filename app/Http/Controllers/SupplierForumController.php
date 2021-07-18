<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SupplierForums;
class SupplierForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $sf=SupplierForums::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.pages.sf.index')->withsf($sf);
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
            'heading' => 'required',
            'title' => 'required',
            'image' => 'nullable',

        ]);

        $sf=new SupplierForums;
        $sf->title=$request->title;
        $sf->details=$request->details;
        $sf->category=$request->category;
        $sf->auther_id=$request->auther_id;
        $sf->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/sf'), $path);
            $sf->image = $path;
        }
        $sf->save();
        Session::flash('success','sf/News Added Successfully');
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
        $sf=SupplierForums::find($id);
        return view('admin.pages.sf.edit')->withsf($sf);
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
        $sf=SupplierForums::find($id);
        $sf->title=$request->title;
        $sf->details=$request->details;
        $sf->category=$request->category;
        $sf->auther_id=$request->auther_id;
        $sf->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/sf'), $path);
            $sf->image = $path;
        }
        $sf->save();
        Session::flash('success','sf/News Updated Successfully');
       return redirect('/pages/sf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sf=SupplierForums::find($id);
        $sf->delete();
        Session::flash('success','sf/News Deleted Successfully');
        return back();
    }
}
