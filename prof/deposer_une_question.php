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
    <script>
   //on a creée un alert en ajax pour qu'on a enrenregistrer les données sur db
//    $(function () {
// $('#question').on('submit', function (event) {
//   //un methode pour enregistrer ou remplir tout les chembre
// if($('.c1:checked').val()==1|| $('.c2:checked').val()==1|| $('.c3:checked').val()==1|| $('.c4:checked').val()==1 ){
// event.preventDefault();
// $.ajax({
// type: 'post',
// url: '../php/ajouter_question.php',
// data: $(this).serialize(),
// success: function () {
// alert('votre formulaire a bien enregistrer!');
// $('#question')[0].reset();
// }
// });
// }else {
//   alert('vous devez remplir tout les cases!');
//   return false;
// }
// });
// });
// </script>
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

   <title>Déposer une question</title>

</head>
<body>
  <img src="../css/iut" width="100%" width="100%"></img>
  <div id='cssmenu'>
  <ul>
     <li class='active'><a href='deposer_une_question.php'>Déposer une question</a></li>
     <li><a href='modifier_question.php'>modifier une question</a></li>
     <li><a href='ajouter_theme.php'>Ajouter un thème</a></li>
     <li><a href='construir_qcm.php'>Construire un QCM </a></li>
     <li><a href='recherche_question.php'>Rechercher des questions</a></li>
     <li><a href='publier_qcm.php'>Publier un QCM </a></li>

  </ul></div>
  <table>
    <td class="active"><br>
  <a href='../php/logout.php'>Deconnextion</a></td>
  <td ><?php echo $_SESSION['user_nom'];  if(!isset($_SESSION['user_role'])){
  header("location:../php/login.php?permission=non");
} else if ($_SESSION['user_role'] != 1) {
  header("location:../php/login.php?permission=pasEtu");
  }
  ?></td>
  </table>
<form id="question" action="../php/modifier_question.php" method="POST" >
  <span>Choisir un theme</span><select name="select_theme">
<?php
require('../php/afficher_theme.php');?>
  </select>
    <br>
      <label for="">Question</label><input type="text" name="question" required="true">
      <label for="">choix A</label><input type="text" name="a" required="true" >
      <label for="">choix B</label><input type="text" name="b" required="true">
      <label for="">choix C</label><input type="text" name="c" required="true">
      <label for="">choix D</label><input type="text" name="d" required="true">
      </div>
      <div>
      <label for="">A</label><input type="checkbox" name="R_a" class="c1" value="1" >
      <label for="">B</label><input type="checkbox" name="R_b" class="c2" value="1" >
      <label for="">C</label><input type="checkbox" name="R_c" class="c3" value="1">
      <label for="">D</label><input type="checkbox" name="R_d" class="c4" value="1">
</div><br>
<label for="">commentaire</label>
  <input type="textarea" name="commentaire">
  <input type="submit" name="save" value="valider">
</form>
</body>
<html>
