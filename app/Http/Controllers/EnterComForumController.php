<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnterComForum;
use Session;
class EnterComForumController extends Controller
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
        $contact=EnterComForum::get();
        return view('admin.pages.formEnterpreuner.index')->withContact($contact);
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

        $subComForum=new EnterComForum;
        $subComForum->enterpreuner_item=$request->enterpreuner_item;
        $subComForum->save();
        Session::flash('success','Enterpreuner Added Successfully');
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
        $contact=EnterComForum::find($id);
        return view('admin.pages.formEnterpreuner.edit')->withContact($contact);
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
        $subComForum=EnterComForum::find($id);
        $subComForum->enterpreuner_item=$request->enterpreuner_item;
        $subComForum->save();
        Session::flash('success','Enterpreuner Updated Successfully');
        return redirect('/pages/enterprenor-forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=EnterComForum::find($id);
        $contact->delete();
        Session::flash('success','Enterpreuner Deleted Successfully');
        return back();
    }
}