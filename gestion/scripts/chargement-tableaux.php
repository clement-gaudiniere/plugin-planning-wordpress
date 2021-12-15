<?php
  require "../../../../../wp-config.php";
  global $wpdb;

  // On cherche les tableaux qui existent
  $planningTableaux = $wpdb->get_results('SELECT * FROM planning_tableaux');

  // On affiche chaque tableaux avec ses horaires
  foreach($planningTableaux as $planningTableauxIncrement) {
    ?>
    <div class="part">
      <form method="post">
        <?php  $nbrTab += 1; echo "<script>let nbrTab += 1;</script>"; ?>
        <input type="text" name="title-<?= $nbrTab ?>" id="title-<?= $nbrTab ?>" value="<?= $planningTableauxIncrement->name ?>" placeholder="Titre du tableau">
        <table class="table-plan">
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
            foreach($planningHoraires as $planningHorairesIncrement) {
              ?>
              <td>
                <input type="time" id="time-<?= $nbrTab ?>-lundi-debut" name="time-<?= $nbrTab ?>-lundi-debut" value="">
                <span>à</span>
                <input type="time" id="time-<?= $nbrTab ?>-lundi-fin" name="time-<?= $nbrTab ?>-lundi-fin" value="">
              </td>
              <?php
            }
             ?>
          </tr>
          <tr>
            <?php
            foreach($planningHoraires as $planningHorairesIncrement) {
              ?>
              <td class="comment"><textarea placeholder="Commentaire..."><?= $planningHorairesIncrement->commentaire ?></textarea></td>
              <?php
            }
             ?>
          </tr>
        </table>
        <div class="toolbar">
          <button type="button" name="addException" class="btn btn-scd">Ajouter une exception</button>
          <button type="button" name="save" class="btn btn-main">Enregistrer</button>
        </div>
      </form>
    </div>
    <?php
  }
 ?>
