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
}
if(!isset($_SESSION['user_role'])){
header("location:../php/login.php?permission=non");
} else if ($_SESSION['user_role'] != 1) {
header("location:../php/login.php?permission=pasProf");
echo $_SESSION['user_nom'];
}
   ?>
   <script>
//un alert pour qu'on savoir notre data a bien enregistrer
   $(function () {
  $('#form').on('submit', function (event) {
  event.preventDefault();
  $.ajax({
  type: 'post',
  url: '../php/ajouter_theme.php',
  data: $(this).serialize(),
  success: function () {
  alert('votre theme a bien crée!');
  $('#form')[0].reset();
  }
  });
  });
  });
   </script>
   <title>Ajouter un theme</title>

</head>
<body>

  <img src="../css/iut" width="100%" width="100%"></img>
  <div id='cssmenu'>
        <ul>
         <li><a href='deposer_une_question.php'>Déposer une question</a></li>
           <li ><a href='modifier_question.php'>modifier une question</a></li>
           <li class='active'><a href='ajouter_theme.php'>Ajouter un thème</a></li>
           <li><a href='construir_qcm.php'>Construire un QCM </a></li>
           <li><a href='recherche_question.php'>Rechercher des questions</a></li>
          <li><a href='publier_qcm.php'>Publier un QCM </a></li>
  </ul>
  </div>
  <table>
    <td class="active"><br>
  <a href='../php/logout.php'>Deconnextion</a></td>
  <td ><?php echo $_SESSION['user_nom']; ?></td>
  </table>



          <div id="frm">
          <form id="form">
                  <p>
                    <label>theme:</label>
                    <input type="text" id="user" name="theme" />
                </p>
                <p>
                    <input type="submit" id="btn" value="valider" />
                </p>

          </form></div>
</body>
<html>
