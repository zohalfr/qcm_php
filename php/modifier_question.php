<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
if (isset($_POST['save'])){
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

$nomP = $_SESSION['user_nom'];

$sql = "INSERT INTO question VALUES(NULL, '$question', '$choix_a', '$choix_b', '$choix_c', '$choix_d', $reponse_a, $reponse_b, $reponse_c, $reponse_d, '$commentair', '$theme','$nomP')";

if($link->query($sql) === True){
  $_SESSION['message'] = "Record save";
  header('location: ../prof/modifier_question.php');
}else{
  $_SESSION['message'] = "Query Error";
  header('location: ../prof/modifier_question.php');
}
}
/////////suprimer les question par id////////////
if (isset($_GET['del'])){
$id = $_GET['del'];
$sql = "DELETE FROM question WHERE id=$id";

if($link->query($sql) === True){
  $_SESSION['message'] = "record deleted";
  header('location: ../prof/modifier_question.php');
}else{
  $_SESSION['message'] = "Query Error.";
}
}
//update les question/////////////////////////
if (isset($_POST['update'])){
$id = $_POST['id'];
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

$sql = "UPDATE question SET sujet_qcm='$question', choixA='$choix_a', choixB='$choix_b', choixC='$choix_c',choixD='$choix_d', reponse_1=$reponse_a, reponse_2=$reponse_b,reponse_3=$reponse_c,reponse_4=$reponse_d,commentair='$commentair', theme='$theme' WHERE id=$id";

if($link->query($sql) === True){
  $_SESSION['message'] = "record update";
  header('location: ../prof/modifier_question.php');
}else{
  $_SESSION['message'] = "Query Error.";
}
}
 ?>
