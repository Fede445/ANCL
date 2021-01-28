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
        /*$stmt->bind_param("$i", $param_ID);

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

function tableChecker($obj, $cond)
{
    $i = $y = 0;
    $return = null;
    if ($cond == "Q") {
        foreach ($obj as $value) {
            if ($value->livello == "Q") {
                $return[$y] = $value;
                $y++;
            } else {
                $i++;
            }
        }
        return $return;
    } elseif ($cond == "Minimo") {
        foreach ($obj as $value) {
            if ($value->nomeColonne == "Minimo") {
                $return[$y] = $value;
                $y++;
            } else {
                $i++;
            }
        }
        return $return;
    } elseif ($cond == "Contingenza") {
        foreach ($obj as $value) {
            if ($value->nomeColonne == "Contingenza") {
                $return[$y] = $value;
                $y++;
            } else {
                $i++;
            }
        }
        return $return;
    } elseif ($cond == "Altre Indennità") {
        foreach ($obj as $value) {
            if ($value->nomeColonne == "Altre Indennità") {
                $return[$y] = $value;
                $y++;
            } else {
                $i++;
            }
        }
        return $return;
    } elseif ($cond == "Importo") {
        foreach ($obj as $value) {
            if ($value->nomeColonne == "Importo") {
                $return[$y] = $value;
                $y++;
            } else {
                $i++;
            }
        }
        return $return;
    }
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
            <textarea class=" form-control"
                row="3"><?php echo $ps; ?></textarea>
        </div>
        <br><br>
        <div class="btn-group">
            <input type="submit" class="btn btn-danger" value="Cancella" name="clear">
            <a href="../index.php" class="btn btn-info">Home</a>
        </div>
        <br><br>

        <?php
        if (isset($_GET["button1"])) {
            $sql = "SELECT id, livello, nomeColonne, importo FROM retribuzioni";
            $obj = $table = null;
            $i = 0;
            if ($stmt = $mysqli->query($sql)) {
                while ($obj = $stmt->fetch_object()) {
                    $table[$i] = $obj;
                    $i++;
                }
                $q = tableChecker($table, "Q");
                $minimo = tableChecker($table, "Minimo");
                $contingenza = tableChecker($table, "Contingenza");
                $ai = tableChecker($table, "Altre Indennità");
                $imp = tableChecker($table, "Importo"); ?>
        <div class="mx-auto" style="width: 30%">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Livello</th>
                        <th scope="col">Minimo</th>
                        <th scope="col">Contingenza</th>
                        <th scope="col">Altre Indennità</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Q</th>
                        <td><?php foreach ($q as $value) {
                    if ($value->nomeColonne == "Minimo") {
                        echo $value->importo;
                    }
                } ?>
                        </td>
                        <td><?php foreach ($q as $value) {
                    if ($value->nomeColonne == "Contingenza") {
                        echo $value->importo;
                    }
                } ?>
                        </td>
                        <td><?php foreach ($q as $value) {
                    if ($value->nomeColonne == "Altre Indennità") {
                        echo $value->importo;
                    }
                } ?>
                        </td>
                    </tr>
                    <?php for ($i = 1; $i < 8; $i++) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i?>
                        </th>
                        <td><?php foreach ($minimo as $value) {
                        if ($value->livello == $i) {
                            echo $value->importo;
                        }
                    }
                    echo "0"; ?>
                        </td>
                        <td><?php foreach ($contingenza as $value) {
                        if ($value->livello == $i) {
                            echo $value->importo;
                        }
                    } ?>
                        </td>
                        <td><?php foreach ($ai as $value) {
                        if ($value->livello == $i) {
                            echo $value->importo;
                            exit;
                        }
                    }
                    echo "0"; ?>
                        </td>
                    </tr>
                    <?php
                } ?>
        </div>
        <?php
            }
        }?>

</body>

</html>