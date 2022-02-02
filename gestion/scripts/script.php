<?php
  // Les scripts permettant à view.php d'être interactif
 ?>
<script>
// Script de mise à jour des tableaux
  let jour = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
  jQuery(function($) {
    $('.saveTable').click(function(e){
      e.preventDefault();
      // On déclare nos variables
      let idButtonSave = $(this).attr("id");
      let idTable = idButtonSave.substring(5);
      // On désactive le bouton pour éviter une surcharge de requête
      $('#'+idButtonSave).prop('disabled', true);
      // On traite les données
      let dataMaj = '?msj=true&idTable='+idTable+'&title=' + $('#title-'+idTable).val();
      for (let i = 0; i <= 7; i++) {
        dataMaj += '&time-'+jour[i]+'-debut=' + $('#time-'+idTable+'-'+jour[i]+'-debut').val() + '&time-'+jour[i]+'-fin=' + $('#time-'+idTable+'-'+jour[i]+'-fin').val() +
        '&comment-'+jour[i]+'=' + $('#comment-'+idTable+'-'+jour[i]).val();
      }
      // On ajoute la popup de chargement
      $('#loadingWindow > div:last').after('<div class="chargement" id="chargement'+idTable+'"><div class="components-load" id="componentsLoad'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Chargement...</span></div><div class="components-complete" id="componentsComplete'+idTable+'"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50px; padding: 6px;" viewBox="0 0 48 48" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44ZM34.7415 17.6709C35.1121 17.2614 35.0805 16.629 34.6709 16.2585C34.2614 15.8879 33.629 15.9195 33.2585 16.3291L21.2809 29.5675L14.6905 23.2766C14.291 22.8953 13.658 22.91 13.2766 23.3095C12.8953 23.709 12.91 24.342 13.3095 24.7234L20.6429 31.7234L21.3858 32.4325L22.0749 31.6709L34.7415 17.6709Z" fill="#fff"/></svg><span>Succès !</span></div></div>');
      // On effectue la requête Ajax
      $.ajax({
        url : '/Site-BCA72/wp-content/plugins/plan/gestion/scripts/modification-tableaux.php'+dataMaj,
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
// Script du design interactif des boutons
  jQuery(function($) {
    let idButtonSave = "";
    $('.inputSaving').bind('input', function() {
      // On extrait les nombres de la str
      idButtonSave = 'save-' + $(this).attr("id").match(/\d+/g).join('');
      $('#'+idButtonSave).addClass('btn-main').removeClass('btn-scd');
    });
  });
// Script pour ajouter des tabelaux
  jQuery(function($) {
    $('#ajouterPlanning').click(function(e){
      e.preventDefault();
      // On désactive le bouton
      $('#ajouterPlanning').prop('disabled', true);
      let dataAddPlan = "?newTab=true";
      $.ajax({
        url : '/Site-BCA72/wp-content/plugins/plan/gestion/scripts/nouveaux-tableaux.php'+dataAddPlan,
        type : 'POST',
        dataType : 'html',
        success : function(code_html, statut){
          $('.nextTable').before(code_html);
          $('#ajouterPlanning').prop('disabled', false);
        }
      });
    });
  });
// Script pour supprimer des tableaux
  jQuery(function($) {
    // On initialise nos variables
    let idButtonTrash = 0;
    let idTable = 0;

    $('#mainSectionTableaux').on('click', '.trash', function(e) {
      e.preventDefault();
      // On met à jour nos variables
      idButtonTrash = $(this).attr("id");
      idTable = idButtonTrash.substring(6);
      $('#confirmDelete').css('display','block');

      // Si l'utilisateur confirme la suppression
      $('#deleteConfirmed').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        // On enlève la popup
        $('#confirmDelete').css('display','none');
        // On entre les données
        let dataDeleteTab = "?delete=true&tab="+idTable;
        // On ajoute la popup de chargement
        $('#loadingWindow > .first').after('<div class="chargement" id="chargement'+idTable+'"><div class="components-load" id="componentsLoad'+idTable+'"><div class="lds-ripple"><div></div><div></div></div><span>Chargement...</span></div><div class="components-complete" id="componentsComplete'+idTable+'"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50px; padding: 6px;" viewBox="0 0 48 48" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44ZM34.7415 17.6709C35.1121 17.2614 35.0805 16.629 34.6709 16.2585C34.2614 15.8879 33.629 15.9195 33.2585 16.3291L21.2809 29.5675L14.6905 23.2766C14.291 22.8953 13.658 22.91 13.2766 23.3095C12.8953 23.709 12.91 24.342 13.3095 24.7234L20.6429 31.7234L21.3858 32.4325L22.0749 31.6709L34.7415 17.6709Z" fill="#fff"/></svg><span>Succès !</span></div></div>');
        // On effectue la requête Ajax
        $.ajax({
          url : '/Site-BCA72/wp-content/plugins/plan/gestion/scripts/supprimer-tableaux.php'+dataDeleteTab,
          type : 'POST',
          dataType : 'html',
          success : function(code_html, statut){
            console.log(code_html);
            // On supprimer le tableau
            $('#part-'+idTable).remove();
            // On affiche la popup de chargement
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
      $('#deleteCancelled').click(function(e){
        e.preventDefault();
        $('#confirmDelete').css('display','none');
        idButtonTrash = 0;
        idTable = 0;
      });
    });
  });
// Script pour ajouter des exceptions
  jQuery(function($) {
    // Si user souhaite ajouter une exception
    $('.addException').click(function(e){
      e.preventDefault();
      $('#ajouterExeception').css('display','block');
      // On change le background
      $('body').css('background','#fff');
    });
    // Si l'user choisit une tableau dans le select
    $('#planningChoice').click(function(e){
      e.preventDefault();
      $('#onePlanning').prop("checked", true);
    });
    // Lorsque l'utilisateur enregistre l'exception
    $('#enregistrerException').click(function(e){
      e.preventDefault();
      // if(('input[name=onePlanning]').is(':checked')){
      //   console.log('onePlanning');
      // }
      // else if(('input[name=allPlanning]').is(':checked')) {
      //   console.log('allPlanning');
      // }
      // let planningException =
      let dateException = $('#dateException').val();
      let timeException = $('#timeException').val();
      let raisonException = $('#commentException').val();
      alert('pas encore implémenté : )');
      console.log(dateException);
      console.log(timeException);
      console.log(raisonException);
    });


    // Lorsqu'on ferme la popup
    $('#closePopupExeception').click(function(e){
      e.preventDefault();
      // On (re)change le background
      $('body').css('background','#f0f0f1');
      // On affiche la popup
      $('#ajouterExeception').css('display','none');
    });
  });
</script>
