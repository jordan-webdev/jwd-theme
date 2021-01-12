<?php
/*
 * Module: Main Popup
 */

$main_popup = get_field("main_popup", "options");
$img = $main_popup['img'];
?>

<?php if ($img) : ?>
  <button class="main-popup" type="button">
    <span class="screen-reader-text">Click to close popup</span>
    <span class="layout">
      <?php echo wp_get_attachment_image( $img, "full", false, array("class" => "img") ); ?>
    </span>
  </button>
<?php endif; ?>
