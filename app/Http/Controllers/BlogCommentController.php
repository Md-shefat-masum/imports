<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\BlogComment;

class BlogCommentController extends Controller
{
    public function commentStore(Request $request)
    {

        if (Auth::guest()){

            return back()->with('errorl', ['your message,here']);;
        }
        else{

        $requestData = $request->all();
        $firstName = \Auth::user()->first_name;
        $lastName = \Auth::user()->last_name;
        $requestData['author_name'] = $firstName .' '. $lastName;
        BlogComment::create($requestData);

        return back();
        }
    }
}
