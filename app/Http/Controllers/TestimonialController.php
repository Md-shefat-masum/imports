<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use Session;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tes=Testimonial::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.testimonial.index')->withTes($tes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'name' => 'required',
            'comments' => 'required',
            'image' => 'nullable',
            
        ]);

        $tes=new Testimonial;
        $tes->comments=$request->comments;
        $tes->name=$request->name;
        $tes->designation=$request->designation;
        $tes->link=$request->link;
        $tes->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/testimonial'), $path);
            $tes->image = $path;
        }
        $tes->save();
        Session::flash('success','Testimonial Added Successfully');
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
        $tes=Testimonial::find($id);
        return view('admin.pages.testimonial.edit')->withTes($tes);   
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
        $tes=Testimonial::find($id);
        $tes->comments=$request->comments;
        $tes->name=$request->name;
        $tes->designation=$request->designation;
        $tes->link=$request->link;
        $tes->status=$request->status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('images/testimonial'), $path);
            $tes->image = $path;
        }
        $tes->save();
        Session::flash('success','Testimonial Updated Successfully');
       return redirect('/pages/tes');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tes=Testimonial::find($id);
        $tes->delete();
        Session::flash('success','Testimonial Deleted Successfully');
        return back();
    }
}