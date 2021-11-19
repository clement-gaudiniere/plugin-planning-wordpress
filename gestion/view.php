<?php
  // On ajoute le fichier css
  function wpdocs_register_plugin_styles(){
    wp_register_style('plan', plugins_url('plan/style/style.css'));
    wp_enqueue_style('plan');
  }
  // Register style sheet.
  add_action( 'wp_enqueue_scripts', 'wpdocs_register_plugin_styles' );


  echo "ee";
 ?>
