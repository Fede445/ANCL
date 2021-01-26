<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if no then redirect him to login page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
    header("location: login.php");
}

// Include config file
require_once "config.php";

$test = $ps = "";

if (isset($_POST["button1"])){
    $ps = "Pulsante 1";
}
else if (isset($_POST["button2"])){
    $sql = "SELECT partiStipulanti FROM stipule";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        /*$stmt->bind_param("i", $param_ID);
        
        // Set parameters
        $param_ID = 1;*/
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Store result
            $stmt->store_result();
            
            // Check if username exists, if yes then verify password
            $stmt->bind_result($ps);

            $stmt->fetch();
        }
    }
}
else if (isset($_POST{"clear"})){
    $ps = "";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Select what to visualize</h1>
    </div>
    <p>
        <form method="post">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Retribruzioni" name="button1">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="PartiStipulanti" name="button2">
            </div>
    </p>
    <p class="text-center">
    <div>
    <textarea class="form-control" rows="3" spellcheck="false" data-ms-editor="true"><?php echo $ps; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-danger" value="Cancella" name="clear">
    </div>
    <div class="form-group">
        <a href="../index.php" class="btn btn-info">Home</a>
    </p>
</body>
</html>