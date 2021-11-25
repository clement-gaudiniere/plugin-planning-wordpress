<?php
  // Fichier de mise à jour des valeurs des tableaux
  if(isset($_GET['msj']) AND $_GET['msj'] == true){
    if(isset($_GET['idTable']) AND !empty($_GET['idTable'])){
      if(isset($_GET['title']) AND !empty($_GET['title'])){

        $titre = htmlspecialchars($_GET['title']);

        echo $titre;

      } else {
        $error = "Le tableau doit avoir un titre.";
      }
    } else {
      $error = "Le tableau doit avoir un id.";
    }
  }

  if(isset($error) AND !empty($error)){
    echo $error;
  }

 ?>
