<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET['search'])) {
    $user_string = $_GET['search'];
    // Cerco la stringa tramite la funzione Text Search di MongoDB
    $query = ['$text' => ['$search' => "$user_string"]];
} else {
    // Salvo la stringa se specificata, altrimenti ricado sulla a
    $user_string = isset($_GET['letter']) ? $_GET['letter'] : 'a';

    // Cerco i settori che inizano con la stringa $string
    $query = ['name' => ['$regex' => "^$user_string", '$options' => 'i']];
}

$sectorsCursor = $db->sectors->find($query);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <title>Tabelle paga | ANCL Verona</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="img/LogoAlt.png" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include "header.php" ?>

    <div style="padding:0 16px;min-height:100vh">
        <main class="container">
            <h1 id="title">Tabelle Paga</h1>
            <br>
            <form class="search-container" method="GET">
                <input type="search" name="search" placeholder="Cerca tabella, settore ..." class="search-field" required />
                <button type="submit" class="search-button">
                    <img src="img/search.svg">
                </button>
            </form>
            <br>
            <nav class="alfabeto">
                <a href="?letter=A">A</a>
                <a href="?letter=B">B</a>
                <a href="?letter=C">C</a>
                <a href="?letter=D">D</a>
                <a href="?letter=E">E</a>
                <a href="?letter=F">F</a>
                <a href="?letter=G">G</a>
                <a href="?letter=H">H</a>
                <a href="?letter=I">I</a>
                <a href="?letter=J">J</a>
                <a href="?letter=K">K</a>
                <a href="?letter=L">L</a>
                <a href="?letter=M">M</a>
                <a href="?letter=N">N</a>
                <a href="?letter=O">O</a>
                <a href="?letter=P">P</a>
                <a href="?letter=Q">Q</a>
                <a href="?letter=R">R</a>
                <a href="?letter=S">S</a>
                <a href="?letter=T">T</a>
                <a href="?letter=U">U</a>
                <a href="?letter=V">V</a>
                <a href="?letter=W">W</a>
                <a href="?letter=X">X</a>
                <a href="?letter=Y">Y</a>
                <a href="?letter=Z">Z</a>
            </nav>
            <br>
            <div class="settori">
                <?php foreach ($sectorsCursor as $sector) { ?>
                    <a class="settore" href="to-table.php?sectorid=<?= $sector["_id"] ?>">
                        <img src="img/document.svg" alt="Visualizza file" width="18" height="18" class="miniatura" />
                        <?php echo htmlspecialchars($sector['name']); ?>
                    </a>
                <?php } ?>
            </div>
        </main>
    </div>
</body>

</html>