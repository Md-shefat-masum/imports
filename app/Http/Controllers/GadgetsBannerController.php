<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\GadgetsBanner;
use Carbon\Carbon;
use Session;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;

class GadgetsBannerController extends Controller
{
    public function index(){
        $value=GadgetsBanner::orderBy('id','DESC')->get();
        return view('admin.pages.gadgets-banner.index',compact('value'));
    }

    public function add() {
        return view('admin.pages.gadgets-banner.add');
    }

  
    public function store(Request $request) {
        $this->validate($request, [ 
            'image'=>'required',

            ]);
        $add=new GadgetsBanner;


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
        $data=GadgetsBanner::find($id);
        return view('admin.pages.gadgets-banner.view', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data=GadgetsBanner::find($id);
        return view('admin.pages.gadgets-banner.edit', compact('data'));
    }

    public function update(Request $request) {
        $add=GadgetsBanner::find($request->id);

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
        $cat= DB::table('gadgets_banners')->where('id', $id)->delete();
        Session::flash('success','Category Deleted Successfully');
        return back();
    }
}