<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $pub = $_GET['publier'];
  $sql = "UPDATE qcms SET publierResult=$pub WHERE id=$id";
  if ($link->query($sql) === TRUE) {
    if ($pub == 1)
      $_SESSION['message'] = "Le resultat a été publiée avec succès";
    else
      $_SESSION['message'] = "La publication a été annulée avec succès";
    header('location: ../prof/publier_qcm.php');
  } else {
    $_SESSION['message'] = "Query Error";
    header('location: ../prof/publier_qcm.php');
  }
}


?>
