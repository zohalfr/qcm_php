<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
$th = $_POST['theme'];

$sql = "INSERT INTO theme VALUES('$th')";

if($link->query($sql) === True){
  printf("data insert.\n");
}else{
  printf("Query Error.\n");
}
 ?>
