<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
// si la variable de session n'existe pas
if (!isset($_SESSION['loginRole'])) {
  $_SESSION['loginRole'] = 0;
}

//connect to server and select Database
$mysqli = new mysqli("localhost", "root", "", "qcm");
if($mysqli->connect_error) {
  die("PBM connexion : " . $mysqli->connect_error);
}

// est-ce qu'on doit faire l'action de vérifier le login
if (isset($_POST['action']) && $_POST['action']==="checkLogin") {
  $username = $_POST['username'];
  $password = $_POST['password'];
/*
  $username = stripcslashes($username);
  $password = stripcslashes($password);
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);
*/
  // requet sql
  $sql = "SELECT id, role FROM user WHERE username='" . $username . "' AND  password='" . $password . "'";

  // envoyer la requete
  $result = $mysqli->query($sql);

  // majuscule = constante
  $row = $result->fetch_array(MYSQLI_ASSOC);

  $tablo = [];
  $tablo['id'] = $row['id'];
  $tablo['role'] = $row['role'];

  // on mémorise le role de la personne logué
  $_SESSION['loginRole'] = $row['role'];

  echo json_encode($tablo);

}
?>
