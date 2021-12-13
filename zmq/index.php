<?php
ini_set('display_errors', true);
require_once 'vendor/autoload.php';
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__.'/.env');

$server = new Zmq\Server();
$server->connect()->start();