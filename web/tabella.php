<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $document = $db->tables->findOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])]);
} else {
    // Se non ci sono parametri GET ritorno ai settori
    header("location: index.php");
    exit;
}
$listaPeriodi = $db->tables->find(["sector_id" => $document["sector_id"]], ['projection' => ['valid_from' => 1]]);
$settore = $db->sectors->findOne(["_id" => $document["sector_id"]]);
// TODO: implementare "documento non trovato"
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

    <?php var_dump($settore)?>

    <main class="container">
        <h1> ANCL UP VERONA</h1>
        <a href="to-add.php?sectorid=<?= $settore["_id"] ?>">ADD</a>
        <h2> <?= $settore['name'] ?> </h2></br>
        <h3> Vigente da <div class="dropdown">
            
                <button class="dropbtn"><?= strftime("%B %G", $document["valid_from"]->toDateTime()->getTimestamp()) ?> <i class="dontprint fas fa-angle-down" style="padding-left:8px;"></i></button>

                <div class="dropdown-content">
                    <?php foreach ($listaPeriodi as $periodo) { ?>
                        <a href="tabella.php?id=<?= $periodo["_id"] ?>">
                            <?= strftime("%B %G",$periodo["valid_from"]->toDateTime()->getTimestamp()); ?>
                        </a>
                    <?php 
                    } ?>

                </div>
            </div>
        </h3>
        <table class="minimalistBlack">
            <thead>
                <tr>
                    <th colspan="4"> Stipule </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Data di stipula</td>
                    <td>Decorrenza</td>
                    <td>Scadenza</td>
                </tr>
                <?php foreach ($document["stipule"] as $stipula) { ?>
                    <tr>
                        <td style="border-bottom:none"><?= $stipula["name"] ?></td>
                        <td><?= $stipula["dataStipula"] ?></td>
                        <td><?= $stipula["decorrenza"] ?></td>
                        <td><?= $stipula["scadenza"] ?><br><br></td>
                    </tr>
                    <tr>
                        <td style="border-top:none"> </td>
                        <td>Parti stipulanti</td>
                        <td colspan="2"><?= $stipula["parti"] ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table class="minimalistBlack">
            <thead>
                <tr>
                    <th colspan="4"> Parametri </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Divisori contrattuali</td>
                    <td colspan="3"><?= nl2br($document["parametri"]["divisori"]) ?></td>
                </tr>
                <tr>
                    <td> Mensilità </td>
                    <td colspan="3" style="text-align:center"><?= $document["parametri"]["mensilita"] ?></td>
                </tr>
            </tbody>
        </table>




        <table class="minimalistBlack">
            <thead>
                <tr>
                    <th colspan="4"> Welfare </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Previdenza complementare</td>
                    <td colspan="3"> <?= nl2br($document["welfare"]["previdenza"]) ?></td>
                </tr>
                <tr>
                    <td> Assistenza integrative </td>
                    <td colspan="3"><?= nl2br($document["welfare"]["assistenza"]) ?></td>
                </tr>

                <tr>
                    <td> Enti bilaterali</td>
                    <td colspan="3"><?= nl2br($document["welfare"]["enti"]) ?></td>
                </tr>
                <tr>
                    <td> Polizze assicurative </td>
                    <td colspan="3"><?= nl2br($document["welfare"]["polizze"]) ?></td>
                </tr>

            </tbody>
        </table>
    </main>
</body>

</html>