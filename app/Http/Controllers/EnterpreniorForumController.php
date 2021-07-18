<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\EnterpreniorFourms;
class EnterpreniorForumController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $oe=EnterpreniorFourms::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.pages.oe.index')->withoe($oe);
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

        $oe=new EnterpreniorFourms;
        $oe->title=$request->title;
        $oe->details=$request->details;
        $oe->category=$request->category;
        $oe->auther_id=$request->auther_id;
        $oe->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/oe'), $path);
            $oe->image = $path;
        }
        $oe->save();
        Session::flash('success','oe/News Added Successfully');
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
        $oe=EnterpreniorFourms::find($id);
        return view('admin.pages.oe.edit')->withoe($oe); 
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
        $oe=EnterpreniorFourms::find($id);
        $oe->title=$request->title;
        $oe->details=$request->details;
        $oe->category=$request->category;
        $oe->auther_id=$request->auther_id;
        $oe->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/oe'), $path);
            $oe->image = $path;
        }
        $oe->save();
        Session::flash('success','oe/News Updated Successfully');
       return redirect('/pages/oe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oe=EnterpreniorFourms::find($id);
        $oe->delete();
        Session::flash('success','oe/News Deleted Successfully');
        return back();
    }
}
