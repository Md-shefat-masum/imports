<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\HotsaleDate;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class HotSaleDateController extends Controller
{
    public function index(){
        $big=HotsaleDate::orderBy('id','ASC')->get();
        return view('admin.pages.hotsale-date.index',compact('big'));
    }

 

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'date'=>'required',

            ]);
        $add=new HotsaleDate;
      $add->date=$request->date;


        $add->save();

        if($add) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

 

    public function edit(Request $request, $id) {
        $data=HotsaleDate::find($id);
        return view('admin.pages.hotsale-date.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=HotsaleDate::find($request->id);
      $add->date=$request->date;


       $add->save();

        if($add) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function delete() {
        $id=$_POST['modal_id'];
        $delete=HotsaleDate::where('status',1)->where('id',$id)->delete();
        if($delete) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function destroy($id)
    {
        $cat= DB::table('big_sales')->where('id', $id)->delete();
        Session::flash('success-two','Category Deleted Successfully');
        return back();
    }
}