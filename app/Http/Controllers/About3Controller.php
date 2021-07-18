<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutThree;
use App\AboutTwo;
use App\AboutOne;
use Session;
class About3Controller extends Controller
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
        $aboutTwo=AboutTwo::all();
        $aboutOne=AboutOne::all();
        $aboutThree=AboutThree::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.pages.aboutone.index')->withAboutThree($aboutThree)->withAboutTwo($aboutTwo)->withAboutOne($aboutOne);
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
        // $this->validate($request,[
        //     'aboutThree' => 'required', 
        // ]);
        $aboutThree=new AboutThree;
        $aboutThree->title=$request->title;
        $aboutThree->project_name=$request->project_name;
        $aboutThree->details=$request->details;
        $aboutThree->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/about3'), $path);
            $aboutThree->image = $path;
        }
        // foreach($request->phone as $p)
        // {
                 
        //     $phones[]= $p;  
        // }
        // $phones=['phone'];
        // $aboutThree->phone=json_encode($phones);
        // foreach($request->address as $a)
        //     {
                 
        //         $addresss[]= $a;  
        //     }
         // $addresss=['address'];
         // $aboutThree->address=json_encode($addresss);

            // foreach($request->email as $e)
            // {
                 
            //     $emails[]= $a;  
            // }
         // $emails=['email'];
         // $aboutThree->email=json_encode($emails);
        $aboutThree->save();
        Session::flash('success','About Added Successfully');
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
        $aboutThree=AboutThree::find($id);
        return view('admin.pages.aboutthree.edit')->withaboutThree($aboutThree);
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
        $aboutThree=aboutThree::find($id);
        $aboutThree->title=$request->title;
        $aboutThree->project_name=$request->project_name;
        $aboutThree->details=$request->details;
        $aboutThree->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/about3'), $path);
            $aboutThree->image = $path;
        }        $aboutThree->save();
        Session::flash('success','About Updated Successfully');
        return redirect('/pages/aboutOne');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutThree=AboutThree::find($id);
        $aboutThree->delete();
        Session::flash('success','About Deleted Successfully');
        return back();
    }
}
