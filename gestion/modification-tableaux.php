<?php
  require "../../../../wp-config.php";
  global $wpdb;

  // Fichier de mise à jour des valeurs des tableaux
  if(isset($_GET['msj']) AND $_GET['msj'] == true){
    if(isset($_GET['idTable']) AND !empty($_GET['idTable'])){
      if(isset($_GET['title']) AND !empty($_GET['title'])){
        if(isset($_GET['time-lundi-debut'],$_GET['time-lundi-fin'],$_GET['time-mardi-debut'],$_GET['time-mardi-fin'],$_GET['time-mercredi-debut'],$_GET['time-mercredi-fin'],$_GET['time-jeudi-debut'],$_GET['time-jeudi-fin'],$_GET['time-vendredi-debut'],$_GET['time-vendredi-fin'],$_GET['time-samedi-debut'],$_GET['time-samedi-fin'],$_GET['time-dimanche-debut'],$_GET['time-dimanche-fin'])){
          if(isset($_GET['comment-lundi'], $_GET['comment-mardi'], $_GET['comment-mercredi'], $_GET['comment-jeudi'], $_GET['comment-vendredi'], $_GET['comment-samedi'], $_GET['comment-dimanche'])){

            // On initialise les jours de la semaine
            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            // On sécurise les champs
            $titre = htmlspecialchars($_GET['title']);
            $idTable = htmlspecialchars($_GET['idTable']);

            $timeJours = [
              [htmlspecialchars($_GET['time-lundi-debut']),htmlspecialchars($_GET['time-lundi-fin'])],
              [htmlspecialchars($_GET['time-mardi-debut']),htmlspecialchars($_GET['time-mardi-fin'])],
              [htmlspecialchars($_GET['time-mercredi-debut']),htmlspecialchars($_GET['time-mercredi-fin'])],
              [htmlspecialchars($_GET['time-jeudi-debut']),htmlspecialchars($_GET['time-jeudi-fin'])],
              [htmlspecialchars($_GET['time-vendredi-debut']),htmlspecialchars($_GET['time-vendredi-fin'])],
              [htmlspecialchars($_GET['time-samedi-debut']),htmlspecialchars($_GET['time-samedi-fin'])],
              [htmlspecialchars($_GET['time-dimanche-debut']),htmlspecialchars($_GET['time-dimanche-fin'])]
            ];

            $commentJours = [htmlspecialchars($_GET['comment-lundi']), htmlspecialchars($_GET['comment-mardi']), htmlspecialchars($_GET['comment-mercredi']), htmlspecialchars($_GET['comment-jeudi']), htmlspecialchars($_GET['comment-vendredi']), htmlspecialchars($_GET['comment-samedi']), htmlspecialchars($_GET['comment-dimanche'])];

            // On met à jour le titre
            $newNameQuery = $wpdb->query($wpdb->prepare("UPDATE planning_tableaux SET name=%s WHERE id=%d", array($titre, $idTable)));

            // On met à jour les horaires et on ajoute les commentaires
            for ($i = 1; $i < 8; $i++) {
              $newTimetableQuery = $wpdb->query($wpdb->prepare("UPDATE planning_horaires SET horaireDebut=%s, horaireFin=%s, commentaire=%s WHERE idTableau=%d AND jour=%d", array($timeJours[$i-1][0], $timeJours[$i-1][1], $commentJours[$i-1], $idTable, $i)));
            }

            echo "Tableau mis à jour avec succès !";
          } else {
            $error = "Certains champs requis n'existent pas : les commentaires";
          }
        } else {
          $error = "Certains champs requis n'existent pas ([type = \"time\"])";
        }
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
