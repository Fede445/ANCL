<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET["sectorid"]) && !empty($_GET["sectorid"])) {
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php" ?>
    <main class="container">
        <?php if ($_SESSION["role"] == "admin") { ?>
        <div class="dontprint container btn-container">
            <a class="btn btn-success"
                href="to-add.php?sectorid=<?= $_GET["sectorid"] ?>"><i
                    class="fas fa-plus-circle"></i> Aggiungi taella paga</a>
        </div>
        <?php } ?>

        <h1> ANCL UP VERONA </h1>
        <h3>Nessuna tabella paga per il seguente settore</h3>
    </main>
</body>
<? }
} else {
    // Se non ci sono parametri GET ritorno ai settori
    header("location: index.php");
}
?>