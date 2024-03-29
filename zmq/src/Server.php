<?php

namespace Zmq;
use React\ZMQ\Context;
use Thruway\Authentication\AuthenticationManager;
use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;
use Zmq\Auth\AuthToken;

class Server{
    /**
     * @var Router
     */
    private $router;
    /**
     * @var \React\EventLoop\LoopInterface
     */
    private $loop;
    /**
     * @var \React\ZMQ\SocketWrapper
     */
    private $pull;

    public function __construct()
    {
        $this->router  = new Router();
    }

    public function connect(){

        $this->loop    = $this->router->getLoop();
        $context       = new Context($this->loop);
        $this->pull    = $context->getSocket(\ZMQ::SOCKET_PULL);
        $this->pull->bind('tcp://172.26.0.5:8030');
        return $this;
    }

    public function start(){
            $this->router->registerModules([
                new AuthenticationManager()
            ]);
            $this->router->addInternalClient(new AuthToken(['default']));
            $this->router->addTransportProvider(new RatchetTransportProvider('0.0.0.0','7474'));
            $this->router->addInternalClient(new Pusher('default',$this->loop,$this->pull));
            $this->router->start();
    }
}
