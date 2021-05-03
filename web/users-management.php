<?php
require_once __DIR__ . '/../config.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("location: index.php");
  exit;
}

$errors = [];

if ($_POST['action'] == 'Add') {

  $email = $_POST['email'];
  $passw = $_POST['passw'];
  $username = $_POST['username'];
  $mod_vis = $_POST['mod_vis'];

  // Controlla che i campi non siano vuoti
  if (empty($email)) {
    array_push($errors, "Email richiesta");
  }
  if (empty($passw)) {
    array_push($errors, "Password richiesta");
  }
  if (empty($username)) {
    array_push($errors, "Username richiesto");
  }
  if (empty($mod_vis)) {
    array_push($errors, "Permesso richiesto");
  }

  // Setta il role a admin o viewer
  if (stripos($mod_vis, "Modificare") || stripos($mod_vis, "Visualizzare")) {
    array_push($errors, "Inserisci 'Modificare' o 'Visualizzare'");
  }

  $role = "viewer";
  if ($mod_vis == "Modificare") {
    $role = "admin";
  }


  // Controlla la sicurezza della password inserita
  if (strlen($passw) < 8) {
    array_push($errors, "Inserisci almeno 8 caratteri");
  }
  if (!preg_match("#[0-9]+#", $passw)) {
    array_push($errors, "Inserisci almeno un numero");
  }
  if (!preg_match("#[a-z]+#", $passw)) {
    array_push($errors, "Inserisci almeno una lettera in minuscolo");
  }
  if (!preg_match("#[A-Z]+#", $passw)) {
    array_push($errors, "Inserisci almeno una lettera in maiscuolo");
  }
  if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $passw)) {
    array_push($errors, "Inserisci almeno un carattere speciale");
  }

  // Select della email
  $email_check_query = $db->users->findOne(['_id' => $email]);
  if (!is_null($email_check_query)) {
    array_push($errors, "Email già esistente");
  }
  //crypt della passw e inerimento del db  (a sentimeto)
  else if (count($errors) == 0) { {
      //crypt passw
      $passw = password_hash($passw, PASSWORD_ARGON2I);
      $db->users->insertOne([

        '_id' => $email,
        'role' => $role,
        'displayName' => $username,
        'password' => $passw

      ]);
      echo "Aggiunto";
    }
  }
}

if ($_POST['action'] == 'Del') {
  $email = $_POST['email'];

  $email_check_query = $db->users->findOne(['_id' => $email]);
  if (is_null($email_check_query)) {
    array_push($errors, "Email non esistente nel database");
  } else if (count($errors) == 0) { {
      $db->users->deleteOne(['_id' => $email]);
      echo "Eliminato";
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add-Del | ANCL Verona</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/tabella.css">
  <link rel="stylesheet" href="css/users.css">
</head>

<body>

  <div class="sfondo" style="width: 80%; align-items: center;">
    <div>
      <h1>Gestione utenti</h1>
    </div>
    <form method="post" action="">
      <div>

        <div style="padding: 10px">
          <input type="text" class="form-control" placeholder="Emai" name="email"> <br>
        </div>

        <div style="padding: 10px">
          <input type="text" class="form-control" placeholder="Password" name="passw"> <br>
        </div>

        <div style="padding: 10px">
          <input type="text" class="form-control" placeholder="Username" name="username"> <br>
        </div>

        <div style="padding: 10px">
          <input type="text" class="form-control" placeholder="Modificare/Visualizzare" name="mod_vis"> <br>
        </div>

        <div style="padding: 10px">
          <button type="submit" class="btn btn-success" name="action" value="Add"> Aggiungi </button>
          <button type="submit" class="btn btn-success" name="action" value="Del"> Elimina </button>
        </div>
      </div>
    </form>
    <?php
    if (count($errors) > 0) {
      foreach ($errors as $err) {
        echo "<p>" . $err . "</p>";
      }
    }
    ?>
</body>

</html>