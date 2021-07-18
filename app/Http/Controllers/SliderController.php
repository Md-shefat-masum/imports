<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Menu;
use Session;
class SliderController extends Controller
{
    public function index()
    {
        $menu=Menu::all();
        $slider=Slider::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.slider.index')->withSlider($slider)->withMenu($menu);
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
        ]);
        $slider=new Slider;
        $slider->title=$request->title;
        $slider->subtitle=$request->subtitle;
        $slider->description=$request->description;
        $slider->link=$request->link;
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/slider'), $path);
            $slider->image = $path;
        }
        $slider->status=$request->status;
        $slider->save();
        Session::flash('success','slider Added Successfully');
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
        $slider=Slider::find($id);
        $menu=Menu::all();
        return view('admin.pages.slider.edit')->withSlider($slider)->withMenu($menu);
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
        $slider=Slider::find($id);
        
        $slider->title=$request->title;
        $slider->subtitle=$request->subtitle;
        $slider->description=$request->description;
        $slider->link=$request->link;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/slider'), $path);
            $slider->image = $path;
        }
        $slider->status=$request->status;
        $slider->save();
        Session::flash('success','slider Updated Successfully');
        return redirect('/pages/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=Slider::find($id);
        $slider->delete();
        Session::flash('success','slider Deleted Successfully');
        return redirect('/pages/sliders');
    }
}