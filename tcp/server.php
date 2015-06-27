<?php
$server = new swoole_server('0.0.0.0', 9501);

$server->on('connect', function($serv, $fd) {
    $serv->send($fd, "Hello, client {$fd}!");
});

$server->on('receive', function($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server got data from {$fd}-{$from_id}!"); // 应答
    echo microtime(true), ", got data: \"{$data}\"\n";
});

$server->on('close', function($serv, $fd) {
    echo "{$fd} gone";
});

$server->start();

