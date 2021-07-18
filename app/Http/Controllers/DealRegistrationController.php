<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Blog;
use App\DealRegistration;
use Auth;
class DealRegistrationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $blog=DealRegistration::where('auth_user', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('admin.pages.deal_registration.deal_registration', compact('blog'));
    }
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['auth_user'] = Auth::user()->id;
        DealRegistration::create($requestData);

        $blog=DealRegistration::orderBy('created_at', 'DESC')->paginate(20);
        return redirect()->route('deal_registration');
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $group_id = \Auth::user()->group_id;

        if($group_id==1){
            $deal=DealRegistration::where('id',$id)->first();
            if ($deal) {
                return view('admin.pages.deal_registration.edit_deal_registration', compact('deal'));
            }else {
                return redirect()->back();
            }
        }else {
            $deal=DealRegistration::where('auth_user', $user_id)->where('id',$id)->first();
            if ($deal) {
                return view('admin.pages.deal_registration.edit_deal_registration', compact('deal'));
            }else {
                return redirect()->back();
            }
        }
    }


    public function update(Request $request, $id)
    {

        $user_id = Auth::user()->id;
        $requestData = $request->all();
        $requestData['auth_user'] = Auth::user()->id;

        $deal = DealRegistration::findOrFail($id);
        $deal->fill($requestData)->save();

        return redirect()->route('deal_registration');
    }

    public function destroy(Request $request, $id)
    {

        $deal = DealRegistration::findOrFail($id);
        $deal->delete();

        return redirect()->route('deal_registration');
    }

    public function deal_manager()
    {
        $group_id = \Auth::user()->group_id;

        if($group_id==1){
            $blog=DealRegistration::orderBy('created_at', 'DESC')->get();
            return view('admin.pages.deal_registration.deal_manager', compact('blog'));
        }
    }
}