<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Menu;
use App\ProductCategory;
use App\User;
use App\Supplier;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use App\Mail\SendMail;
use App\Mail\VerificationMail;
use App\Mail\ReSendMail;
use App\Mail\EntrepreneurMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class VerificationController extends Controller
{
    public function user_email_check(Request $request)
    {
        return view('front_end.verification.email_verification');
    }

    public function email_otp_send(Request $request)
    {
        $this->validate($request, [
            'email'  =>  'required|email',
        ]);

        $data = User::where('email', $request->email)->first();

        if (isset($data)) {
            Session::flash('error', 'Sorry! Your email is already registered');
            return view('front_end.verification.email_verification');
        }

        $token = Str::random(62);

        $otp_number = mt_rand(100000, 999999);

        DB::table('verification')->insert(
            [
                'email' => $request->email,
                'token' => $token,
                'email_otp' => $otp_number,
                'user_type' => Session::get('user_type'),
            ]
        );

        $data = array(
            'code' => $otp_number,
            'email' => $request->email,
            'time' => Carbon::now(),
        );
        Mail::to($request->email)->send(new VerificationMail($data));
        return redirect()->route('user_email_otp', 'token='.$token);
    }
    public function user_email_otp()
    {
        $id = $_GET['token'];
        $data = DB::table('verification')->where('token', $id)->first();

        if (isset($data)) {
            Session::flash('success', 'Thank You! A verification code is sent to your email');
            return view('front_end.verification.email_verify_now');
        }else {
            Session::flash('error', 'Sorry! Something went wrong please try with diffrent email');
            return view('front_end.verification.email_verification');
        }

    }
    public function user_email_otp2()
    {
        return view('front_end.verification.email_verify_now');

    }
    public function email_otp_submit(Request $request)
    {
        $this->validate($request, [
            'otp'  =>  'required|numeric',
            'token'  =>  'required',
        ]);

        $data = DB::table('verification')->where('token', $request->token)->first();

        if ($data->email_otp ==  $request->otp) {
            DB::table('verification')->where('token',  $request->token)->update(
                [
                    'email_verified_at' => Carbon::now(),
                    'email_otp' => '',
                ]
            );
            Session::flash('success', 'Thank You! your email has been successfully verified');

            return redirect()->route('phone_otp_check', 'token='.$request->token);


        }else {
            Session::flash('error', 'Sorry! The OTP entered is incorrect.');
            return redirect()->route('user_email_otp2', 'token='.$request->token);
        }

    }




    public function phone_otp_check(Request $request)
    {
        $id = $_GET['token'];
        $data = DB::table('verification')->where('token', $id)->first();

        //if token is mathced and email is verfied then proced
        if ($id == $data->token) {
            return view('front_end.verification.phone_verification');
        }else {
            return redirect()->route('user_email_check');
        }

    }

    public function phone_otp_send(Request $request)
    {
        $this->validate($request, [
            'phone'  =>  'required|numeric',
            'token'  =>  'required',
            'country_name'  =>  'required',
        ]);

        $otp_number = mt_rand(100000, 999999);
        $phone_number = '+' . $request->country_name . $request->phone;

        DB::table('verification')->where('token',  $request->token)->update(
            [
                'phone' => $request->country_name . $request->phone,
                'phone_otp' => $otp_number,
            ]
        );

        $url = "https://api.twilio.com/2010-04-01/Accounts/ACc1275cac4f939a2f6d9749bdea1726d4/Messages.json";
        $from = '+18044093532';
        $to = $phone_number;
        $body = 'Your Freeworld Verification Code is '.$otp_number. '.';
        $id = "ACc1275cac4f939a2f6d9749bdea1726d4";
        $token = 'e2c002c9c60f6e8bd99ecd38c271a7f6';
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url);
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);

        return redirect()->route('user_phone_otp', 'token='.$request->token);
    }

    public function user_phone_otp()
    {
        $id = $_GET['token'];
        $data = DB::table('verification')->where('token', $id)->first();

        if (isset($data)) {
            Session::flash('success', 'Thank You! A verification code is sent to your phone');
            return view('front_end.verification.phone_verify_now');
        }else {
            Session::flash('error', 'Sorry! Something went wrong please try with diffrent phone number');
            return view('front_end.verification.phone_verification');
        }
    }
    public function user_phone_otp2()
    {
        return view('front_end.verification.phone_verify_now');
    }
    public function phone_otp_submit(Request $request)
    {
        $this->validate($request, [
            'otp'  =>  'required|numeric',
            'token'  =>  'required',
        ]);

        $data = DB::table('verification')->where('token', $request->token)->first();

        if ($data->phone_otp ==  $request->otp) {
            DB::table('verification')->where('token',  $request->token)->update(
                [
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => '',
                ]
            );

            Session::flash('success', 'Thank You! your phone has been successfully verified');

            $user_url = '/login-register?token='.$request->token;
            $entrepreneurs_url = '/entrepreneur/register?token='.$request->token;
            $suppliers_url = '/suppliers-register?token='.$request->token;

            $user_type = Session::get('user_type');

            if ($user_type == 'user') {
                return redirect($user_url);

            }elseif ($user_type == 'entrepreneurs') {
                return redirect($entrepreneurs_url);
            }elseif ($user_type == 'suppliers') {
                return redirect($suppliers_url);
            }


        }else {
            Session::flash('error', 'Sorry! The OTP entered is incorrect.');
            return redirect()->route('user_phone_otp2', 'token='.$request->token);
        }

    }
}
