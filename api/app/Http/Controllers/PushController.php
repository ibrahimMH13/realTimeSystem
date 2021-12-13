<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZMQ;
use ZMQContext;

class PushController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

   public function index(Request $request){

      $context = new ZMQContext();
      $socket  = $context->getSocket(ZMQ::SOCKET_PUSH);
      $socket->connect(env('ZMQ_HOST'));

      $socket->send('abc');

   }

   public function store(Request $request){

       $context = new ZMQContext();
       $socket  = $context->getSocket(ZMQ::SOCKET_PUSH);
       $socket->connect(config('zmq.host'));
       $socket->send(json_encode($request->all()));
    }
}
