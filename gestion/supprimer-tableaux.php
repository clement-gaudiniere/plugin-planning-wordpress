<?php
  require "../../../../wp-config.php";
  global $wpdb;

  // Fichier de mise à jour des valeurs des tableaux
  if(isset($_GET['delete']) AND $_GET['delete'] == true){
    if(isset($_GET['tab']) AND !empty($_GET['tab'])){

      $idTab = htmlspecialchars(intval($_GET['tab']));

      // On supprimer l'entrée dans la table "planning_tableaux"
      $deletePlanning = $wpdb->query('DELETE FROM `planning_tableaux` WHERE id = '.$idTab);

      // On supprimer les entrées dans la table "planning_horaires"
      $deleteHoraires = $wpdb->query('DELETE FROM `planning_horaires` WHERE idTableau = '.$idTab);


      echo "Tableau supprimé";
      echo "\n".$idTab;

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
