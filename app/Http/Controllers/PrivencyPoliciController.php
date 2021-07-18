<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use Session;
class PrivencyPoliciController extends Controller
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
        $policy=Policy::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.policy.index')->withPolicy($policy);
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
       
        $policy=new Policy;
        $policy->title=$request->title;
        
        $policy->link=$request->link;
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
        
        $policy->description = $detail;
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/policy'), $path);
            $policy->image = $path;
        }
        $policy->status=$request->status;
        $policy->save();
        Session::flash('success','policy Added Successfully');
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
        $policy=Policy::find($id);
        return view('admin.pages.policy.edit')->withPolicy($policy);
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
        $policy=Policy::find($id);
         $policy->title=$request->title;
        $policy->description=$request->description;
        $policy->link=$request->link;
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/policy'), $path);
            $policy->image = $path;
        }
        $policy->status=$request->status;
        $policy->save();
        Session::flash('success','policy Updated Successfully');
        return redirect('/pages/policy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policy=Policy::find($id);
        $policy->delete();
        Session::flash('success','policy Deleted Successfully');
        return redirect('/pages/policy');
    }
}