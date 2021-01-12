<?php

// Manage WooCommerce styles
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'woocommerce_enqueue_styles', 'jwd_dequeue_wc_styles' );
function jwd_dequeue_wc_styles( $enqueue_styles ) {
  if (!is_cart() && !is_checkout() && !is_account_page()){
		$enqueue_styles = false;
    //unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
  	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
  	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
  }
  return $enqueue_styles;
}


// Manage WooCommerce scripts
function jwd_woocommerce_script_cleaner() {

	// Remove the generator tag
	remove_action( 'wp_head', 'wc_generator' );

	if ( !is_cart() && !is_checkout() && !is_account_page()) {
		if (!is_singular('product')) {
			wp_dequeue_script( 'wc-single-product' );
		}

		wp_dequeue_script( 'selectWoo' );
		wp_deregister_script( 'selectWoo' );
		wp_dequeue_script( 'wc-add-payment-method' );
		wp_dequeue_script( 'wc-lost-password' );
		wp_dequeue_script( 'wc_price_slider' );
		wp_dequeue_script( 'wc-add-to-cart' );
		wp_dequeue_script( 'wc-cart-fragments' );
		wp_dequeue_script( 'wc-credit-card-form' );
		wp_dequeue_script( 'wc-checkout' );
		wp_dequeue_script( 'wc-add-to-cart-variation' );
		wp_dequeue_script( 'wc-cart' );
		wp_dequeue_script( 'wc-chosen' );
		wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'jquery-blockui' );
		wp_dequeue_script( 'jquery-placeholder' );
		wp_dequeue_script( 'jquery-payment' );
		wp_dequeue_script( 'fancybox' );
		wp_dequeue_script( 'jqueryui' );
	}
}
//add_action( 'wp_enqueue_scripts', 'jwd_woocommerce_script_cleaner', 99 );
