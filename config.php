<?php

require_once __DIR__ . '/vendor/autoload.php';

define('DB_SERVER', 'database');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'example');

// MongoDB connection
try{
    // connect
    $mongo = new MongoDB\Client(
        "mongodb://" . DB_SERVER,
        array("username" => DB_USERNAME, "password" => DB_PASSWORD)
    );

    // check connection
    $mongo->listDatabases();
} catch(MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die();
}

$db = $mongo->ancl;
