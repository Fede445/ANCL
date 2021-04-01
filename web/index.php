<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$query = $_GET['query'];
$letter = isset($query) ? $query : 'a';

$sectorsCursor = $db->sectors->find(['name' => ['$regex' => "^$letter", '$options' => 'i']]);
?>
 
<!DOCTYPE html>
<html lang="en">
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
    <?php include "header.php"?>

    <div style="padding:0 16px;height:100%">
        <main class="container">
            <h1 id="title">Tabelle Paga</h1>
            <br>
            <form class="search-container" method="GET">
                <input type="search" name="query" placeholder="Cerca tabella, settore ..." class="search-field" required />
                <button type="submit" class="search-button">
                    <img src="img/search.svg">
                </button>
            </form>
            <br>
            <nav class="alfabeto">
                <a href="?query=A">A</a>
                <a href="?query=B">B</a>
                <a href="?query=C">C</a>
                <a href="?query=D">D</a>
                <a href="?query=E">E</a>
                <a href="?query=F">F</a>
                <a href="?query=G">G</a>
                <a href="?query=H">H</a>
                <a href="?query=I">I</a>
                <a href="?query=J">J</a>
                <a href="?query=K">K</a>
                <a href="?query=L">L</a>
                <a href="?query=M">M</a>
                <a href="?query=N">N</a>
                <a href="?query=O">O</a>
                <a href="?query=P">P</a>
                <a href="?query=Q">Q</a>
                <a href="?query=R">R</a>
                <a href="?query=S">S</a>
                <a href="?query=T">T</a>
                <a href="?query=U">U</a>
                <a href="?query=V">V</a>
                <a href="?query=W">W</a>
                <a href="?query=X">X</a>
                <a href="?query=Y">Y</a>
                <a href="?query=Z">Z</a>
            </nav>
            <br>
            <div class="settori">
                <?php foreach($sectorsCursor as $sector) { ?>
                    <p class="settore">
                        <img src="img/document.svg" alt="Visualizza file" width="18" height="18" class="miniatura" />
                        <?php echo htmlspecialchars($sector['name']); ?>
                    </p>
                <?php } ?>
            </div>
        </main>
    </div>
</body>
</html>