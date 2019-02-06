<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";

if (isset($_GET['actif'])) {
$id = addslashes($_GET['actif']);
$res = $link->query("SELECT * FROM qcms WHERE id=$id");
$row = mysqli_fetch_array($res);
$datedebut = $row['date_de_debut'];
$datefin = $row['date_fini'];
header('location: ../prof/publier_qcm0.php?id='.$id.'&d1='.$datedebut.'&d2='.$datefin);
}


if (isset($_GET['publier'])) {
$id = addslashes($_GET['IdQcm']);
$datedebut = addslashes($_GET['datedebut']);
$datefin = addslashes($_GET['datefini']);
$sql = "UPDATE qcms SET date_de_debut='$datedebut', date_fini='$datefin',  PUB=1 WHERE id=$id";
if ($link->query($sql) === TRUE) {
$_SESSION['message'] = "";
header('location: ../prof/publier_qcm.php');
} else {
$_SESSION['message'] = "Query Error";
}
}

if (isset($_GET['deactif'])) {
$id = addslashes($_GET['deactif']);
$sql = "UPDATE qcms SET PUB=0 WHERE id=$id";
if ($link->query($sql) === TRUE) {
$_SESSION['message'] = "";
header('location: ../prof/publier_qcm.php');
} else {
$_SESSION['message'] = "Query Error";
}
}
?>
