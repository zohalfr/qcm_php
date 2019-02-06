<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
if (isset($_POST['ajouter'])){
$question = $_POST['nomDeQCM'];


$sql = "INSERT INTO qcms (id, nom_de_qcm) VALUES(NULL, '$question')";

if($link->query($sql) === True){
  $_SESSION['message'] = "Record save";
  header('location: ../prof/ajoutqcm.php?nomDeQCM='.$question);
}else{
  $_SESSION['message'] = "Query Error";
}
}
?>
