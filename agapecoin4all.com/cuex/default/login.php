<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['pws'])  ) {
    $records = $conn->prepare('SELECT id, email, pws FROM users WHERE email = :email and pws = :pws');
    $records->bindParam(':email', $_POST['email']);
    $records->bindParam(':pws', $_POST['pws']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
   
    if(!isset($_SESSION['user_id']))
    {
    if($results > 0)
    {
      $_SESSION['user_id']=$nombre;
      
      header("Location: login/index.html");
      
    }
    else if ($results == 0)
    {
      echo "<script>alert('Usuario no existe');window.location= 'login.php' </script>";
    }
    }
  }


?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

  <body>
    <?php require 'partials/header.php' ?>

 

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="pws" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>