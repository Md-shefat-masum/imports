<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\CategoryOffer;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class CategoryOfferController extends Controller
{
    public function index(){
        $value=CategoryOffer::orderBy('id','DESC')->get();
        return view('admin.pages.category-offer.index',compact('value'));
    }

    public function add() {
        return view('admin.pages.category-offer.add');
    }

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'image'=>'required',

            ]);
        $add=new CategoryOffer;


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
        $data=CategoryOffer::find($id);
        return view('admin.pages.category-offer.view', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data=CategoryOffer::find($id);
        return view('admin.pages.category-offer.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=CategoryOffer::find($request->id);

        if($request->hasFile('image')) {
            if(Storage::disk('public')->exists('images/slider/'.$add->image)) Storage::disk('public')->delete('images/slider/'.$add->image);
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



    public function destroy($id)
    {
        $cat= DB::table('category_offers')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }
}