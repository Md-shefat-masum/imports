<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutTwo;
use App\AboutOne;
use App\AboutThree;
use Session;
class About2Controller extends Controller
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
        $aboutOne=AboutOne::all();
        $aboutThree=AboutThree::all();
        $aboutTwo=AboutTwo::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.pages.aboutone.index')->withAboutOne($aboutTwo)->withAboutOne($aboutOne)->withAboutThree($aboutThree);
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
        //     'aboutOne' => 'required', 
        // ]);
        $aboutTwo=new AboutTwo;
        $aboutTwo->title=$request->title;
        $aboutTwo->content=$request->content;
        $aboutTwo->status=$request->status;
        
        // foreach($request->phone as $p)
        // {
                 
        //     $phones[]= $p;  
        // }
        // $phones=['phone'];
        // $aboutOne->phone=json_encode($phones);
        // foreach($request->address as $a)
        //     {
                 
        //         $addresss[]= $a;  
        //     }
         // $addresss=['address'];
         // $aboutOne->address=json_encode($addresss);

            // foreach($request->email as $e)
            // {
                 
            //     $emails[]= $a;  
            // }
         // $emails=['email'];
         // $aboutOne->email=json_encode($emails);
        $aboutTwo->save();
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
        $aboutTwo=AboutTwo::find($id);
        return view('admin.pages.abouttwo.edit')->withAboutTwo($aboutTwo);
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
        $aboutTwo=AboutTwo::find($id);
        $aboutTwo->title=$request->title;
        $aboutTwo->content=$request->content;
        $aboutTwo->status=$request->status;
        $aboutTwo->save();
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
        $aboutTwo=AboutTwo::find($id);
        $aboutTwo->delete();
        Session::flash('success','About Deleted Successfully');
        return back();
    }
}
