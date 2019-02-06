<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once "connect_db.php";

if (isset($_POST['submitQCM'])) {
  $nom = $_SESSION['user_nom'];
  $qcm = $_SESSION['nom_de_qcm'];
  $sql = "SELECT * FROM formqcm WHERE nom ='$qcm'";
  $results = $link->query($sql);
  $note = 0.0;
  while ($row = mysqli_fetch_array($results)) {
    $query  = "SELECT * FROM question WHERE id =".$row['questionid'];
    $result = $link->query($query);
    while ($qRow = mysqli_fetch_array($result)) {
      $id = $qRow['id'];
      $n = 1.0;
      if ($qRow['reponse_1'] + $qRow['reponse_2'] + $qRow['reponse_3'] + $qRow['reponse_4'] > 1)
        $n = 0.5;
      if (isset($_POST[$id.'&1']))
        if ($qRow['reponse_1'] == 1 )
          $note+=$n;
      if (isset($_POST[$id.'&2']))
        if ($qRow['reponse_2'] == 1 )
          $note+=$n;
      if (isset($_POST[$id.'&3']))
        if ($qRow['reponse_3'] == 1 )
          $note+=$n;
      if (isset($_POST[$id.'&4']))
        if ($qRow['reponse_4'] == 1 )
          $note+=$n;
    }
  }
  $sql = "INSERT INTO result VALUES (NULL, '$qcm', '$nom', $note)";
  if ($link->query($sql) === TRUE) {
      $_SESSION['message'] = "Vos réponses ont été soumises avec succès";
      unset($_SESSION['$_SESSION']);
      header('location: ../student/qcm.php#L1');
  } else {
      $_SESSION['message'] = "Query Error";
      header('location: ../student/qcm.php#L1');
  }
}
?>
