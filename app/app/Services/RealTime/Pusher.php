<?php

namespace App\Services\RealTime;
use App\Contract\PusherInterface;
use GuzzleHttp\Client;

class Pusher implements PusherInterface
{

    /**
     * @var Client
     */
    private $client;
    private $token;
    private $basicUrl;

    public function __construct(Client $client)
    {
        $this->client    = $client;
        $this->token     = config('real-time.secure');
        $this->basicUrl  = config('real-time.endPoint');
    }

    public function broadcast(string $channel, array $payload)
    {
        $this->client->request('POST', "{$this->basicUrl}/push", [
            'json' => [
                'channel' => $channel,
                'payload' => $payload,
            ],
            'headers' => $this->getHeader()
        ]);
    }

    private function getHeader()
    {
        return  [
                'Authorization'=>$this->token,
            ];
    }
}
