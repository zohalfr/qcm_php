<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
$resultat =$link->query("select nom from theme");
while ($row = $resultat->fetch_assoc()) {
  // code...
  $my_column = $row["nom"];
    echo("<option name='$my_column' value='$my_column'>$my_column</option>");
}

 ?>
