<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terms;
use Session;
class TermConditionController extends Controller
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
        $terms=Terms::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.terms.index')->withTerms($terms);
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

        $terms=new Terms;
        $terms->title=$request->title;
        $detail=$request->description;

        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getelementsbytagname('img');

        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path=$request->image->getClientOriginalName();
            $image->move(public_path('/images/terms'), $path);
            file_put_contents($image, $data);

            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }

        $detail = $dom->savehtml();

        $terms->description = $detail;

        $terms->link=$request->link;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/terms'), $path);
            $terms->image = $path;
        }
        $terms->status=$request->status;
        $terms->save();
        Session::flash('success','terms Added Successfully');
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
        $terms=Terms::find($id);
        return view('admin.pages.terms.edit')->withTerms($terms);
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
        $terms=Terms::find($id);
        $terms->title=$request->title;
        $terms->description=$request->description;
        $terms->link=$request->link;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();

            $image->move(public_path('/images/terms'), $path);
            $terms->image = $path;
        }
        $terms->status=$request->status;
        $terms->save();
        Session::flash('success','terms Updated Successfully');
        return redirect('/pages/terms');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $terms=Terms::find($id);
        $terms->delete();
        Session::flash('success','terms Deleted Successfully');
        return redirect('/pages/terms');
    }
}