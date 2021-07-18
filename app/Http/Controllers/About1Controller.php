<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutOne;
use App\AboutTwo;
use App\AboutThree;
use Session;
class About1Controller extends Controller
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
        $aboutThree=AboutThree::all();
        $aboutOne=AboutOne::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.pages.aboutone.index')->withAboutOne($aboutOne)->withAboutTwo($aboutTwo)->withAboutThree($aboutThree);
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
        $aboutOne=new AboutOne;
        $aboutOne->title=$request->title;
        $aboutOne->description=$request->description;
        $aboutOne->btn_name=$request->btn_name;
        $aboutOne->btn_link=$request->btn_link;
        $aboutOne->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/about'), $path);
            $aboutOne->image = $path;
        }
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
        $aboutOne->save();
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
        $aboutOne=AboutOne::find($id);
        return view('admin.pages.aboutone.edit')->withAboutOne($aboutOne);
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
        $aboutOne=AboutOne::find($id);
        $aboutOne->title=$request->title;
        $aboutOne->description=$request->description;
        $aboutOne->btn_name=$request->btn_name;
        $aboutOne->btn_link=$request->btn_link;
        $aboutOne->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/about'), $path);
            $aboutOne->image = $path;
        }
        $aboutOne->save();
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
        $aboutOne=AboutOne::find($id);
        $aboutOne->delete();
        Session::flash('success','About Deleted Successfully');
        return back();
    }
}