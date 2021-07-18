<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubComForum;
use Session;
class SubComForumController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact=SubComForum::get();
        return view('admin.pages.formSuppliers.index')->withContact($contact);
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

        $subComForum=new SubComForum;
        $subComForum->suppliers_item=$request->suppliers_item;
        $subComForum->save();
        Session::flash('success','Supplier Added Successfully');
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
        $contact=SubComForum::find($id);
        return view('admin.pages.formSuppliers.edit')->withContact($contact);
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
        $subComForum=SubComForum::find($id);
        $subComForum->suppliers_item=$request->suppliers_item;
        $subComForum->save();
        Session::flash('success','Supplier Updated Successfully');
        return redirect('/pages/supplier-forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=SubComForum::find($id);
        $contact->delete();
        Session::flash('success','Supplier Deleted Successfully');
        return back();
    }
}