<?php
  // Authentification
  if(isset($_GET['submitPassword']) and !empty($_GET['submitPassword'])){
    $password = htmlspecialchars($_GET['submitPassword']);

    if($password == 'k6AJ29vj4G[n]8Vm'){
      setcookie("auth", 'hgo842c1', time()+3600*24*30);  /* expire dans 1 mois */
      echo "Authentification...";
    } else {
      echo "Mauvais mot de passe";
    }
  }

 ?>
