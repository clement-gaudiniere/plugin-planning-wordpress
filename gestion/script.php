<?php
  // Les scripts permettant à view.php d'être interactif
 ?>
<script> // Script de mise à jour des tableaux
  let queryNumber = 0;
  let jour = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
  jQuery(function($) {
    $('.saveTable').click(function(e){
      queryNumber += 1;
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
<script> // Script du design interactif des boutons
  jQuery(function($) {
    let idButtonSave = "";
    $('input').bind('input', function() {
      // On extrait les nombres de la str
      idButtonSave = 'save' + $(this).attr("id").match(/\d+/g).join('');
      $('#'+idButtonSave).addClass('btn-main').removeClass('btn-scd');
    });
    $('textarea').bind('input', function() {
      idButtonSave = 'save' + $(this).attr("id").match(/\d+/g).join('');
      $('#'+idButtonSave).addClass('btn-main').removeClass('btn-scd');
    });
    // Ajouter pour les champs de titres
  });
</script>
<script> // Script pour ajouter des tabelaux
  jQuery(function($) {
    $('#ajouterPlanning').click(function(e){
      e.preventDefault();
      // On désactive le bouton
      $('#ajouterPlanning').prop('disabled', true);
      let dataAddPlan = "?newTab=true";
      $.ajax({
        url : '/Wordpress/wp-content/plugins/plan/gestion/nouveaux-tableaux.php'+dataAddPlan,
        type : 'POST',
        dataType : 'html',
        success : function(code_html, statut){
          $('.nextTable').before(code_html);
          $('#ajouterPlanning').prop('disabled', false);
        }
      });
    });
  });
</script>
<script> // Script pour supprimer des tableaux
  jQuery(function($) {
    // On initialise nos variables
    let idButtonTrash = 0;
    let idTable = 0;
    $('.trash').click(function(e){
      e.preventDefault();
      // On met à jour nos variables
      idButtonTrash = $(this).attr("id");
      idTable = idButtonTrash.substring(6);
      console.log(idTable);
      $('#confirmDelete').css('display','block');

      // Si l'utilisateur confirme la suppression
      $('#deleteConfirmed').click(function(){
        let dataDeleteTab = "?delete=true&tab="+idTable;
        // On ajoute la popup de chargement
        $('#loadingWindow > div:last').after('<div class="chargement" id="chargement'+idTable+'"><div class="components-load" id="componentsLoad'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Chargement...</span></div><div class="components-complete" id="componentsComplete'+idTable+'"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50px; padding: 6px;" viewBox="0 0 48 48" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44ZM34.7415 17.6709C35.1121 17.2614 35.0805 16.629 34.6709 16.2585C34.2614 15.8879 33.629 15.9195 33.2585 16.3291L21.2809 29.5675L14.6905 23.2766C14.291 22.8953 13.658 22.91 13.2766 23.3095C12.8953 23.709 12.91 24.342 13.3095 24.7234L20.6429 31.7234L21.3858 32.4325L22.0749 31.6709L34.7415 17.6709Z" fill="#fff"/></svg><span>Succès !</span></div></div>');
        // On effectue la requête Ajax
        $.ajax({
          url : '/Wordpress/wp-content/plugins/plan/gestion/supprimer-tableaux.php'+dataDeleteTab,
          type : 'POST',
          dataType : 'html',
          success : function(code_html, statut){
            console.log(code_html);
            // On supprimer le tableau
            $('#part-'+idTable).remove();
            // On affiche la popup de chargement
            $('#confirmDelete').css('display','none');
            $('#componentsLoad'+idTable).css('display','none');
            $('#componentsComplete'+idTable).css('display','flex');
            setTimeout(function() {
              $('#componentsComplete'+idTable).css('transform',' translate(400px, 0)');
              setTimeout(function() {
                $('#chargement'+idTable).remove();
              }, 500);
            }, 1000);
          }
        });
      });
      // Si l'utilisateur refuse la suppression
      $('#deleteCancelled').click(function(){
        $('#confirmDelete').css('display','none');
        idButtonTrash = 0;
        idTable = 0;
      });
    });
  });
</script>
