<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/menu.css">
   <link rel="stylesheet" href="../css/modifier.css">

   <?php include('../php/ajouter_qcm.php'); ?>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
if(!isset($_SESSION['nom_de_qcm'])){
header("location:qcm.php");
} else {
$results = $link->query("SELECT * FROM formqcm WHERE nom ='" . $_SESSION['nom_de_qcm'] . "' ORDER BY RAND()");
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
    <li class='active'><a href='qcm.php'>le QCM </a></li>


  </ul>
  </div>

  <form action="../php/culculerNote.php" method="POST">
<input type="hidden" name="nbQuestions" value="<?php echo $results->num_rows; ?>">
<ul>
<?php
$i = 1;
while ($row = mysqli_fetch_array($results)) {
$query = "SELECT * FROM question WHERE id ='" . $row['questionid'] . "' ORDER BY RAND()";
$result = $link->query($query);
while ($qRow = mysqli_fetch_array($result)) {
echo "<li style='list-style-type: none;'>";
echo "<p style='font-size: 18pt;'>".$i."- ".$qRow['sujet_qcm']."</p>";
echo "<ul><li style='list-style-type: none;'>";
if ($qRow['reponse_1'] + $qRow['reponse_2'] + $qRow['reponse_3'] + $qRow['reponse_4'] == 1 ) {
echo "<div>
<input type='checkbox' class='group".$i."' name='".$qRow['id']."&1' value='1' />
<label class='fontSize16'>".$qRow['choixA']."</label>
</div>";
echo "<div>
<input type='checkbox' class='group".$i."' name='".$qRow['id']."&2' value='1' />
<label class='fontSize16'>".$qRow['choixB']."</label>
</div>";
echo "<div>
<input type='checkbox' class='group".$i."' name='".$qRow['id']."&3' value='1' />
<label class='fontSize16'>".$qRow['choixC']."</label>
</div>";
echo "<div>
<input type='checkbox' class='group".$i."' name='".$qRow['id']."&4' value='1' />
<label class='fontSize16'>".$qRow['choixD']."</label>
</div>";
?>
<script type="text/javascript">
$('.group<?php echo $i; ?>').on('change', function() {
$('.group<?php echo $i; ?>').not(this).prop('checked', false);
});
</script>
<?php
} else {
echo "<div>
<input type='checkbox' id='group".$i."' class='group".$i."' name='".$qRow['id']."&1' value='1' />
<label class='fontSize16'>".$qRow['choixA']."</label>
</div>";
echo "<div>
<input type='checkbox' id='group".$i."' class='group".$i."' name='".$qRow['id']."&2' value='1' />
<label class='fontSize16'>".$qRow['choixB']."</label>
</div>";
echo "<div>
<input type='checkbox' id='group".$i."' class='group".$i."' name='".$qRow['id']."&3' value='1' />
<label class='fontSize16'>".$qRow['choixC']."</label>
</div>";
echo "<div>
<input type='checkbox' id='group".$i."' class='group".$i."' name='".$qRow['id']."&4' value='1' />
<label class='fontSize16'>".$qRow['choixD']."</label>
</div>";

?>
<script>
$("input[type='checkbox']").change(function () {
var n = $("input:checkbox:checked.group<?php echo $i; ?>").length;
if (n > 2) {
alert('Vous ne pouvez pas sélectionner plus de deux réponses');
$(this).prop('checked', false);
}
});
</script>

<?php
}
echo "</ul></li><br>";
if ($qRow['commentair'] != '') {
echo "<div><label style='color: #1ca2ce;'>Commentaire du professeur : ".$qRow['commentair']."</label></div>";
}
echo "</li><br>";
if ($i < $results->num_rows ) {
echo "----------------------------------------------------------------------------------------------------------------------------------------------";
}
$i++;
}
}
?>

<button " type="submit" name="submitQCM" style="background: ;" value=">">Valider</button>
<p>** Attention vous ne pouvez pas returnez sur les quistion pour corriger votre quistion</p>
</form>
</body>
<html>
