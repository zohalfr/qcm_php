<?php
session_start();
include("connect_db.php");

if (isset($_SESSION['user_role'])) {
  if ($_SESSION['user_role'] == 1) {
    header("location:../prof/deposer_une_question.php");
  } else if ($_SESSION["user_role"] == 2){
    header("location:../student/qcm.php");
  }
}

if (isset($_GET["permission"])) {
  if ($_GET["permission"] == "non") {
    $_SESSION['message'] = "Vous devez écrit votre identifié et le mot de passe si vous êtes professeurs <br>** contactez à votre service";
    header("location:../prof/index.php");
  } else if ($_GET["permission"] == "pasProf"){
    $_SESSION['message'] = "Vous devez écrit votre identifié et le mot de passe si vous ête professeurs <br>** contactez à votre service";
    header("location:../prof/index.php");
  } else if ($_GET["permission"] == "pasEtu"){
    $_SESSION['message'] = "Les professeurs n'ont pas accéder à cette page <br>** Veuillez vous connecter en tant que étudiant pour accéder à cette page";
    header("location:../prof/index.php");
  }
}

if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["mdp"])) {
        $_SESSION['message'] = "Les deux champs sont obligatoires";
        header("location:../prof/index.php");
    } else {
        $f = true;
        $user   = addslashes($_POST["username"]);
        $pass   = addslashes($_POST["mdp"]);
        $query  = "SELECT * FROM user WHERE username ='" . $user . "'";
        $result = $link->query($query);
        if ($result->num_rows > 0) {
            foreach ($result as $row) {
                if ($pass == addslashes($row["password"])) {
                    $f = false;
                    $_SESSION['logged'] = true;
                    $_SESSION['user_nom'] = $row["username"];
                    $_SESSION['user_role'] = $row["role"];
                    if ($_SESSION['user_role'] == 1) {
                      header("location:../prof/deposer_une_question.php");
                    } else if ($_SESSION['user_role'] == 2) {
                      header("location:../student/qcm.php");
                    }
                }
            }
        }
        if ($f) {
          $_SESSION['message'] = "mauvais nom d'utilisateur ou mot de passe";
            header("location:../prof/index.php");
        }
    }
}
?>
