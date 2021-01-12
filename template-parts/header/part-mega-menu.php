<?php
/*
 * Mega Menu
 */

$mega_link = get_field("mega_link", $menu_item);
$default_img = get_field("mega_default_img", $menu_item);
?>

<div class="mega-menu drop-down">
  <!-- List -->
  <ul class="mega-list">
    <?php foreach ($child_items as $child_item):
      $classes = "link colour-link " . get_menu_classes($child_item);
      $img = get_field("menu_img", $child_item)
    ?>
      <li class="mega-item">
        <!-- Menu Link -->
        <a class="<?php echo $classes; ?>" href="<?php echo esc_url($child_item->url); ?>">
          <?php echo esc_html($child_item->title); ?>
        </a>

        <!-- Menu IMG -->
        <?php echo wp_get_attachment_image( $img, "full", false, array("class" => "menu-img") ); ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <!-- Default IMG -->
  <?php echo wp_get_attachment_image( $default_img, "full", false, array("class" => "menu-img default") ); ?>

  <!-- Main Link -->
  <a class="main-link common-btn" href="<?php echo esc_url($mega_link['url']); ?>">
    <?php echo esc_html($mega_link['title']); ?>
  </a>
</div>
