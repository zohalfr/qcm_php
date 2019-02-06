<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" href="../css/lgn.css">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
 session_start();
 }

?>
  </head>
  <body>

<div class ="box">
  <h2>login</h2>


  <form action="../php/login.php" method="POST">
    <div class="inputBox">
      <input type="text" name="username" required="">
      <label>Username</label>
    </div>
    <div class="inputBox">
      <input type="text" name="mdp" required="">
      <label>password</label>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
    <div style="color: red;">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <input type="submit" name="login" value="submit">
  </form>
</div>
  </body>
</html>
