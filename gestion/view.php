<?php
  /*
    POUR COMPRENDRE LE NOM DES INPUTS :
      [type]-[tableau]-[jour]-[debut/fin]
    AINSI POUR UN INPUT DE TYPE "time" DU TABLEAU 1 DE LA COLONNE DU LUNDI QUI MARQUE LE DEBUT DE L'HORAIRE :
      time-1-lundi-debut
  */
  global $wpdb;

  // On créer une liste des jours de la semaine
  $joursSemaine = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];

  // On cherche les tableaux qui existent
  $planningTableaux = $wpdb->get_results('SELECT * FROM planning_tableaux');
  $nbrTab = 0;
 ?>
<section class="main" id="mainSectionTableaux">
  <?php
  // On affiche chaque tableaux avec ses horaires
  foreach($planningTableaux as $planningTableauxIncrement) {
    ?>
    <div class="part">
      <form method="post">
        <?php  $nbrTab += 1; ?>
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
            $i = 0;
            foreach($planningHoraires as $planningHorairesIncrement) {
              ?>
              <td>
                <input type="time" id="time-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>-debut" name="time-<?= $nbrTab ?>-lundi-debut" value="<?= $planningHorairesIncrement->horaireDebut ?>">
                <span>à</span>
                <input type="time" id="time-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>-fin" name="time-<?= $nbrTab ?>-lundi-fin" value="<?= $planningHorairesIncrement->horaireFin ?>">
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
              <td class="comment"><textarea placeholder="Commentaire..." id="comment-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>"><?= $planningHorairesIncrement->commentaire ?></textarea></td>
              <?php
              $i += 1;
            }
             ?>
          </tr>
        </table>
        <div class="toolbar">
          <button type="button" name="addException" class="btn btn-scd">Ajouter une exception</button>
          <button type="button" name="save" class="btn btn-main saveTable" id="save<?= $nbrTab ?>">Enregistrer</button>
        </div>
      </form>
    </div>
    <?php
  }
 ?>

 <div class="part nextTable"></div>

  <div class="part">
    <div id="ajouterPlanning" class="btn btn-main">
      <svg xmlns="http://www.w3.org/2000/svg" width="25px" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 489.8 489.8" style="enable-background:new 0 0 489.8 489.8;" xml:space="preserve">
      	<g>
      		<path d="M438.2,0H51.6C23.1,0,0,23.2,0,51.6v386.6c0,28.5,23.2,51.6,51.6,51.6h386.6c28.5,0,51.6-23.2,51.6-51.6V51.6    C489.8,23.2,466.6,0,438.2,0z M465.3,438.2c0,14.9-12.2,27.1-27.1,27.1H51.6c-14.9,0-27.1-12.2-27.1-27.1V51.6    c0-14.9,12.2-27.1,27.1-27.1h386.6c14.9,0,27.1,12.2,27.1,27.1V438.2z"/>
      		<path d="M337.4,232.7h-80.3v-80.3c0-6.8-5.5-12.3-12.3-12.3s-12.3,5.5-12.3,12.3v80.3h-80.3c-6.8,0-12.3,5.5-12.3,12.2    c0,6.8,5.5,12.3,12.3,12.3h80.3v80.3c0,6.8,5.5,12.3,12.3,12.3s12.3-5.5,12.3-12.3v-80.3h80.3c6.8,0,12.3-5.5,12.3-12.3    C349.7,238.1,344.2,232.7,337.4,232.7z"/>
      	</g>
      </svg>
      Ajouter un planning horaires
    </div>
  </div>

  <script type="text/javascript">
  jQuery(function($) {
    $('.saveTable').click(function(e){
      e.preventDefault();
      let idButtonSave = $(this).attr("id");
      let idTable = idButtonSave.substring(4, 5);
      let data = '?msj=true&idTable='+idTable+'&title=' + $('#title-'+idTable).val() + '&time-lundi-debut=' + $('#time-'+idTable+'-lundi-debut').val() + '&time-lundi-fin=' + $('#time-'+idTable+'-lundi-fin').val() + '&time-mardi-debut=' + $('#time-'+idTable+'-mardi-debut').val() + '&time-mardi-fin=' + $('#time-'+idTable+'-mardi-fin').val()  + '&time-mercredi-debut=' + $('#time-'+idTable+'-mercredi-debut').val() + '&time-mercredi-fin=' + $('#time-'+idTable+'-mercredi-fin').val()  + '&time-jeudi-debut=' + $('#time-'+idTable+'-jeudi-debut').val() + '&time-jeudi-fin=' + $('#time-'+idTable+'-jeudi-fin').val()  + '&time-vendredi-debut=' + $('#time-'+idTable+'-vendredi-debut').val() + '&time-vendredi-fin=' + $('#time-'+idTable+'-vendredi-fin').val() + '&time-samedi-debut=' + $('#time-'+idTable+'-samedi-debut').val() + '&time-samedi-fin=' + $('#time-'+idTable+'-samedi-fin').val() + '&time-dimanche-debut=' + $('#time-'+idTable+'-dimanche-debut').val() + '&time-dimanche-fin=' + $('#time-'+idTable+'-dimanche-fin').val() + "&comment-lundi=" + $('#comment-'+idTable+'-lundi').val() + "&comment-mardi=" + $('#comment-'+idTable+'-mardi').val() + "&comment-mercredi=" + $('#comment-'+idTable+'-mercredi').val() + "&comment-jeudi=" + $('#comment-'+idTable+'-jeudi').val() + "&comment-vendredi=" + $('#comment-'+idTable+'-vendredi').val() + "&comment-samedi=" + $('#comment-'+idTable+'-samedi').val() + "&comment-dimanche=" + $('#comment-'+idTable+'-dimanche').val();
      $('#loadingWindow > div:last').after('<div class="chargement" id="chargement'+idTable+'"><div class="components-load" id="componentsLoad'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Chargement...</span></div><div class="components-complete" id="componentsComplete'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Succès !</span></div></div>');
      // $('#loadingWindow > div:last').fadeIn(150);
      $.ajax({
        url : '/Wordpress/wp-content/plugins/plan/gestion/modification-tableaux.php'+data,
        type : 'POST',
        dataType : 'html',
        success : function(code_html, statut){
          console.log(code_html);
          $('#componentsLoad'+idTable).css('display','none');
          $('#componentsComplete'+idTable).css('display','flex');
          setTimeout(function() {
            $('#componentsComplete'+idTable).css('display','none');
            $('#chargement'+idTable).remove();
          }, 1000);
        }
      });
    });
  });
  </script>

  <script type="text/javascript">
    let nbrTab = <?= $nbrTab ?>;
    /*let newTableContent = '<form method="post">
      <input type="text" name="title-'+nbrTab+1+'" id="title-'+nbrTab+1+'" value="<?= $planningTableauxIncrement->name ?>" placeholder="Titre du tableau">
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
          $i = 0;
          foreach($planningHoraires as $planningHorairesIncrement) {
            ?>
            <td>
              <input type="time" id="time-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>-debut" name="time-<?= $nbrTab ?>-lundi-debut" value="<?= $planningHorairesIncrement->horaireDebut ?>">
              <span>à</span>
              <input type="time" id="time-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>-fin" name="time-<?= $nbrTab ?>-lundi-fin" value="<?= $planningHorairesIncrement->horaireFin ?>">
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
            <td class="comment"><textarea placeholder="Commentaire..." id="comment-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>"><?= $planningHorairesIncrement->commentaire ?></textarea></td>
            <?php
            $i += 1;
          }
           ?>
        </tr>
      </table>
      <div class="toolbar">
        <button type="button" name="addException" class="btn btn-scd">Ajouter une exception</button>
        <button type="button" name="save" class="btn btn-main saveTable" id="save<?= $nbrTab ?>">Enregistrer</button>
      </div>
    </form>'; */
    jQuery(function($) {
      $('#ajouterPlanning').click(function(){
        $('.nextTable:last').html(nbrTab+1);
      });
    });
  </script>
</section>
<div id="loadingWindow">
  <div></div>
</div>
