<?php

namespace App\Http\Controllers;

use App\Contract\PusherInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notify(PusherInterface $pusher){
        $pusher->broadcast('chat',[
            'user'=>'ibrahim',
            'info'=>[
             'from'=>'gaza',
             'work'=>'it',
             'test'=>'test'
            ]
        ]);
    }
}
