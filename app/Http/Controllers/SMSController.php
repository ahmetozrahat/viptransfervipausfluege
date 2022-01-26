<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    /**
     * Function for sending SMS messages through Twilio REST Api.
     *
     * @param $recipients
     * @param string $message
     * @return void
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendMessage($recipients, string $message) {
        $account_sid = getenv("TWILIO_AUTH_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }
}
