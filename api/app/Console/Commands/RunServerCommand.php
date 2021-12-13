<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;

class RunServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run push server';

    public function handle(){

       $router = new Router();
       $loop   = $router->getLoop();

    //   $context = new Context;
      // $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
    //   $pull->bind('tcp://zmq-server:5555');
        $router->addTransportProvider(new RatchetTransportProvider('172.26.0.5',7474));
        $router->start();
    }
}
