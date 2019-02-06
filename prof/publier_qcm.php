<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/modifier.css">
   <?php include('../php/ajouter_qcm.php'); ?>

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
   <title>Publier un QCM</title>

</head>
<body>
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
        <li class='active'><a href='publier_qcm.php'>Publier un QCM </a></li>
    </ul>
    </div>
    <table>
      <td class="active"><br>
    <a href='../php/logout.php'>Deconnextion</a></td>
    <td ><?php echo $_SESSION['user_nom']; ?></td>
    </table>

  <form action="../php/publierLeQcm.php" method="get">

  <?php
  $results = $link->query("SELECT * FROM qcms");
  ?>
  <?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
  <?php
  echo $_SESSION['message'];
  unset($_SESSION['message']);
  ?>
  </div>
  <?php endif ?>
  <table>
  <thead>
   <tr>
     <th>Nom de QCM</th>
     <th>Date debut</th>
     <th>Date de fin</th>
     <th>PUB</th>
     <th>Action</th>
     <th style="90%">Result</th>
   </tr>
  </thead>

  <?php while ($row = mysqli_fetch_array($results)) { ?>
   <tr>
     <td><?php echo $row['nom_de_qcm']; ?></td>
     <td><?php echo $row['date_de_debut']; ?></td>
     <td><?php echo $row['date_fini']; ?></td>
     <td>
       <?php
        if ($row['PUB'] == 1)
          echo ("active");
        else
          echo ("nonactive");
       ?>
     </td>
     <td>
       <?php if ($row['PUB'] == 0):
       ?>
       <button " type="submit" name="actif" style="background: #556B2F;" value="<?php echo $row['id']; ?>">Active</button>
       <?php else: ?>
       <button type="submit" name="deactif" value="<?php echo $row['id']; ?>">disactive</button>
       <?php endif ?>
     </td>
     <td>
       <a class="" href="publier_resultat.php?id=<?php echo $row['id']; ?>&nomDeQCM=<?php echo $row['nom_de_qcm']; ?>&pub=<?php echo $row['publierResult']; ?>#L1">Consulter le résultat des étudiants</a>
     </td>
   </tr>
  <?php } ?>
  </table>
  </form>


</body>
<html>
