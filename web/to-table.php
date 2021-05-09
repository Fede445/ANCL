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

    if ($document) {
        $table_id = $document["_id"];
        header("location: tabella.php?id=$table_id");
    } else {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Tabella | ANCL Verona</title>
            <link rel="stylesheet" href="css/main.css">
            <link rel="stylesheet" href="css/tabella.css">
            <link rel="preconnect" href="https://fonts.gstatic.com" />
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500&display=swap" rel="stylesheet" />
        </head>

        <body>
            <?php include "header.php" ?>

            <main class="container">
                <h1> ANCL UP VERONA </h1>
                <h3>Nessun contratto per il seguente settore</h3>
            </main>
        </body>
<? }
} else {
    // Se non ci sono parametri GET ritorno ai settori
    header("location: index.php");
}
?>