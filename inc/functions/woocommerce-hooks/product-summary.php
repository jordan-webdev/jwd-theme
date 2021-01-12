<?php

// Summary wrap start
add_action('woocommerce_before_single_product_summary', function() { ?>
  <section class="summary-wrap main-product-wrap">
<?php }, 1);

// Gallery
add_action('woocommerce_before_single_product_summary', function() { ?>
  <?php get_template_part('template-parts/products/part', 'gallery'); ?>
<?php }, 2);

// Product Info
add_action('woocommerce_before_single_product_summary', function() {
  $ID = get_the_ID();
  $args = array(
    'ID' => $ID,
  );
  get_template_part('template-parts/products/part', 'prod-summary', $args);
}, 3);

// After Price
add_action('woocommerce_single_product_summary', function() {

}, 11);

// Before Add to Cart
add_action('woocommerce_single_product_summary', function() {
}, 21);

// In Add to Cart form
add_action('woocommerce_before_add_to_cart_button', function() {
});

// Before QTY
add_action('woocommerce_before_add_to_cart_quantity', function() { ?>
<?php });

// After QTY
add_action('woocommerce_after_add_to_cart_quantity', function() { ?>
<?php });

// After Add to Cart btn
add_action('woocommerce_after_add_to_cart_button', function() { ?>
<?php });

// After Add to Cart
add_action('woocommerce_single_product_summary', function() {
}, 31);

// Summary wrap end
add_action('woocommerce_after_single_product_summary', function() { ?>
</section>
<?php }, 99);
