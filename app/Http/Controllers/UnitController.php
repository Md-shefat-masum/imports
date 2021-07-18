<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Session;
class UnitController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit=Unit::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.units.index')->withUnit($unit);
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
            'unit' => 'required', 
        ]);
        $unit=new Unit;
        $unit->unit=$request->unit;
        $unit->save();
        Session::flash('success','Unit Added Successfully');
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
        $unit=Unit::find($id);
        return view('admin.pages.units.edit')->withUnit($unit);
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
        $unit=Unit::find($id);
        $unit->unit=$request->unit;
        $unit->save();
        Session::flash('success','Unit Updated Successfully');
        return redirect('/pages/units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit=Unit::find($id);
        $unit->delete();
        Session::flash('success','Unit Deleted Successfully');
        return redirect('/pages/units');
    }

}