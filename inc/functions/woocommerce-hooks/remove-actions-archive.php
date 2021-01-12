<?php
add_action('wp_head', 'jwd_remove_actions_archive');

function jwd_remove_actions_archive() {

  remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
  remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

  remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
  remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
  remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

  remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

  remove_action('woocommerce_no_products_found', 'wc_no_products_found', 10);

  remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

  remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
  remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

  remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

  remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
  remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

  remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
  remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

}

add_filter( 'woocommerce_show_page_title', '__return_false' );
