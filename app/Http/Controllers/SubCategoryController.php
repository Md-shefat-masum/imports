<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
use Session;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategory=Subcategory::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.subCategory.index')->withSubCategory($subCategory);
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
            'name' => 'required',
            
        ]);

        $subCategory=new Subcategory;
        $subCategory->name=$request->name;
        $subCategory->description=$request->description  ;
        $subCategory->link=$request->link;
        $subCategory->status=$request->status;
        $subCategory->save();
        Session::flash('success','Sub Category Added Successfully');
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
        $subCategory=Subcategory::find($id);
        return view('admin.pages.subCategory.edit')->withSubCategory($subCategory);
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
        $subCategory=Subcategory::find($id);
        $subCategory->name=$request->name;
        $subCategory->description=$request->description  ;
        $subCategory->link=$request->link;
        $subCategory->status=$request->status;
        $subCategory->save();
        Session::flash('success','Sub Category Added Successfully');
    
       return redirect('/pages/subCategory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory=Subcategory::find($id);
        $subCategory->delete();
        Session::flash('success','Sub Category Deleted Successfully');
        return back();
    }
}