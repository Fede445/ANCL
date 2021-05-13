<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("location: index.php");
    exit;
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Seleziono l'id del settore associato al documento
    $document = $db->tables->findOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])], ['projection' => ['sector_id' => 1]]);
    // Elimino il documento dal database
    $db->tables->deleteOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])]);
    $sectorid = $document['sector_id'];
    header("location: to-table.php?sectorid=$sectorid");
} else {
    header("location: index.php");
}

