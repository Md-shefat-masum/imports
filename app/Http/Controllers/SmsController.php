<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Contact;
use stdClass;


class SmsController extends Controller
{
    public function check()
    {
        return view('front_end.pages.sms');
    }

    public function sms_test(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',

        ]);


        $data = [
            'messages' => [
                'from' => '8804445656060',
                'destinations' => [
                    'to' => $request->phone,
                ],
                'text' => 'Dear user, Use 448938 as ONE TIME OTP Code.'

            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://lpxyr.api.infobip.com/sms/2/text/advanced',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode('Hsbl' . ':' . 'Abcde@12345'),
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $responseData = json_decode($response, true);
        dd($responseData);


    }

}
