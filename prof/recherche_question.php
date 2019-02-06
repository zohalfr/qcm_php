<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/styles.css">
   <link rel="stylesheet" href="../css/modifier.css">
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

   <title>Rechercher des questions</title>


   <!-- prendre the value -->
   <?php include('../php/modifier_question.php');
   if (isset($_GET['th1'])){
     $btnTheme = $_GET['th1'];
   }else{
     $btnTheme = 'tous';
   }
    ?>
    <!-- ////end// -->
</head>
<body>


  <div id='cssmenu'>
    <img src="../css/iut" width="100%" width="100%"></img>
  <ul>
     <li><a href='deposer_une_question.php'>Déposer une question</a></li>
     <li ><a href='modifier_question.php'>modifier une question</a></li>
     <li><a href='ajouter_theme.php'>Ajouter un thème</a></li>
     <li><a href='construir_qcm.php'>Construire un QCM </a></li>
     <li class='active'><a href='recherche_question.php'>Rechercher des questions</a></li>
     <li><a href='publier_qcm.php'>Publier un QCM </a></li>
  </ul>
  </div>
  <table>
    <td class="active"><br>
  <a href='../php/logout.php'>Deconnextion</a></td>
  <td ><?php echo $_SESSION['user_nom']; ?></td>
  </table>


<form action="recherche_question.php" method="get">
<span>Choisir un theme</span><select name="th1">
  <option name="tous" value="tous">tous les theme</option>
  <?php

  $resultat =$link->query("select nom from theme");
  while ($row = $resultat->fetch_assoc()) {
    $my_column = $row["nom"];
    echo("<option name='$my_column' value='$my_column'");
    if($btnTheme==$my_column) echo 'selected=selected';
    echo (">$my_column</option>");
  }
  ?>
</select>
<input type="submit" value="Recherche la question">
</form>

<!-- affichage the the question by theme -->
<?php
if($btnTheme=='tous'){
  $results = $link->query("SELECT * FROM question");
}else{
  $results = $link->query("SELECT * FROM question WHERE theme='$btnTheme'");
}

?>

<table>
	<thead>
		<tr>
      <th>theme</th>
			<th>Question</th>
			<th>choix A</th>
      <th>choix B</th>
      <th>choix C</th>
      <th>choix D</th>
      <th>commentaire</th>
      <th>prof</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>

	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
      <td><?php echo $row['theme']; ?></td>
			<td><?php echo $row['sujet_qcm']; ?></td>
			<td><?php echo $row['choixA']; ?></td>
      <td><?php echo $row['choixB']; ?></td>
      <td><?php echo $row['choixC']; ?></td>
      <td><?php echo $row['choixD']; ?></td>
      <td><?php echo $row['commentair']; ?></td>
      <td><?php echo $row['nomProf']; ?></td>
			<td>
				<a href="edite.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="../php/modifier_question.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

</body>
<html>
