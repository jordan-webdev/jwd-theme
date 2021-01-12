<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

// Send an e-mail when coming soon products are available
//add_action( 'updated_post_meta', 'send_email_to_email_list', 10, 4);

function send_email_to_email_list($meta_id, $post_id, $meta_key, $_meta_value) {
  if ($meta_key != "is_send_mail") {
    return;
  }

  $is_send_alert = $_meta_value;
  $email_list = get_field("email_list");
  $options = get_field("product_options", "options")['mail'];

  //error_log( print_r($is_send_alert, true) );

  if (!$is_send_alert || !$email_list) {
    return;
  }

  $to = '';
  $subject = esc_attr(get_field("custom_mail_subject"));
  $subject = $subject ?: $options['subject'];
  $body = get_field("custom_mail_body");
  $body = $body ?: str_replace(
    array("%PRODUCT%", "%LINK%"),
    array(get_the_title(), get_the_permalink()),
    $options['body']
  );
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'BCC: ' .esc_attr($email_list),
  );

  $mail = wp_mail( $to, $subject, $body, $headers );

  // Reset is_send_mail
  update_field('is_send_mail', 0, $post_id);
}
