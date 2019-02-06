<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}

require_once "connect_db.php";
if (isset($_GET['Ajouter'])) {
$id = addslashes($_GET['Ajouter']);
$nomDeQCM = addslashes($_GET['nomDeQCM']);
$sql_1 = "INSERT INTO formqcm VALUES (NULL, '$nomDeQCM', $id)";
$sql_2 = "UPDATE qcms SET nombreQuestion = (SELECT COUNT(*) FROM formqcm WHERE nom='$nomDeQCM') WHERE nom_de_qcm='$nomDeQCM'";
if ($link->query($sql_1) === TRUE && $link->query($sql_2) === TRUE) {
$_SESSION['message'] = "Le question a été sauvegardée avec succès dans Le QCM $nomDeQCM";
header('location: ../prof/ajoutqcm.php?nomDeQCM='.$nomDeQCM);
} else {
$_SESSION['message'] = "Query Error";
}
}
if (isset($_GET['Delete'])) {
$id = addslashes($_GET['Delete']);
$nomDeQCM = addslashes($_GET['nomDeQCM']);
$sql_1 = "DELETE FROM formqcm WHERE nom='$nomDeQCM' AND questionid=$id";
$sql_2 = "UPDATE qcms SET nombreQuestion = (SELECT COUNT(*) FROM formqcm WHERE nom='$nomDeQCM') WHERE nom_de_qcm='$nomDeQCM'";
if ($link->query($sql_1) === TRUE && $link->query($sql_2) === TRUE) {
$_SESSION['message'] = "Le question a été supprimer avec succès dans Le QCM $nomDeQCM";
header('location: ../prof/ajoutqcm.php?nomDeQCM='.$nomDeQCM);
} else {
$_SESSION['message'] = "Query Error";
}
}
?>
