<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutOne;
use App\AboutTwo;
use App\AboutThree;
use Illuminate\Support\Facades\DB;
use Session;
use App\Footer;
use App\QuickContact;

class FooterController extends Controller
{
    // FACEBOOK FEED START
    public function facebookFeed()
    {
        $feeds = DB::table('facebook_feed')->get();

        return view('admin.pages.footer.facebook_feed', compact('feeds'));
    }

    public function addFacebookFeed(Request $request)
    {
        if (isset($request->title) && isset($request->url)) {
            DB::table('facebook_feed')->insert([
                'title' => $request->title,
                'link' => $request->url,
                'status' => $request->status,
            ]);
            $request->session()->flash('success', 'Successfully Created !');
            return back();
        }
        return back();
    }
    public function editFacebookFeed(Request $request, $id)
    {
        $feed = DB::table('facebook_feed')->where('id', $id)->first();

        return view('admin.pages.footer.facebook_feed_edit', compact('feed'));
    }
    public function facebook(Request $request, $id)
    {
        if (isset($request->title) && isset($request->url)) {
            DB::table('facebook_feed')->where('id', $id)->update([
                'title' => $request->title,
                'link' => $request->url,
                'status' => $request->status,
            ]);
            $request->session()->flash('success', 'Updated Successfully !');
            return redirect()->route('facebookFeed');
        }
        return back();
    }
    public function deleteFacebookFeed(Request $request, $id)
    {
        $feed = DB::table('facebook_feed')->where('id', $id);
        $feed->delete();

        $request->session()->flash('danger', 'Successfully deleted!');

        return back();
    }
    // FACEBOOK FEED END


    // QUICK CONTACT START
    public function quickContact()
    {
        $quickContact = QuickContact::all();

        return view('admin.pages.footer.quick_contact', compact('quickContact'));
    }
    public function editQuickContact(Request $request, $id)
    {
        $quickContact = QuickContact::findOrFail($id);

        return view('admin.pages.footer.quick_contact_edit', compact('quickContact'));
    }

    public function updateQuickContact(Request $request, $id)
    {

        $quickContact = QuickContact::findOrFail($id);
        //dd($request->all());
        if (isset($quickContact)) {
            $quickContact->update($request->all());
            $request->session()->flash('success', 'Updated Successfully !');
            return redirect()->route('quickContact');
        }
        return back();
    }
}
