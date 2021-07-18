<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Discount;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index(){
        $value=Discount::orderBy('id','DESC')->get();
        return view('admin.pages.discount.index',compact('value'));
    }

    public function add() {
        return view('admin.pages.discount.add');
    }

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'image'=>'required',

            ]);
        $add=new Discount;
        $add->title=$request->title;
        $add->category=$request->category;
        $add->discount=$request->discount;
        $add->discount_start=$request->discount_start;
        $add->discount_end=$request->discount_end;
        $add->details=$request->details;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/slider'), $path);
            $add->image = $path;
        }

        $add->save();

        if($add) {
            return back()->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }

    public function view(Request $request, $id) {
        $data=Discount::find($id);
        return view('admin.pages.discount.view', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data=Discount::find($id);
        return view('admin.pages.discount.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=Discount::find($request->id);
        $add->title=$request->title;
        $add->category=$request->category;
        $add->discount=$request->discount;
        $add->discount_start=$request->discount_start;
        $add->discount_end=$request->discount_end;
        $add->details=$request->details;

        if($request->hasFile('image')) {
            if(Storage::disk('public')->exists('images/slider/'.$add->image)) Storage::disk('public')->delete('images/slider/'.$add->image);
            $image = $request->file('image');
            $path=$request->image->getClientOriginalName();
           
            $image->move(public_path('/images/slider'), $path);
            $add->image = $path;
        }
        $add->save();

        if($add) {
            // return back()->with('success', 'value');
            return redirect()->route('discount')->with('success', 'value');
        }

        else {
            return back()->with('error', 'value');
        }
    }



    public function destroy($id)
    {
        $cat= DB::table('discounts')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }
}