<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function index()
    {
        return view('admin.pages.reset-bid-price.index');
    }

    public function reset_now(Request $request)
    {
        DB::table('all_bids')->update(['your_bid' => 0]);
        // $bidPrice = DB::table('all_bids')->select('your_bid')->where('your_bid','>','0')->get();

        // if ($bidPrice) {

        //     $bidPrice->your_bid='0';
        //     $bidPrice->save();
        // }
        // $bidPrice->save();
        return redirect()->back()->with('success','value');
    }
}
