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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($test == "PartiStipulanti"){

    }
    else if ($test == "Retribruzioni"){

    }
    else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Select what to visualize</h1>
    </div>
    <p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Retribruzioni" onclick="<?php $test = "Retribuzioni"; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="PartiStipulanti" onclick="<?php $test = "PartiStipulanti"; ?>">
            </div>
    </p>
    <p class="text-center">
    <div>
    <textarea class="form-control" rows="3" spellcheck="false" data-ms-editor="true"><?php echo $ps; ?></textarea>
    </div>
    </p>
</body>
</html>