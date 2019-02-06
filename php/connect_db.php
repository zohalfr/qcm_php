<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$link = mysqli_connect('localhost','root', '','qcm');
if($link === false){
  die("Error : vous ne pouvez pas connecter. " . mysqli_connect_error());
}
 ?>
