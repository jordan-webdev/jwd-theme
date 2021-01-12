<?php
/* ******************************************************************
   *
   * custom_menu_page_removing
   * Remove wp-admin menu items
   *
   ******************************************************************
*/
function custom_menu_page_removing() {
  //remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

/* ******************************************************************
   *
   * wpcf7_autop_or_not
   * Remove Auto P from CF7
   *
   ******************************************************************
*/
add_filter('wpcf7_autop_or_not', '__return_false');
