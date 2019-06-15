<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class ProductsController extends SNSController
{
    public function handleRequest(Request $request, $phone_number) {

        $requestJSON =  json_decode($request->getContent(), true);

        if ($requestJSON['Type']  == 'SubscriptionConfirmation') {

            return $this->subscribe($requestJSON);

        }

        $text_message = $requestJSON['Message'];

        $this->sendSMS($phone_number, $text_message);
    }

    public function sendSMS($number, $text_message) {

        $sid        = "AC234d8310cc34877c447963f0529f89b4";
        $token      = "285254bcbc39faf41cf6722f698281df";
        $twilio     = new Client($sid, $token);
        $message_body = json_encode($text_message);

        $message = $twilio  ->messages
                            ->create("$number",
                                    array("from" => "+441603340331",
                                            "body" => "$message_body")
                                    );

        return app('Illuminate\Http\Response')->status();

    }
}
