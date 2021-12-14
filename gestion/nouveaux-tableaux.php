<?php
  require "../../../../wp-config.php";
  global $wpdb;

  // Fichier de création d'un tableua
  if(isset($_GET['newTab']) AND $_GET['newTab'] == true){

    // On créer une nouvelle entré dans la table : "planning_tableaux"
    $newPlanning = $wpdb->query('INSERT INTO `planning_tableaux`(`date_creation`) VALUES (NOW())');

    // On récupérer l'id du dernier planning
    $idPlanning = $wpdb->insert_id;

    // On créer plusieurs nouvelles entrées dans la table : "planning_horaires"
    for ($i = 1; $i <= 7; $i++) {
      $newHorairePlanning = $wpdb->query('INSERT INTO `planning_horaires`(`idTableau`, `jour`) VALUES ('.$idPlanning.','.$i.')');
    }

    echo "Succès";

  } else {
    $error = "Erreur argument [newTab]";
  }

  if(isset($error) AND !empty($error)){
    echo $error;
  }

 ?>
