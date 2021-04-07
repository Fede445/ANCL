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

// TODO: implementare "documento non trovato"
echo $document["name"]
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
        <h2> TERZIARIO - CONFCOMMERCIO </h2>
        <h3> Vigente da gennaio 2021 </h3>
        <table class="minimalistBlack">
            <tbody>
                <thead>
                    <tr>
                        <th colspan="4"> Stipule </th>
                    </tr>
                </thead>
                <tr>
                    <td></td>
                    <td>Data di stipula</td>
                    <td>Decorrenza</td>
                    <td>Scadenza</td>
                </tr>
                <tr>
                    <td style="border-bottom:none">Accordo di rinnovo</td>
                    <td>30 marzo 2015</td>
                    <td>1° aprile 2015</td>
                    <td>31 luglio 2018<br><br></td>
                </tr>
                <tr>
                    <td style="border-top:none"> </td>
                    <td>Parti stipulanti</td>
                    <td colspan="2"> Confcommercio e Filcams-Cgil, Fisascat-Cisl, Uiltucs-Uil</td>

                </tr>
                <tr>
                    <td style="border-bottom:none">Accordo di rinnovo</td>
                    <td>26 febbraio 2011 <br> 6 aprile 2011</td>
                    <td>1° Gennaio 2011 <br> <br> </td>
                    <td>31 Dicemre 2013<br><br></td>
                </tr>
                <tr>
                    <td style="border-top:none"></td>
                    <td>Parti stipulanti</td>
                    <td colspan="2">Confcommercio e Fisascat-Cisl, Uiltucs-Uil</td>
                </tr>
                <tr>
                    <td style="border-bottom:none">CCNL</td>
                    <td>18 luglio 2008 <br> 28 luglio 2009</td>
                    <td>1° gennaio 2007</td>
                    <td>31 dicembre 2010</td>
                </tr>
                <tr>
                    <td style="border-top:none"></td>
                    <td>Parti stipulanti</td>
                    <td colspan="2">Confcommercio e Filcams-Cgil, Fisascat-Cisl, Uiltucs-Uil</td>
                </tr>
                <tr>
                    <td> Accordi territoriali</td>
                    <td></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
        <table class="minimalistBlack">
            <tbody>
                <thead>
                    <tr>
                        <th colspan="4"> Parametri </th>
                    </tr>
                </thead>
                <tr>
                    <td> Divisori contrattuali</td>
                    <td colspan="3"> Quota giornaliera 26; quota oraria 168 (personale a 40 ore settimanali), 182 (personale a 42 ore settimanali), 195 (personale a 45 ore settimanali). </td>
                </tr>
                <tr>
                    <td> Mensilità </td>
                    <td colspan="3" style="text-align:center"> 14 </td>
                </tr>
            </tbody>
        </table>




        <table class="minimalistBlack">
            <tbody>
                <thead>
                    <tr>
                        <th colspan="4"> Welfare </th>
                    </tr>
                </thead>
                <tr>
                    <td> Previdenza complementare</td>
                    <td colspan="3"> Contribuzione al fondo Fon.Te. (previdenza complementare per i lavoratori del settore): - a carico
                        azienda, 1,55% della retribuzione utile per il calcolo del tfr; - a carico lavoratore, 0,55% della stessa
                        base di computo, oltre al versamento dell’intero tfr maturato annualmente per coloro che hanno
                        iniziato l’attività lavorativa dopo il 28.4.1993 (50% del tfr maturato se l’attività è iniziata in
                        precedenza).<br>
                        Per i lavoratori assunti con contratto a tempo determinato di sostegno all’occupazione la
                        contribuzione a carico azienda è pari all’1,05%; tale contribuzione ridotta viene applicata anche in caso
                        di trasformazione a tempo indeterminato per i primi 24 mesi. </td>
                </tr>
                <tr>
                    <td> Assistenza integrative </td>
                    <td colspan="3"> Contribuzione al fondo Est di assistenza sanitaria: - a carico azienda: 10 euro/mese per ciascun
                        lavoratore, sia a tempo pieno che a tempo parziale (dal 1° gennaio 2014); - a carico lavoratore: 2
                        euro/mese (dal 1° gennaio 2012).<br>
                        Sono iscritti al Fondo i lavoratori assunti con contratto a tempo indeterminato, sia a tempo pieno che a
                        tempo parziale, compresi gli apprendisti ed esclusi i quadri. L’azienda che ometta il versamento dei
                        contributi è tenuta ad erogare un e.d.r. sostitutivo (vedi sopra Dati retributivi - Altre voci).<br>
                        Contribuzione alla cassa Qu.A.S. di assistenza sanitaria per i quadri: - a carico azienda: 350
                        euro/anno; - a carico lavoratore: 56 euro/anno. L’azienda che ometta il versamento dei contributi è
                        tenuta ad erogare un e.d.r. sostitutivo (vedi sopra Dati retributivi -Altre voci).</td>
                </tr>

                <tr>
                    <td> Enti bilaterali</td>
                    <td colspan="3"> Per il finanziamento degli enti bilaterali territoriali è stabilito un contributo in misura pari allo 0,15%
                        della paga base e dell’indennità di contingenza, di cui 0,05% a carico del lavoratore e 0,10% a carico
                        del datore di lavoro.<br>
                        L’azienda che ometta il versamento dei contributi è tenuta ad erogare un e.d.r. sostitutivo (vedi sopra
                        Dati retributivi - Altre voci). Contributo al Quadrifor (Istituto per lo sviluppo della formazione dei quadri
                        del terziario):<br>
                        - a carico azienda: 50 euro/anno
                        - a carico lavoratore: 25 euro/anno. </td>
                </tr>
                <tr>
                    <td> Polizze assicurative </td>
                    <td colspan="3"> Quadri. Hanno diritto ad una copertura in forma assicurativa per le spese e l’assistenza legale in caso di
                        procedimenti civili/penali per cause non dipendenti da colpa grave o dolo e relative a fatti direttamente
                        connessi con l’esercizio delle funzioni svolte.<br>
                        Operatori di vendita. A seguito di infortunio sul lavoro le aziende devono garantire la corresponsione,
                        aggiuntiva al trattamento Inail, dei seguenti importi: - euro 27.500 in caso di morte; - euro 37.500 in
                        caso di invalidità permanente totale.</td>
                </tr>

            </tbody>
        </table>
    </main>
</body>

</html>