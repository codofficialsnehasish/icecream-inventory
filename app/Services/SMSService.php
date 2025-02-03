<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    public function sendSMS($phone_number, $otp = 0)
    {
        $url = 'http://103.10.234.154/vendorsms/pushsms.aspx';

        try {
            $response = Http::get($url, [
                'user' => 'YLO@API',
                'password' => 'Q1WWBLFL',
                'msisdn' => $phone_number,
                'sid' => 'MSGOTT',
                'msg' => 'Your OTP For Login To Portal is '.$otp.' Any issue Contact us 7031182870 MSG',
                'fl' => 0,
                'gwid' => 2,
            ]);

            if ($response->status() == 200) {
                return $response;
            } else {
                // return "Failed to send SMS. Status code: " . $response->status();
                return $response;
            }
        } catch (\Exception $e) {
            // return "An error occurred while sending the SMS: " . $e->getMessage();
            return false;
        }
    }
}
