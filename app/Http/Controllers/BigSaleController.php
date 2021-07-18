<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\BigSale;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class BigSaleController extends Controller
{
    public function index(){
        $big=BigSale::orderBy('id','ASC')->get();
        return view('admin.pages.bigsale.index',compact('big'));
    }

 

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'title'=>'required',

            ]);
        $add=new BigSale;
      $add->title=$request->title;


        $add->save();

        if($add) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function view(Request $request, $id) {
        $data=BigSale::find($id);
        return view('admin.pages.bigsale.view', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data=BigSale::find($id);
        return view('admin.pages.bigsale.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=BigSale::find($request->id);
      $add->title=$request->title;


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
        $delete=BigSale::where('status',1)->where('id',$id)->delete();
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