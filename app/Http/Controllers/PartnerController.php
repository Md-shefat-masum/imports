<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();
        return view('admin.pages.footer.partners', compact('partners'));
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

        $requestData = $request->except(['image']);
        $image=$request->image;
        if($image){
            $imageName=time().'.'.$image->getClientOriginalName();
            $image->move('images/footer', $imageName);
            $requestData['image']=$imageName;
        }

        Partner::create($requestData);

        $request->session()->flash('success', 'Successfully created!');

        return redirect()->route('partners.index');
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

        $partner = Partner::findOrFail($id);

        return view('admin.pages.footer.partners_edit', compact('partner'));
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
        $requestData = $request->except(['image']);
        $image=$request->image;
        if($image){
            $imageName=time().'.'.$image->getClientOriginalName();
            $image->move('images/footer', $imageName);
            $requestData['image']=$imageName;
        }
        $partner = Partner::findOrFail($id);
        $partner->update($requestData);

        $request->session()->flash('success', 'Successfully Updated!');

        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $partner = Partner::find($id);
        $partner->delete();

        $request->session()->flash('danger', 'Successfully deleted!');

        return redirect()->route('partners.index');
    }
}
