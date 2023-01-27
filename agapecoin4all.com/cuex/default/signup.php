<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['pws'])) {
    $sql = "INSERT INTO users (email, pws) VALUES (:email, :pws)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
   
    $stmt->bindParam(':pws', $_POST['pws']);

    if ($stmt->execute()) {
      echo "<script>alert('Successfully created new user');window.location= 'login.php' </script>";
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="pws" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
