<?php

// Custom content based on cart items
//add_action('woocommerce_email_customer_details', 'jwd_add_custom_email_content', 99, 4);
function jwd_add_custom_email_content($order, $sent_to_admin, $plain_text, $email) {
  $args = array(
    'order' => $order,
  );
  get_template_part('template-parts/emails/part', 'custom-content', $args);
}



// Add prod IMG to e-mails
add_filter( 'woocommerce_email_order_items_table', 'jwd_add_images_woocommerce_emails', 10, 2 );
function jwd_add_images_woocommerce_emails( $output, $order ) {

	// set a flag so we don't recursively call this filter
	static $run = 0;

	// if we've already run this filter, bail out
	if ( $run ) {
		return $output;
	}

	$args = array(
		'show_image'   	=> true,
		'image_size'    => 'medium',
    //'image_size' => 'full',
	);

	// increment our flag so we don't run again
	$run++;

	// if first run, give WooComm our updated table
	return wc_get_email_order_items($order, $args);
}




// Edit order item title
function jwd_edit_order_item_name( $name ) {
  $new_html = '<span style="display:block;margin-top:1em;">' .$name. '</span>';
  return $new_html;
}
add_filter( 'woocommerce_order_item_name', 'jwd_edit_order_item_name' );
