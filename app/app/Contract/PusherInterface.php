<?php
namespace App\Contract;
interface PusherInterface
{
    public function broadcast(string $channel, array $payload);
}
