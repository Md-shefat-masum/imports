<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;
use DB;
use Session;
class SpamRegistrationsController extends Controller
{
    public function index()
    {
         $spam_registration = DB::table('verification')->orderBy('created_at', 'desc')->get();
         return view('admin.pages.spam-registrations.index', compact('spam_registration'));
    }
    public function delete_spam($id)
    {
        $spam_user = DB::table('verification')->where('id',$id)->delete();
        Session::flash('success','Spam User Deleted Successfully');
        return back();
    }
}
