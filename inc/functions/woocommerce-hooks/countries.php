<?php
// Custom Country Drop Down List
function jwd_custom_countries($mycountry){
    $mycountry = array(
        'CA' => __( 'Canada', 'woocommerce' ),
        'US' => __( 'United States (US)', 'woocommerce' )
    );
    return $mycountry;
}
add_filter('woocommerce_countries','jwd_custom_countries', 10, 1);
