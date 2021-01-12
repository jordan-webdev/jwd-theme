<?php

// Display Coupon Description
function swwp_change_coupon_preview( $label, $coupon ) {
	if ( is_callable( array( $coupon, 'get_description' ) ) ) {
		$description = $coupon->get_description();
	} else {
		$coupon_post = get_post( $coupon->id );
		$description = ! empty( $coupon_post->post_excerpt ) ? $coupon_post->post_excerpt : null;
	}

	return $description ? sprintf( esc_html__( 'Coupon: %s', 'woocommerce' ), $description ) : esc_html__( 'Coupon', 'woocommerce' );
}
add_filter( 'woocommerce_cart_totals_coupon_label', 'swwp_change_coupon_preview', 10, 2 );



// Add Coupon to order e-mail
add_action( 'woocommerce_email_after_order_table', 'jwd_add_coupon_to_email', 15, 2 );
function jwd_add_coupon_to_email( $order, $is_admin_email ) {
	if ( $is_admin_email ) {

		if( $order->get_coupon_codes() ) {
			$coupons_count = count( $order->get_coupon_codes() );

	    $i = 1;
	    $coupons_list = '';

	    foreach( $order->get_coupon_codes() as $coupon) {
	        $coupons_list .=  $coupon;
	        if( $i < $coupons_count )
	        	$coupons_list .= ', ';
	        $i++;
	    }

			echo '<p><strong>' . __('Coupons used') . ' (' . $coupons_count . '): </strong>' .$coupons_list. '</p>';
		}

	}
}
