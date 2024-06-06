<?php

require_once '../vendor/autoload.php';

use Todo\TodoRequest;
use Todo\TodoServicesClient;

$client = new TodoServicesClient('server:8081', [
    'credentials' => \Grpc\ChannelCredentials::createInsecure(),
]);

$request = new TodoRequest();
$request->setText('World');

list($response, $status) = $client->Add($request)->wait();

if ($status->code === \Grpc\STATUS_OK) {
    echo $response->getData() . PHP_EOL;
} else {
    echo 'Error: ' . $status->details . PHP_EOL;
}