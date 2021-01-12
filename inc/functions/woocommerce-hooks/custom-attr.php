<?php
// Add to cart item data
add_action('woocommerce_add_cart_item_data', 'jwd_add_custom_attr', 10, 3);
function jwd_add_custom_attr($cart_item_data, $product_id, $variation_id) {
  $attrs = array('product_colour', 'product_add_on');

  foreach ($attrs as $attr) {
    $san_attr = filter_input( INPUT_POST, $attr );

    if ( !empty( $san_attr ) ) {
      $cart_item_data[$attr] = $san_attr;
    }
  }

  return $cart_item_data;
}




// Display in cart
add_filter( 'woocommerce_get_item_data', 'jwd_display_colour_in_cart', 10, 2 );
function jwd_display_colour_in_cart( $item_data, $cart_item ) {
  if ( empty( $cart_item['product_colour'] ) ) {
    return $item_data;
  }

  $item_data[] = array(
    'key'     => 'Colour',
    'value'   => wc_clean( $cart_item['product_colour'] ),
    'display' => '',
  );

  return $item_data;
}

add_filter( 'woocommerce_get_item_data', 'jwd_display_add_on_in_cart', 10, 2 );
function jwd_display_add_on_in_cart( $item_data, $cart_item ) {
  if ( empty( $cart_item['product_add_on'] ) ) {
    return $item_data;
  }

  $item_data[] = array(
    'key'     => 'Add On',
    'value'   => wc_clean( $cart_item['product_add_on'] ),
    'display' => '',
  );

  return $item_data;
}




// Add to order
add_action( 'woocommerce_checkout_create_order_line_item', 'jwd_add_attr_to_order_items', 10, 4 );
function jwd_add_attr_to_order_items( $item, $cart_item_key, $values, $order ) {
  if ( !empty( $values['product_colour'] ) ) {
    $item->add_meta_data( 'Colour', $values['product_colour'] );
  }

  if ( !empty( $values['product_add_on'] ) ) {
    $item->add_meta_data( 'Add On', $values['product_add_on'] );
  }
}
