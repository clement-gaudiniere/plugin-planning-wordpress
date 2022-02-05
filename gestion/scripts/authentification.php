<?php
  // Authentification
  if(isset($_GET['password']) and !empty($_GET['password'])){
    $password = htmlspecialchars($_GET['password']);

    if($password == 'k6AJ29vj4G[n]8Vm'){
      setcookie("auth", 'hgo842c1', time()+3600*24*30, '/', "localhost", 0);  /* expire dans 1 mois */
      echo "<script>alert(Authentification...);</script>";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      echo "<script>alert(Mauvais mot de passe);</script>";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

 ?>
