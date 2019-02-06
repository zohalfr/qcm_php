<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/modifier.css">
    <link rel="stylesheet" href="../css/menu.css">
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
    <img src="../css/iut" width="100%" width="100%"></img>
    <div id='cssmenu'>
    <ul>
       <li><a href='deposer_une_question.php'>Déposer une question</a></li>
       <li class='active'><a href='modifier_question.php'>modifier une question</a></li>
       <li><a href='ajouter_theme.php'>Ajouter un thème</a></li>
       <li><a href='construir_qcm.php'>Construire un QCM </a></li>
       <li><a href='recherche_question.php'>Rechercher des questions</a></li>
       <li><a href='publier_qcm.php'>Publier un QCM </a></li>


    </ul>
    </div>

    <?php include('../php/modifier_question.php');
 if (isset($_GET['edit'])) {
 $id = $_GET['edit'];
 $update = true;
 $record = $link->query("SELECT * FROM question WHERE id=$id");
 $row = mysqli_fetch_array($record);
 $question = $row['sujet_qcm'];
 $choixA = $row['choixA'];
 $choixB = $row['choixB'];
 $choixC = $row['choixC'];
 $choixD = $row['choixD'];
 $ch1 = $row['reponse_1'];
 $ch2 = $row['reponse_2'];
 $ch3 = $row['reponse_3'];
 $ch4 = $row['reponse_4'];
 $theme = $row['theme'];
 $commentaire = $row['commentair'];
 } else {
 $theme = '';
 $id = $question = $choixA = $choixB = $choixC = $choixD = $theme = $commentaire = '';
 $ch1 = $ch2 = $ch3 = $ch4 = 0;
 $update = false;
 }
 ?>
    <title></title>

  </head>
  <body>

    <form action="..\php\modifier_question.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <span>Choisir un theme</span><select name="select_theme">

        <?php
        $result = $link->query("select nom from theme");
        while ($row = $result->fetch_assoc()) {
        $my_column = $row["nom"];
        echo("<option name='$my_column' value='$my_column'");
        if($theme==$my_column) echo 'selected=selected';
        echo(">$my_column</option>");
        }
        ?>
      </select>

        <br>
        <div class="input-group">  <label for="">Question</label><input type="text" name="question" required="true" value="<?php echo $question; ?>"></div>
        <div class="input-group"><label for="">choix A</label><input type="text" name="a" required="true" value="<?php echo $choixA; ?>"></div>
        <div class="input-group"><label for="">choix B</label><input type="text" name="b" required="true" value="<?php echo $choixB; ?>"></div>
        <div class="input-group"><label for="">choix C</label><input type="text" name="c" required="true" value="<?php echo $choixC; ?>"></div>
        <div class="input-group"><label for="">choix D</label><input type="text" name="d" required="true" value="<?php echo $choixD; ?>"></div>
        <div class="input-group">

          <label for="">A</label><input type="checkbox" name="R_a" class="c1" value="1"<?php if ($ch1 == 1) echo "checked='checked'"; ?>>
          <label for="">B</label><input type="checkbox" name="R_b" class="c2" value="1"<?php if ($ch2 == 1) echo "checked='checked'"; ?>>
          <label for="">C</label><input type="checkbox" name="R_c" class="c3" value="1"<?php if ($ch4 == 1) echo "checked='checked'"; ?>>
          <label for="">D</label><input type="checkbox" name="R_d" class="c4" value="1"<?php if ($ch3 == 1) echo "checked='checked'"; ?>>
          </div>
        </div class="input-group"><label for="">commentaire</label>
          <input type="textarea" name="commentaire" value="<?php echo $commentaire; ?>"></div>
          <div class="input-group">
            <?php if($update == true): ?>
              <button class="btn" type="submit" name="update" style="background, #55682F;">update</button>
            <?php else: ?>
            <button class="btn" type="submit" name="save">save</button>
            <?php endif ?>
          </div>

    </form>

  </body>
</html>
