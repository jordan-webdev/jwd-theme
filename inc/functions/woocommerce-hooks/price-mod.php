<?php
//add_action( 'woocommerce_before_calculate_totals', 'jwd_new_price' );
function jwd_new_price($cart) {

  // This is necessary for WC 3.0+
  if ( is_admin() && ! defined( 'DOING_AJAX' ) )
    return;

  // Avoiding hook repetition
  if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
    return;

  $cart_items = $cart->get_cart();

	foreach($cart_items as $item) {

    $ID = $item['product_id'];
    //$variation = new WC_Product_Variation($ID);
    //$variation_data = $variation->get_variation_attributes();
    //var_dump($variation_data);
    $data = $item['data'];
    $prod_add_on = $item['product_add_on'] ?? false;
    $add_on_price = $prod_add_on ? str_replace( ")", "", explode("($", $prod_add_on)[1] ) : false;

    if ($prod_add_on && $add_on_price) {
      $new_price = $data->get_price() + $add_on_price;
      $data->set_price($new_price);
    }
	}

}
