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
            <button type="button" name="addException" class="btn btn-scd not-allowed" disabled="true">Ajouter une exception</button>
            <button type="button" name="save" class="btn btn-scd saveTable not-allowed" id="save<?= $planningTableauxIncrement->id ?>" disabled="true">Enregistrer</button>
          </div>
        </form>
        <div class="tableauIndispo">
          <a href="#" id="rechargerPage">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 488.482 488.482" style="enable-background:new 0 0 488.482 488.482;" xml:space="preserve">
            	<g>
            		<path d="M456.382,359.741l4.1-6.6c1.2-2.3,2.4-4.6,3.5-6.9c2.3-4.7,4.8-9.2,6.8-14c3.7-9.7,7.7-19.3,10.1-29.4    c3.1-10,4.4-20.3,6.1-30.6c0.7-5.2,0.7-10.4,1.1-15.6l0.4-7.8v-0.5v-0.2v-0.1v-1.1v-0.9l-0.1-1.8l-0.2-3.6l-0.6-14.3l-2.3-16.2    c-0.4-2.7-0.7-5.5-1.3-8l-1.9-7.6c-1.4-5-2.4-10.2-4.2-15.1c-6.4-19.9-16.1-38.7-27.7-56c-12.1-17.1-26.6-32.3-42.7-45.6    c-15.7-13-33.1-24.5-52-33.1c-7.5-3.2-15.3-6.1-23-8.8l-11.9-3.2c-4-1-7.9-2.3-12-2.8l-12.2-2l-6.1-1l-6.2-0.4l-12.3-0.7l-3.1-0.2    h-0.8h-0.2h-1.2h-0.4l-1.4,0.1l-5.6,0.2l-11.3,0.5c-1.8,0-4,0.4-6.1,0.7l-6.4,0.9l-12.8,1.9l-12,3c-4,1.1-8.1,1.8-11.9,3.4    l-11.6,4.2l-5.8,2.2l-5.6,2.7l-11.1,5.4c-58.8,30.5-101.2,89.3-112,153.5c-0.6,4.6-1.1,9.1-1.5,13.4c-0.4,4.3-0.8,8.5-0.5,12.5    c0.1,2.4,0.2,4.6,0.4,6.9c-11.1-17.4-23.7-33.9-34-51.8c-0.8-1.4-5.2-1.7-7.7-1c-4.9,1.3-7.2,5.4-8.1,9.7    c-2.9,14.3,0.3,27.3,6.4,38.6c11.5,21.3,22.1,43.2,35.8,63.2l0.3,0.5c0.5,0.7,1,1.4,1.7,2.1c7,7.6,18.9,8.1,26.6,1    c4.9-4.5,9.6-9.2,14.1-14.2c3.1-2.3,6.2-4.5,9.2-6.9c19.1-15,37.5-30.9,52.7-50.1c4.3-5.5,5.5-12.7-1-19.1    c-5.9-5.8-13.6-7.1-19.5-3.1c-10.6,7.2-21.3,14.3-30.6,23c-8.6,8-16.8,16.4-24.9,24.9c0.5-1.6,1-3.3,1.5-5.2    c1.5-5.2,3-11.1,4.2-17.9c0.4-3.4,1.7-6.8,2.4-10.5c0.8-3.7,1.6-7.5,2.4-11.5c7-28.5,20.7-55.1,39.3-77.5    c18.5-22.5,42.5-40,68.5-52.3c5.1-2.8,10.7-4.5,16.1-6.6c5.4-2.3,11-3.5,16.7-5.1c2.8-0.7,5.6-1.7,8.4-2.1l8.2-1.3l8.3-1.4    l9.5-0.6c23.4-1.5,46.9,1.1,69.2,8.2c44.7,13.9,84.1,45.4,107.3,86.8l6,14.7c1.1,2.4,1.8,5,2.6,7.5l2.3,7.6    c1.8,5,2.6,10.2,3.7,15.3l1.6,7.7c0.4,2.5,0.5,5,0.8,7.5l0.8,7.4c0.1,1.3,0.3,2.4,0.4,3.8l0.1,4.3l0.1,8.6l0.1,4.3v2.1v0.5v0.3    v0.1c0,0.2,0-1.6,0-0.8l-0.1,1l-1.3,15.6c-0.5,5.2-1.8,10.3-2.6,15.4c-8.3,40.6-29.6,78.7-61.3,105.6    c-15.7,13.6-33.6,24.5-52.9,32.2c-4.9,1.7-9.7,3.8-14.7,5.2l-15.1,3.9l-14.6,2.3c-2.2,0.5-5.2,0.6-8.1,0.8l-8.6,0.5l-4.3,0.2    l-1.7,0.1h-0.4h-1l-7.8-0.2c-5.2-0.4-10.4-0.7-15.5-1.5c-10.3-1.4-20.4-3.7-30.3-6.9c-19.8-6.3-38.3-16.3-54.6-28.9    c-2.9-2.3-7.1-4.6-10.9-6.4c-3.8-1.6-8.1-3.9-10.3-4.3c-4.6-1-5.7,1-4.5,5c0.6,1.9,1.7,4.4,3.3,7.1c1.6,2.6,3.6,5.5,6.1,8.5    c16.3,20,40.6,38,70.1,48.8c14.7,5.4,30.6,9.1,47.1,10.4l6.2,0.4l1.5,0.1l0.8,0.1h0.4h0.2h0.8h2.9c3.9-0.1,7.8-0.1,11.8-0.2    l5.9-0.1l6.4-0.8l12.9-1.7c40.2-7.1,78.4-25.4,108.8-53.2C432.182,393.241,445.882,377.541,456.382,359.741z"/>
            	</g>
            </svg>
          </a>
          <span>Recharger la page pour puvoir faire des modifications</span>
        </div>
      </div>
      <script>
      jQuery(function($) {
        $('#part-<?= $planningTableauxIncrement->id ?>').hover(
          function(e){
          $('#part-<?= $planningTableauxIncrement->id ?> .tableauIndispo').css('display','flex');
        }, function(){
          $('#part-<?= $planningTableauxIncrement->id ?> .tableauIndispo').css('display','none');
        });
      });
      </script>
      <?php
    }
  } else {
    $error = "Erreur argument [newTab]";
  }

  if(isset($error) AND !empty($error)){
    echo $error;
  }

 ?>
