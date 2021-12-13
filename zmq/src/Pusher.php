<?php

namespace Zmq;

use React\EventLoop\LoopInterface;
use React\ZMQ\SocketWrapper;
use Thruway\Peer\Client;

class Pusher extends Client
{
    /**
     * @var SocketWrapper
     */
    private $socketWrapper;

    public function __construct($realm, LoopInterface $loop = null, SocketWrapper $socketWrapper)
    {
        parent::__construct($realm, $loop);
        $this->socketWrapper = $socketWrapper;
    }

    public function onSessionStart($session, $transport)
    {
        $this->socketWrapper->on('message', [$this, 'transmit']);
    }

    public function transmit($payload)
    {
        $payload = json_decode($payload, false);
        if (!$this->haveRequiredProperty($payload)){
            return;
        }
        $this->getSession()->publish($this->getPrefixChannel($payload), [$payload->payload]);
    }

    private function getPrefixChannel($payload)
    {
        return "{$payload->app_id}_{$payload->channel}";
    }

    private function haveRequiredProperty($payload)
    {
        return property_exists($payload,'app_id') && property_exists($payload,'channel');
    }
}