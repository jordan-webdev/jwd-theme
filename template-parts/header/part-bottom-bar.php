<?php
/*
 * Bottom Bar for desktop nav
 */

//$menu = get_navbar_items(36);

$args = array(
  'container' => 'nav',
  'container_class' => 'menu',
  'menu' => 36,
  'menu_class' => 'list',
);
wp_nav_menu($args);
?>