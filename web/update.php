<?php

require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Recupero i valori inseriti nel form
$stip = $_POST['stip'];
$dataS = $_POST['dataS'];
$decor = $_POST['decor'];
$scade = $_POST['scade'];
$parti = $_POST['parti'];
$divi = $_POST['divi'];
$mens = $_POST['mens'];
$previ = $_POST['previ'];
$assi = $_POST['assi'];
$enti = $_POST['enti'];
$poli = $_POST['poli'];

$document = $db->tables->findOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])]);
$settore = $db->sectors->findOne(["_id" => $document["sector_id"]]);

/*
$table = $db->tables->replaceOne(
    [ '_id' => new MongoDB\BSON\ObjectId($_GET['id'])],
    [ 'sector_id' => $document["sector_id"]]    
);
*/

$table = $db->tables->insertOne([
    'sector_id' => $document["sector_id"],
    'valid_from' => new MongoDB\BSON\UTCDateTime(),
    'stipule' => [ 
        array(
            'name' => $stip,
            'dataStipula' => $dataS,
            'decorrenza' => $decor,
            'scadenza' => $scade,
            'parti' => $parti
        )
        ],
        'parametri' => [ 
                'divisori' => $divi,
                'mensilita' => $mens
        ],
        'welfare' => [ 
                'previdenza' => $previ,
                'assistenza' => $assi,
                'enti' => $enti,
                'polizze' => $poli
        ]
]);

$db->tables->deleteOne(["_id" => new MongoDB\BSON\ObjectId($_GET["id"])]);

header("location: index.php");

?>