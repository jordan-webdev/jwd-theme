<?php

add_filter( 'gettext', 'jwd_change_strings', 999, 3 );

function jwd_change_strings( $translated, $untranslated, $domain ) {

 if ( ! is_admin() && 'woocommerce' === $domain ) {

    switch ( $translated) {
     case 'Quantity' :
      $translated = 'Qty';
      break;

     case 'Apply coupon' :
      $translated = 'Apply';
      break;
    }

 }

 return $translated;
}
