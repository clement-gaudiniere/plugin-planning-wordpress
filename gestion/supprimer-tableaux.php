<?php
  require "../../../../wp-config.php";
  global $wpdb;

  // Fichier de mise à jour des valeurs des tableaux
  if(isset($_GET['delete']) AND $_GET['delete'] == true){
    if(isset($_GET['tab']) AND !empty($_GET['tab'])){

      $idTab = htmlspecialchars(intval($_GET['tab']));

    } else {
      $error = "Le tableau à supprimer n'est pas précisé";
    }
  } else {
    $error = "Erreur argument [delete]";
  }

  if(isset($error) AND !empty($error)){
    echo $error;
  }

 ?>
