<?php

namespace App\Http\Controllers\admin;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB,Session,Auth;

class ManagerController extends Controller
{
    public function index()
    {
      return 'hi';
    }
}
