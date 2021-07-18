<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;
use DB;
class ContactMessageShow extends Controller
{
    public function index(){
         $showContactMsg=ContactMessage::orderBy('created_at', 'desc')->get();
         return view('admin.pages.contactShowMsg.index')->withShowContactMsg($showContactMsg);
    }


    public function messageDelete(Request $request, $id){
        $message = ContactMessage::find($id);
        $message->delete();

        return back();
    }

    public function multipleMessageDelete(Request $request){
        $request->validate([
             'message_id' => 'required',
         ],
         [
             'message_id.required'  => 'Please select item',
         ]);


         if ($request->spam == 'on') {
             foreach ($request->message_id as $item) {
                $message = ContactMessage::find($item);
                $checkEmail = DB::table('spam_emails')->where('email', $message->email)->first();

                if (!isset($checkEmail)) {
                     DB::table('spam_emails')->insert(
                        ['email' => $message->email]
                    );
                }
                 $message->delete();
             }
         }else {
             foreach ($request->message_id as $item) {
                 $message = ContactMessage::find($item);
                 $message->delete();
             }
         }

        \Session::flash('success', 'Successful delete selected items!');
        return back();
    }


}
