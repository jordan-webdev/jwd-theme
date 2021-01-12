<?php
/*
* Mobile button, menu, logo and phone icon
*/

$mobile_logo = get_field("mobile_logo", "options");
$phone_url = get_field("mobile_phone_url", "options");
$phone_icon = get_field("mobile_phone_icon", "options");
$map_icon = get_field("mobile_map_icon", "options");
$menu_icon = get_field("mobile_menu_icon", "options");
$contact_page_id = 95; // Update this
?>

<div class="padding-site header-mobile">
  <div class="container-site">
    <nav class="menu">

      <!-- Logo -->
      <a class="logo" href="<?php echo get_home_url(); ?>" rel="home" style="width:<?php echo esc_attr($mobile_logo['width']); ?>px">
        <?php echo wp_get_attachment_image( $mobile_logo['ID'], "full", false, array("alt" => get_bloginfo("name")) ); ?>
        <span class="screen-reader-text"><?php bloginfo("name"); ?>
        </span>
      </a>

      <!-- Icons -->
      <div class="icons">
        <!-- Phone -->
        <?php if ($phone_url): ?>
          <a class="icon-wrap phone" href="tel:<?php echo esc_attr($phone_url); ?>">
            <?php echo wp_get_attachment_image( $phone_icon, "full", false, array("class" => "icon") ); ?>
          </a>
        <?php endif; ?>

        <!-- Map -->
        <?php if ($map_icon): ?>
          <a class="icon-wrap map" href="<?php echo get_permalink($contact_page_id); ?>">
            <?php echo wp_get_attachment_image( $map_icon['ID'], "full", false, array("class" => "icon") ); ?>
          </a>
        <?php endif; ?>

        <!-- Menu -->
        <button id="js-mobile-menu-toggle" class="icon-wrap js-scroll-blocker" aria-controls="mobile-menu" aria-expanded="false" data-toggles="#mobile-menu">
          <?php echo wp_get_attachment_image( $menu_icon['ID'], "full", false, array("class" => "icon", "alt" => "Toggle menu") ); ?>
          <span class="screen-reader-text">Click to toggle the navigation menu.</span>
        </button>
      </div>


    </nav>
  </div>
</div>


<!-- Mobile navigation (placed outside header-mobile to prevent flex miscalculation) -->
<nav id="mobile-site-navigation" class="mobile-navigation header-mobile__navigation">
  <?php $args = array(
    'menu' => 11,
    "menu_id" => "mobile-menu",
    "menu_class" => "wp-nav-menu header-mobile__menu",
  );
  wp_nav_menu($args); ?>
</nav>
