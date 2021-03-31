<?php

require_once __DIR__ . '/vendor/autoload.php';

define('DB_SERVER', 'database');
define('DB_USERNAME', 'apache_web_server');
define('DB_PASSWORD', 'RQmUP6fZFHdDbrKh');
define('DB_NAME', 'ancl');

// MongoDB connection
try{
    // connect
    $mongo = new MongoDB\Client(
        "mongodb://" . DB_SERVER,
        array("username" => DB_USERNAME, "password" => DB_PASSWORD, "authSource" => DB_NAME)
    );

    // check connection
    $mongo->listDatabases();
} catch(MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die();
}

$db = $mongo->ancl;
