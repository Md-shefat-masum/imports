<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Brand;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(){
        $brand=Brand::orderBy('id','ASC')->get();
        return view('admin.pages.brand.index',compact('brand'));
    }

 

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'brand'=>'required',

            ]);
        $add=new Brand;
        $add->brand=$request->brand;


        $add->save();

        if($add) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function view(Request $request, $id) {
        $data=Brand::find($id);
        return view('admin.pages.brand.view', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data=Brand::find($id);
        return view('admin.pages.brand.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=Brand::find($request->id);
        $add->brand=$request->brand;


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
        $delete=Brand::where('status',1)->where('id',$id)->delete();
        if($delete) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function destroy($id)
    {
        $cat= DB::table('brands')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }
}