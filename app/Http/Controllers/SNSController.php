<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class SNSController extends Controller
{
    private function subscribe($notification) {

        Log::info("Subscribing to topic");

        $guzzleClient = new \GuzzleHttp\Client();

        $guzzleResponse = $guzzleClient->get($notification['SubscribeURL']);

        Log::info('Successfully subscribed');

        return app('Illuminate\Http\Response')->status();

    }
}
