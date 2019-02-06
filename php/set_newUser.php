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

  // INSERT INTO `user` (`id`, `username`, `password`, `mail`, `role`) VALUES (NULL, 'aaa', 'bbb', 'ccc@ccc', '1');
  $sql = "SELECT id, role FROM user WHERE username='" . $username . "' AND  password='" . $password . "'";

  // envoyer la requete
  $result = $mysqli->query($sql);

  // majuscule = constante
  $row = $result->fetch_array(MYSQLI_ASSOC);

  $tablo = [];
  $tablo['reponse'] = "Enregistrement ok";

  echo json_encode($tablo);

}
?>
