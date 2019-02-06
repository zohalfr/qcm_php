<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
$question = $_POST['question'];
$choix_a = $_POST['a'];
$choix_b = $_POST['b'];
$choix_c = $_POST['c'];
$choix_d = $_POST['d'];

$commentair = $_POST['commentaire'];
$theme = $_POST['select_theme'];

if(isset($_POST['R_a'])){
  $reponse_a = 1;
}else{
  $reponse_a = 0;
}

if(isset($_POST['R_b'])){
  $reponse_b = 1;
}else{
  $reponse_b = 0;
}

if(isset($_POST['R_c'])){
  $reponse_c = 1;
}else{
  $reponse_c = 0;
}

if(isset($_POST['R_d'])){
  $reponse_d = 1;
}else{
  $reponse_d = 0;
}
$nomProf = $_SESSION['user_nom'];

$sql = "INSERT INTO question VALUES(NULL, '$question', '$choix_a', '$choix_b', '$choix_c', '$choix_d', $reponse_a, $reponse_b, $reponse_c, $reponse_d, '$commentair', '$theme','$nomProf'";
if($link->query($sql) === True){
  printf("data insert.\n");
}else{
  printf("Query Error.\n");
}
 ?>
