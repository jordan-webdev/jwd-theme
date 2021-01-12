<?php
/*
 * Go to top button
 */

$uploads = get_home_url() . '/wp-content/uploads';
$arrow = get_image_id($uploads . '/scroll-arrow-up-min.png');
?>

<a class="go-to-top" href="#masthead">
  <?php echo wp_get_attachment_image( $arrow, "full", false, array("alt" => "Click to go to top") ); ?>
</a>
