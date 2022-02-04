<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
  require "../../../../../wp-config.php";
  global $wpdb;

  // Si les variables existent
  if(isset($_GET['planningExceptionFor'], $_GET['choicePlanning'], $_GET['dateException'], $_GET['timeException'], $_GET['commentException'])){
    // Si elles ne sont pas vides
    if(!empty($_GET['planningExceptionFor']) AND !empty($_GET['dateException']) AND !empty($_GET['timeException']) AND !empty($_GET['commentException'])){

      $planningExceptionFor = htmlspecialchars($_GET['planningExceptionFor']);
      $choicePlanning = htmlspecialchars($_GET['choicePlanning']);
      $dateException = htmlspecialchars($_GET['dateException']);
      $timeException = htmlspecialchars($_GET['timeException']);
      $commentException = htmlspecialchars($_GET['commentException']);

      // On veut savoir si l'exception concerne un ou tous les tableaux
      if($planningExceptionFor == 'onePlanning'){

        $planningId = intval(substr($choicePlanning, 4));

        $addException = $wpdb->query('INSERT INTO `planning_exceptions`(`tabId`, `dateException`, `timeException`, `raison`) VALUES ('.$planningId.','.$dateException.','.$timeException.','.$commentException.')');

        echo "Success 1";
        echo $planningId;
        echo $dateException;
        echo $timeException;
        echo $commentException;


      } elseif ($planningExceptionFor == 'allPlanning') {

        $addException = $wpdb->query('INSERT INTO `planning_exceptions`(`tabId`, `dateException`, `timeException`, `raison`) VALUES ("all",'.$dateException.','.$timeException.','.$commentException.')');

        echo "Success 2";

      }


    }
  }

  echo "     //";

 ?>
