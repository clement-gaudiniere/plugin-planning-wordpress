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
        <div class="head-table">
          <input type="text" name="title-<?= $nbrTab ?>" id="title-<?= $nbrTab ?>" value="<?= $planningTableauxIncrement->name ?>" placeholder="Titre du tableau">
          <svg xmlns="http://www.w3.org/2000/svg" id="trash-<?= $nbrTab ?>" x="0px" y="0px" viewBox="0 0 457.503 457.503" style="enable-background:new 0 0 457.503 457.503;" xml:space="preserve" class="trash">
            <g>
          		<path d="M381.575,57.067h-90.231C288.404,25.111,261.461,0,228.752,0C196.043,0,169.1,25.111,166.16,57.067H75.929    c-26.667,0-48.362,21.695-48.362,48.362c0,26.018,20.655,47.292,46.427,48.313v246.694c0,31.467,25.6,57.067,57.067,57.067    h195.381c31.467,0,57.067-25.6,57.067-57.067V153.741c25.772-1.02,46.427-22.294,46.427-48.313    C429.936,78.761,408.242,57.067,381.575,57.067z M165.841,376.817c0,8.013-6.496,14.509-14.508,14.509    c-8.013,0-14.508-6.496-14.508-14.509V186.113c0-8.013,6.496-14.508,14.508-14.508c8.013,0,14.508,6.496,14.508,14.508V376.817z     M243.26,376.817c0,8.013-6.496,14.509-14.508,14.509c-8.013,0-14.508-6.496-14.508-14.509V186.113    c0-8.013,6.496-14.508,14.508-14.508c8.013,0,14.508,6.496,14.508,14.508V376.817z M320.679,376.817    c0,8.013-6.496,14.509-14.508,14.509c-8.013,0-14.509-6.496-14.509-14.509V186.113c0-8.013,6.496-14.508,14.509-14.508    s14.508,6.496,14.508,14.508V376.817z"/>
          	</g>
          </svg>
        </div>
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
              <td class="comment"><textarea maxlength="150" placeholder="Commentaire..." id="comment-<?= $nbrTab ?>-<?= $joursSemaine[$i] ?>"><?= $planningHorairesIncrement->commentaire ?></textarea></td>
              <?php
              $i += 1;
            }
             ?>
          </tr>
        </table>
        <div class="toolbar">
          <button type="button" name="addException" class="btn btn-scd">Ajouter une exception</button>
          <button type="button" name="save" class="btn btn-scd saveTable" id="save<?= $nbrTab ?>">Enregistrer</button>
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
    // Script de mise à jour des tableaux
    let queryNumber = 0;
    let jour = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
    jQuery(function($) {
      $('.saveTable').click(function(e){
        queryNumber += 1;
        console.log();
        e.preventDefault();
        // On déclare nos variables
        let idButtonSave = $(this).attr("id");
        let idTable = idButtonSave.substring(4);
        // On désactive le bouton pour éviter une surcharge de requête
        $('#'+idButtonSave).prop('disabled', true);
        // On traite les données
        let dataMaj = '?msj=true&idTable='+idTable+'&title=' + $('#title-'+idTable).val() + '&queryNumber=' + queryNumber;
        for (let i = 0; i <= 7; i++) {
          dataMaj += '&time-'+jour[i]+'-debut=' + $('#time-'+idTable+'-'+jour[i]+'-debut').val() + '&time-'+jour[i]+'-fin=' + $('#time-'+idTable+'-'+jour[i]+'-fin').val() +
          '&comment-'+jour[i]+'=' + $('#comment-'+idTable+'-'+jour[i]).val();
        }
        $('#loadingWindow > div:last').after('<div class="chargement" id="chargement'+idTable+'"><div class="components-load" id="componentsLoad'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Chargement...</span></div><div class="components-complete" id="componentsComplete'+idTable+'"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50px; padding: 6px;" viewBox="0 0 48 48" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44ZM34.7415 17.6709C35.1121 17.2614 35.0805 16.629 34.6709 16.2585C34.2614 15.8879 33.629 15.9195 33.2585 16.3291L21.2809 29.5675L14.6905 23.2766C14.291 22.8953 13.658 22.91 13.2766 23.3095C12.8953 23.709 12.91 24.342 13.3095 24.7234L20.6429 31.7234L21.3858 32.4325L22.0749 31.6709L34.7415 17.6709Z" fill="#fff"/></svg><span>Succès !</span></div></div>');
        // On effectue la requête Ajax
        $.ajax({
          url : '/Wordpress/wp-content/plugins/plan/gestion/modification-tableaux.php'+dataMaj,
          type : 'POST',
          dataType : 'html',
          success : function(code_html, statut){
            console.log(code_html);
            $('#componentsLoad'+idTable).css('display','none');
            $('#componentsComplete'+idTable).css('display','flex');
            $('#'+idButtonSave).prop('disabled', false);
            $('#'+idButtonSave).addClass('btn-scd').removeClass('btn-main');
            setTimeout(function() {
              $('#componentsComplete'+idTable).css('transform',' translate(400px, 0)');
              setTimeout(function() {
                $('#chargement'+idTable).remove();
              }, 500);
            }, 1000);
          }
        });
      });
    });
  </script>
  <script>
    // Script du design interactif des boutons
    jQuery(function($) {
      let idButtonSave = "";
      $('input').bind('input', function() {
        idButtonSave = 'save' + $(this).attr("id").substring(5, 6);
        $('#'+idButtonSave).addClass('btn-main').removeClass('btn-scd');
      });
      $('textarea').bind('input', function() {
        idButtonSave = 'save' + $(this).attr("id").substring(8, 9);
        $('#'+idButtonSave).addClass('btn-main').removeClass('btn-scd');
      });
    });
  </script>

  <script type="text/javascript">
    let nbrTab = <?= $nbrTab ?>;
    jQuery(function($) {
      $('#ajouterPlanning').click(function(){
        let dataAddPlan = "?newTab=true&nbrTab=" + nbrTab;
        $.ajax({
          url : '/Wordpress/wp-content/plugins/plan/gestion/nouveaux-tableaux.php'+dataAddPlan,
          type : 'POST',
          dataType : 'html',
          success : function(code_html, statut){
            console.log(code_html);
          }
        });
      });
    });
  </script>
</section>
<div id="loadingWindow">
  <div></div>
</div>
