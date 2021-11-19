<?php

  if(!function_exists('register_mon_shortcode')){
  function register_mon_shortcode( $attrs, $content = null ){
    return '<div class="mon-shortcode">'.$content.'</div>';
  }
  add_shortcode('mon_shortcode','register_mon_shortcode');
  }
  
 ?>
