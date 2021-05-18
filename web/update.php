<?php

require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Recupero i valori inseriti nel form
$stip = $_POST['stip'];
$dataS = $_POST['dataS'];
$decor = $_POST['decor'];
$scade = $_POST['scade'];
$parti = $_POST['parti'];
$divi = $_POST['divi'];
$mens = $_POST['mens'];
$previ = $_POST['previ'];
$assi = $_POST['assi'];
$enti = $_POST['enti'];
$poli = $_POST['poli'];

$document = $db->tables->findOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])]);

// devi convertirlo prima a un ObjectId
$table = $db->tables->replaceOne(
    [ '_id' => new MongoDB\BSON\ObjectId($_GET['id'])],
    [ 'nome' => 'test']
);

var_dump($table);

?>