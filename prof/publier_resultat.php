<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/modifier.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <?php
   if (session_status() == PHP_SESSION_NONE) {
session_start();
}
require_once "../php/connect_db.php";
if(!isset($_SESSION['user_role'])){
header("location:../php/login.php?permission=non");
} else if ($_SESSION['user_role'] != 1) {
header("location:../php/login.php?permission=pasProf");
echo $_SESSION['user_nom'];
}
?>
   <title>publier les resultat des etudiants </title>

</head>
<body>

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
  <table>
    <td class="active"><br>
 <a href='../php/logout.php'>Deconnextion</a></td>
 <td ><?php echo $_SESSION['user_nom']; ?></td>
</table>


  <a name="L1">
  <form action="#" method="">
  <div>
  <label>
  Le nom du QCM : <?php echo $_GET['nomDeQCM']; ?>
  </label>
  </div>
  <?php if ($_GET['pub'] == 1) { ?>
  <div>
  <label style="color: green;">
  Le résultat des étudiants a déjà publié</label>
  </div>
  <?php } ?>
  <table style="width=90%; height=50%">
    <thead>
     <tr>
       <th>le nom de l'etidiant</th>
       <th>la Note</th>
     </tr>
    </thead>

</tr>

  <?php
  $results = $link->query("SELECT * FROM user WHERE role=2");
  while ($row = mysqli_fetch_array($results)) {
    ?>
  <tr><td><?php echo $row['username']; ?></td><td>
  <?php
  $result = $link->query("SELECT * FROM result WHERE qcm ='".$_GET['nomDeQCM']."' AND nomEtudiant ='".$row['username']."'");
  $row = mysqli_fetch_array($result);
  if ($result->num_rows > 0) {
  echo $row['note'];
  } else {
  echo "Il/Elle ne l'a pas fait";
  }
  ?>
  </td></tr><?php } ?>
</table>
  <div>
  <?php if ($_GET['pub'] == 1): ?>
  <a class="btn" href="../php/publierleresult.php?id=<?php echo $_GET['id']; ?>&publier=0" >Annuler la publication</a>
  <?php else: ?>
  <a class="btn" href="../php/publierleresult.php?id=<?php echo $_GET['id']; ?>&publier=1" >Publier le résultat des étudiants</a>
  <?php endif ?>
  </div>
  </form>
  </a>

</body>
<html>
