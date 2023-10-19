<?php

require "vendor/autoload.php";

$obj = new \Tokenmid\TokenMidllerware\Test();
//$obj->t();
$o = new \Tokenmid\TokenMidllerware\GetUserFromApp();
$sql_data = [
    'DB_HOST' => '127.0.0.1',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => 'root',
    'DB_DATABASE' => 'test',
];
$data = $o->get($sql_data, 'C41FD4BDD04AE1198FCADC053C1467D7');
var_dump($data);