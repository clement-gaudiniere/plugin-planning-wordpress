<?php
  // On ajoute le fichier css à la page admin
  function admin_style() {
    wp_enqueue_style('plan-admin-style', '/wp-content/plugins/plan/style/admin/admin-style.css');
  }
  add_action('admin_enqueue_scripts', 'admin_style');
  /*
    POUR COMPRENDRE LE NOM DES INPUTS :
      [type]-[tableau]-[jour]-[debut/fin]
    AINSI POUR UN INPUT DE TYPE "time" DU TABLEAU 1 DE LA COLONNE DU LUNDI QUI MARQUE LE DEBUT DE L'HORAIRE :
      time-1-lundi-debut
  */
  global $wpdb;

  // On cherche les tableaux qui existent
  $planningTableaux = $wpdb->query('SELECT * FROM planning_tableaux');
  // $count = $planningTableaux->rowCount();
  // echo "<script>alert('".$count."')</script>";

  $nbrTab = 0;
  echo "<script>let nbrTab = 0;</script>";
 ?>
<section>
  <div class="part">
    <form method="post">
      <?php
        $nbrTab += 1;
        echo "<script>let nbrTab += 1;</script>";
       ?>
      <input type="text" name="title-<?= $nbrTab ?>" id="title-<?= $nbrTab ?>" value="Crénaux adultes loisirs" placeholder="Titre du tableau">
      <table>
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
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-lundi-debut" name="time-<?= $nbrTab ?>-lundi-debut" value="">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-lundi-fin" name="time-<?= $nbrTab ?>-lundi-fin" value="">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-mardi-debut" name="time-<?= $nbrTab ?>-mardi-debut" value="">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-mardi-fin" name="time-<?= $nbrTab ?>-mardi-fin" value="">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-mercredi-debut" name="time-<?= $nbrTab ?>-mercredi-debut" value="20:30">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-mercredi-fin" name="time-<?= $nbrTab ?>-mercredi-fin" value="22:00">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-jeudi-debut" name="time-<?= $nbrTab ?>-jeudi-debut" value="20:30">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-jeudi-fin" name="time-<?= $nbrTab ?>-jeudi-fin" value="22:00">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-vendredi-debut" name="time-<?= $nbrTab ?>-vendredi-debut" value="20:30">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-vendredi-fin" name="time-<?= $nbrTab ?>-vendredi-fin" value="22:00">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-samedi-debut" name="time-<?= $nbrTab ?>-samedi-debut" value="">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-samedi-fin" name="time-<?= $nbrTab ?>-samedi-fin" value="">
          </td>
          <td>
            <input type="time" id="time-<?= $nbrTab ?>-dimanche-debut" name="time-<?= $nbrTab ?>-dimanche-debut" value="09:00">
            <span>à</span>
            <input type="time" id="time-<?= $nbrTab ?>-dimanche-fin" name="time-<?= $nbrTab ?>-dimanche-fin" value="12:00">
          </td>
        </tr>
        <tr>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
          <td class="comment"><textarea placeholder="Commentaire..."></textarea></td>
        </tr>
      </table>
      <div class="toolbar">
        <button type="button" name="addException" class="btn btn-scd">Ajouter une exception</button>
        <button type="button" name="save" class="btn btn-main">Enregistrer</button>
      </div>
    </form>
  </div>

  <div class="part">
    <div id="ajouterPlanning">
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
      $('#ajouterPlanning').click(function(){
        alert(nbrTab);
      });
      // $('body').css('background','red');
    });
  </script>
</section>
