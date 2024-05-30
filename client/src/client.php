<?php

require_once '../vendor/autoload.php';

use Todo\TodoRequest;
use Todo\TodoServicesClient;
use Grpc\ChannelCredentials;
use \Grpc\STATUS_OK;

$client = new TodoServicesClient('host.docker.internal:50051', [
    // 'credentials' => ChannelCredential::createInsecure(),
]);

$request = new TodoRequest();
$request->setText('World');

list($response, $status) = $client->Add($request)->wait();

if ($status->code === \Grpc\STATUS_OK) {
    echo $response->getMessage() . PHP_EOL;
} else {
    echo 'Error: ' . $status->details . PHP_EOL;
}