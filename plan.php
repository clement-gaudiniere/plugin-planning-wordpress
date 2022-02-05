<?php
/**
 * @package plan
 * @version 1.3.0
 */
/*
Plugin Name: Gestion planning
Description: Plugin développé afin de gérer les planning horaires d'ouvertures de la salle.
Author: Clément Gaudinière
Version: 1.0.0
Author URI: https://github.com/clement-gaudiniere
*/

// On ajoute le fichier css à la page admin
function admin_style() {
  wp_enqueue_style('plan-admin-style', '/wp-content/plugins/plan/style/admin/admin-style.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

add_action('wp_footer','say_hello');
add_action('admin_menu', 'modifMenu');
add_action('admin_menu', function () {
  global $menu;
  $menu[39] = ['', 'read', '', '', 'wp-menu-separator'];
});

$page_title = 'Gérer les horaires';
$menu_title = 'Planning';
$capability = 'manage_options';
$icon_url = 'img/icon.svg';

function modifMenu() {
  add_menu_page(
    'Planning de la salle',
    'Planning',
    'manage_options',
    plugin_dir_path(__FILE__) . 'gestion/views/index.php',
    null,
    'dashicons-clock',
    40
  );
}

function say_hello(){
  // echo('<p>Heelow World !</p>');
}
?>
