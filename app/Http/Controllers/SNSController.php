<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class SNSController extends Controller
{
    public function handleRequest(Request $request) {

        Log::info('Inside handleRequest');
        $requestJSON =  json_decode($request->getContent(), true);

        if ($requestJSON['Type']  == 'SubscriptionConfirmation') {
            return $this->subscribe($requestJSON);

        }

        $this->handleNotification($requestJSON);
    }

    private function subscribe($notification) {

        Log::info("Subscribing to topic");

        $guzzleClient = new \GuzzleHttp\Client();

        $guzzleResponse = $guzzleClient->get($notification['SubscribeURL']);

        Log::info('Successfully subscribed');

        return app('Illuminate\Http\Response')->status();

    }

    protected function handleNotification($notification) {

    }
}
