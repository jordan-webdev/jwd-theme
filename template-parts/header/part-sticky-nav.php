<?php
/*
 * Sticky Navigation
 */

$menu = get_navbar_items(2);
$sticky_logo = get_field("sticky_logo", "options");
?>

<div id="sticky-navigation" class="sticky-nav padding-site">
  <div class="layout">

    <!-- Logo -->
    <div class="logo-wrap">
      <a href="<?php echo get_home_url(); ?>" rel="home" class="sticky-logo-wrap">
        <?php echo wp_get_attachment_image( $sticky_logo, "full", false, array("class" => "sticky-logo") ); ?>
        <span class="screen-reader-text"><?php bloginfo( "name" ); ?></span>
      </a>
    </div>

    <!-- Menu -->
    <nav class="menu">
      <ul class="list">
        <?php foreach ($menu as $menu_item):
          $classes = "link " . get_menu_classes($menu_item);
          $child_items = $menu_item->child_items;
        ?>
          <li class="item">
            <a class="<?php echo $classes; ?>" href="<?php echo esc_url($menu_item->url); ?>">
              <?php echo esc_html($menu_item->title); ?>
            </a>

            <?php if ($child_items): ?>
              <div class="sub-list-wrap">
                <ul class="sub-list">
                  <?php foreach ($child_items as $child_item):
                    $classes = "link " . get_menu_classes($child_item);
                  ?>
                    <li class="sub-item">
                      <a class="<?php echo $classes; ?>" href="<?php echo esc_url($child_item->url); ?>">
                        <?php echo esc_html($child_item->title); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

  </div>
</div>
