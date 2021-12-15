<?php
  require "../../../../../wp-config.php";
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

    // On récupérer les infos
    $planningTableaux = $wpdb->get_results('SELECT * FROM planning_tableaux WHERE id = '.$idPlanning);
    foreach($planningTableaux as $planningTableauxIncrement) {
      ?>
      <div class="part" id="part-<?= $planningTableauxIncrement->id ?>">
        <form method="post">
          <input type="text" name="title-<?= $planningTableauxIncrement->id ?>" id="title-<?= $planningTableauxIncrement->id ?>" value="<?= $planningTableauxIncrement->name ?>" placeholder="Titre du tableau" disabled="true" class="not-allowed">
          <table class="table-plan not-allowed">
            <tr>
              <th>Lundi</th>
              <th>Mardi</th>
              <th>Mercredi</th>
              <th>Jeudi</th>
              <th>Vendredi</th>
              <th>Samedi</th>
              <th>Dimanche</th>
            </tr>
            <tr>
              <?php
              $planningHoraires = $wpdb->get_results('SELECT * FROM planning_horaires WHERE idTableau = '.$planningTableauxIncrement->id.' ORDER BY jour');
              $i = 0;
              foreach($planningHoraires as $planningHorairesIncrement) {
                ?>
                <td>
                  <input type="time" id="time-<?= $planningTableauxIncrement->id ?>-<?= $joursSemaine[$i] ?>-debut" name="time-<?= $planningTableauxIncrement->id ?>-lundi-debut" value="<?= $planningHorairesIncrement->horaireDebut ?>" disabled="true">
                  <span>à</span>
                  <input type="time" id="time-<?= $planningTableauxIncrement->id ?>-<?= $joursSemaine[$i] ?>-fin" name="time-<?= $planningTableauxIncrement->id ?>-lundi-fin" value="<?= $planningHorairesIncrement->horaireFin ?>" disabled="true">
                </td>
                <?php
                $i += 1;
              }
               ?>
            </tr>
            <tr>
              <?php
              $i = 0;
              foreach($planningHoraires as $planningHorairesIncrement) {
                ?>
                <td class="comment"><textarea maxlength="150" placeholder="Commentaire..." id="comment-<?= $planningTableauxIncrement->id ?>-<?= $joursSemaine[$i] ?>" disabled="true"><?= $planningHorairesIncrement->commentaire ?></textarea></td>
                <?php
                $i += 1;
              }
               ?>
            </tr>
          </table>
          <div class="toolbar">
            <svg xmlns="http://www.w3.org/2000/svg" id="trash-<?= $planningTableauxIncrement->id ?>" x="0px" y="0px" viewBox="0 0 457.503 457.503" style="enable-background:new 0 0 457.503 457.503;" xml:space="preserve" class="trash">
              <g>
            		<path d="M381.575,57.067h-90.231C288.404,25.111,261.461,0,228.752,0C196.043,0,169.1,25.111,166.16,57.067H75.929    c-26.667,0-48.362,21.695-48.362,48.362c0,26.018,20.655,47.292,46.427,48.313v246.694c0,31.467,25.6,57.067,57.067,57.067    h195.381c31.467,0,57.067-25.6,57.067-57.067V153.741c25.772-1.02,46.427-22.294,46.427-48.313    C429.936,78.761,408.242,57.067,381.575,57.067z M165.841,376.817c0,8.013-6.496,14.509-14.508,14.509    c-8.013,0-14.508-6.496-14.508-14.509V186.113c0-8.013,6.496-14.508,14.508-14.508c8.013,0,14.508,6.496,14.508,14.508V376.817z     M243.26,376.817c0,8.013-6.496,14.509-14.508,14.509c-8.013,0-14.508-6.496-14.508-14.509V186.113    c0-8.013,6.496-14.508,14.508-14.508c8.013,0,14.508,6.496,14.508,14.508V376.817z M320.679,376.817    c0,8.013-6.496,14.509-14.508,14.509c-8.013,0-14.509-6.496-14.509-14.509V186.113c0-8.013,6.496-14.508,14.509-14.508    s14.508,6.496,14.508,14.508V376.817z"/>
            	</g>
            </svg>
            <button type="button" name="addException-<?= $planningTableauxIncrement->id ?>" class="btn btn-scd not-allowed" id="addException-<?= $planningTableauxIncrement->id ?>" disabled="true">Ajouter une exception</button>
            <button type="button" name="save" class="btn btn-scd saveTable not-allowed" id="save<?= $planningTableauxIncrement->id ?>" disabled="true">Enregistrer</button>
          </div>
        </form>
      </div>
      <?php
    }
  } else {
    $error = "Erreur argument [newTab]";
  }

  if(isset($error) AND !empty($error)){
    echo $error;
  }

 ?>
