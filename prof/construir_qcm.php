<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/styles.css">
   <link rel="stylesheet" href="../css/modifier.css">
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
         <?php include('../php/ajouter_qcm.php');  ?>

   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Construire un QCM</title>

</head>
<body>

  <div id='cssmenu'>
     <img src="../css/iut" width="100%" width="100%"></img>
          <ul>
          <li><a href='deposer_une_question.php'>Déposer une question</a></li>
          <li ><a href='modifier_question.php'>modifier une question</a></li>
          <li ><a href='ajouter_theme.php'>Ajouter un thème</a></li>
          <li class='active'><a href='construir_qcm.php'>Construire un QCM </a></li>
          <li><a href='recherche_question.php'>Rechercher des questions</a></li>
          <li><a href='publier_qcm.php'>Publier un QCM </a></li>
          </ul>
  </div>

  <table>
    <td class="active"><br>
  <a href='../php/logout.php'>Deconnextion</a></td>
  <td ><?php echo $_SESSION['user_nom']; ?></td>
  </table>


<form action="../php/ajouter_qcm.php" method="POST">

  <label>Nom de QCM</label><input type="text" name="nomDeQCM"><br>
  <!-- <label>Date de debut</label><input type="date" name="datedebut"><br>
  <label>Date de fini</label><input type="date" name="datefini"><br> -->

  <input type="submit" value="ajouter" name="ajouter"/>
</form>




</body>
<html>
