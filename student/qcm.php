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
   <script src="script.js"></script>
   <title>Publier un QCM</title>
   <?php
   if (session_status() == PHP_SESSION_NONE) {
   session_start();
   }
   if(!isset($_SESSION['user_role'])){
header("location:../php/login.php?permission=non");
} else if ($_SESSION['user_role'] != 2) {
header("location:../php/login.php?permission=pasEtu");
}
?>

</head>
<body>

  <img src="../css/iut" width="100%" width="100%"></img>
  <table>
    <td class="active"><br>
 <a href='../php/logout.php'>Deconnextion</a></td>
 <td ><?php echo $_SESSION['user_nom']; ?></td>
</table>
  <div id='cssmenu'>
  <ul>
    <li class='active'><a href='qcm.php'>les QCM </a></li>



  </ul>
  </div>

  <form action="../php/etudiant.php" method="POST">

  <?php
  $results = $link->query("SELECT * FROM qcms WHERE PUB = 1");
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
      <th>les notes</th>
     <th colspan="2">Action</th>
   </tr>
  </thead>

  <?php while ($row = mysqli_fetch_array($results)) { ?>
   <tr>
     <td><?php echo $row['nom_de_qcm']; ?></td>
     <td><?php echo $row['date_de_debut']; ?></td>
     <td><?php echo $row['date_fini']; ?></td>
      <td>
        <?php

            $sql = "SELECT * FROM result WHERE qcm ='".$row['nom_de_qcm']."' AND nomEtudiant='".$_SESSION['user_nom']."'";
$result = $link->query($sql);
if ($row['publierResult'] == 1) {
if ($result->num_rows > 0) {
$rrow = mysqli_fetch_array($result);
echo $rrow['note']." / ".$row['nombreQuestion'];
} else {
echo "Vous ne l'avez pas fait";
}
} else {
echo "Pas encore publié";
}
         ?>
       </td>
     <td>
       <?php
       if ($result->num_rows > 0) {
        ?>
        <button type="submit" name="deactif" disabled value="<?php echo $row['id']; ?>">vous avez déjà passé le test</button>
        <?php
      }
      else {
       $date_1=date('Y/m/d');
       $date_2=$row['date_fini'];

       if (strtotime($date_1) < strtotime($date_2) || strtotime($date_1) == strtotime($date_2)) {
       ?>
       <button " type="submit" name="nom_de_qcm" style="background: #556B2F;" value="<?php echo $row['nom_de_qcm']; ?>">Commencer</button>
     <?php } else { ?>
       <button type="submit" name="deactif" disabled value="<?php echo $row['id']; ?>">Trop Tard</button>
     <?php } } ?>
     </td>
   </tr>
  <?php } ?>
  </table>
  </form>


</body>
<html>
