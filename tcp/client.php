<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

$client->on('connect', function($cli) {
    $cli->send('hi, server!');
});

$client->on('error', function($cli) {
    echo "error!\n";
});

$client->on('receive', function($cli, $data) {
    //$cli->send('Client got data from server!'); // 应答
    echo microtime(true), ", {$data}\n";
    //sleep(1);
});

$client->on('close', function($cli) {
    //$cli->send('bye!');
});

$client->connect('127.0.0.1', 9501, 1);


