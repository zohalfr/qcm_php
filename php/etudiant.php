<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "connect_db.php";
if (isset($_POST['nom_de_qcm'])) {
$_SESSION['nom_de_qcm'] = $_POST['nom_de_qcm'];
$_SESSION['message'] = "Le QCM a démarré, Choisissez les bonnes réponses de les questions suivantes :";
header('location: ../student/afficherleqcm.php');
}

if (isset($_POST['submitQCM'])) {
unset($_SESSION['nom_de_qcm']);
}
?>
