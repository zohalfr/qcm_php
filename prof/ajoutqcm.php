<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/menu.css">
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

    <?php include('../php/ajouter_qcm.php');
if(isset($_GET['nomDeQCM'])){
  $nomDeQCM = $_GET['nomDeQCM'];
}else{
  $nomDeQCM = "";
}

 ?>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="script.js"></script>

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



    <?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <form action="../php/ajouterquestion.php" method="get">
      <input type="hidden" name="nomDeQCM" value="<?php echo $nomDeQCM; ?>">

    <?php
      $results = $link->query("SELECT * FROM question");

    ?>

    <table>

    		<tr>
          <th>theme</th>
    			<th>Question</th>
    			<th>choix A</th>
          <th>choix B</th>
          <th>choix C</th>
          <th>choix D</th>
          <th>commentaire</th>
    			<th colspan="2">Action</th>
    		</tr>


    	<?php while ($row = mysqli_fetch_array($results)) { ?>
    		<tr>
          <td><?php echo $row['theme']; ?></td>
    			<td><?php echo $row['sujet_qcm']; ?></td>
    			<td><?php echo $row['choixA']; ?></td>
          <td><?php echo $row['choixB']; ?></td>
          <td><?php echo $row['choixC']; ?></td>
          <td><?php echo $row['choixD']; ?></td>

          <td><?php echo $row['commentair']; ?></td>
    			<td colspan="2">
            <?php
$va = $row['id'];
$query = "SELECT * FROM formqcm WHERE nom='".$nomDeQCM."' AND questionid=".$va."";
$result = $link->query($query);
if ($result->num_rows > 0):
?>
<button " type="submit" name="Delete" style="background: #556B2F;" value="<?php echo $row['id']; ?>">Delete</button>
<?php else: ?>
<button type="submit" name="Ajouter" value="<?php echo $row['id']; ?>">Ajouter</button>
<?php endif ?>
    			</td>
    		</tr>
    	<?php } ?>
    </table>
    </form>



  </body>
</html>
