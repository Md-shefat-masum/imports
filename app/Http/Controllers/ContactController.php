<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Session;
class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact=Contact::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.contact.index')->withContact($contact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'address2' => 'nullable',
        ]);
        $contact=new Contact;
        $contact->title=$request->title;
        $contact->phone1=$request->phone1;
        $contact->phone2=$request->phone2;
        $contact->address1=$request->address1;
        $contact->address2=$request->address2;
        $contact->email1=$request->email1;
        $contact->email2=$request->email2;
        $contact->website1=$request->website1;
        $contact->website2=$request->website2;
        // foreach($request->phone as $p)
        // {

        //     $phones[]= $p;
        // }
        // $phones=['phone'];
        // $contact->phone=json_encode($phones);
        // foreach($request->address as $a)
        //     {

        //         $addresss[]= $a;
        //     }
         // $addresss=['address'];
         // $contact->address=json_encode($addresss);

            // foreach($request->email as $e)
            // {

            //     $emails[]= $a;
            // }
         // $emails=['email'];
         // $contact->email=json_encode($emails);
        $contact->save();
        Session::flash('success','contact Added Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact=Contact::find($id);
        return view('admin.pages.contact.edit')->withContact($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact=Contact::find($id);
         $contact->title=$request->title;
        $contact->phone1=$request->phone1;
        $contact->phone2=$request->phone2;
        $contact->address1=$request->address1;
        $contact->address2=$request->address2;
        $contact->email1=$request->email1;
        $contact->email2=$request->email2;
        $contact->website1=$request->website1;
        $contact->website2=$request->website2;
        $contact->save();
        Session::flash('success','contact Updated Successfully');
        return redirect('/pages/contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=Contact::find($id);
        $contact->delete();
        Session::flash('success','contact Deleted Successfully');
        return back();
    }
}
