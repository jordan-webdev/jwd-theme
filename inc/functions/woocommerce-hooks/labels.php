<?php
// Modify Proceed to PayPal text
function jwd_custom_paypal_button_text( $translated_text, $text, $domain ) {
  switch ( $translated_text ) {
    case 'Proceed to PayPal' :
      $translated_text = __( 'Proceed to checkout', 'woocommerce' );
    break;
  }
  return $translated_text;
}
add_filter( 'gettext', 'jwd_custom_paypal_button_text', 20, 3 );
