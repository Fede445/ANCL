<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if no then redirect him to login page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
}

// Include config file
require_once "config.php";

$ps = "";
if (isset($_GET["button2"])) {
    $sql = "SELECT partiStipulanti FROM stipule";



    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        /*$stmt->bind_param("i", $param_ID);

        // Set parameters
        $param_ID = 1;*/
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if username exists, if yes then verify password
            $stmt->bind_result($ps);

            $stmt->fetch();
        }
    }
} elseif (isset($_POST{"clear"})) {
    $ps = "";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Visualizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css">
    body {
        font: 14px sans-serif;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Selezionare cosa si vuole visualizzare</h1>
    </div>


    <form method="get">
        <div class="btn-group">
            <input type="submit" class="btn btn-primary" value="Retribruzioni" name="button1">
            <input type="submit" class="btn btn-secondary" value="PartiStipulanti" name="button2">
        </div>
        <br><br>

        <div class="mx-auto" style="width: 500px">
            <textarea class=" form-control" row="3"><?php echo $ps; ?></textarea>
        </div>
        <br><br>

        <?php
        if (isset($_GET["button1"])) {
            $sql = "SELECT partiStipulanti FROM stipule";

            if ($stmt = $mysqli->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                /*$stmt->bind_param("i", $param_ID);

                // Set parameters
                $param_ID = 1;*/
        
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Store result
                    $stmt->store_result();
            
                    // Check if username exists, if yes then verify password
                    $stmt->bind_result($ps);

                    $stmt->fetch();
                }
            }
        }
?>

        <br><br>
        <div class="btn-group">
            <input type="submit" class="btn btn-danger" value="Cancella" name="clear">
            <a href="../index.php" class="btn btn-info">Home</a>
        </div>

</body>

</html>