<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET["sectorid"])) {
    // Dato l'id di un settore seleziono l'ultima tabella
    $document = $db->tables->findOne(
        ["sector_id" => new MongoDB\BSON\ObjectId($_GET["sectorid"])],
        [
            "sort" => ["valid_from" => -1],
            "limit" => 1
        ]
    );

    // TODO: implementare settore non trovato/non ha documenti 
    $table_id = $document["_id"];
    header("location: tabella.php?id=$table_id");
} else {
    // Se non ci sono parametri GET ritorno ai settori
    header("location: index.php");
}