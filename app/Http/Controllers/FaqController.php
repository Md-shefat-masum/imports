<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Session;
class FaqController extends Controller
{
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
        $faq=Faq::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.faqs.index')->withFaq($faq);
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

        $faq=new Faq;
        $faq->title=$request->title;
        $faq->description=$request->description;
        $faq->status=$request->status;
        $faq->save();
        Session::flash('success','faq Added Successfully');
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
        $faq=Faq::find($id);
        return view('admin.pages.faqs.edit')->withFaq($faq);
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

        $faq=Faq::find($id);
        $faq->title=$request->title;
        $faq->description=$request->description;
        $faq->status=$request->status;
        $faq->save();
        Session::flash('success','faq Updated Successfully');
        return redirect('/pages/faqs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq=Faq::find($id);
        $faq->delete();
        Session::flash('success','faq Deleted Successfully');
        return redirect('/pages/faqs');
    }
}