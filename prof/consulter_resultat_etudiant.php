<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <?php
   if (session_status() == PHP_SESSION_NONE) {
session_start();
}
if(!isset($_SESSION['user_role'])){
header("location:../php/login.php?permission=non");
} else if ($_SESSION['user_role'] != 1) {
header("location:../php/login.php?permission=pasProf");
echo $_SESSION['user_nom'];
}
?>
   <title>Consulter le resultat des etudiants</title>
   <img src="../css/iut" width="100%" width="100%"></img>
   <div id='cssmenu'>
   <ul>
      <li><a href='deposer_une_question.php'>Déposer une question</a></li>
      <li ><a href='modifier_question.php'>modifier une question</a></li>
      <li><a href='ajouter_theme.php'>Ajouter un thème</a></li>
      <li><a href='construir_qcm.php'>Construire un QCM </a></li>
      <li ><a href='recherche_question.php'>Rechercher des questions</a></li>
      <li ><a href='publier_qcm.php'>Publier un QCM </a></li>


   </ul>
   </div>
</head>
<body>


</body>
<html>
