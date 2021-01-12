<?php
// Redirect to Account Page after logging in or registering

//add_action('template_redirect', 'redirect_to_account' );
function redirect_to_account() {
  // Redirect from Login page to Account Page
  if(is_page(131) && is_user_logged_in()) {
    $account_url = get_permalink(82);
    wp_redirect($account_url);
    exit;
  }

  // Redirect from Account Page to Login Page
  $allow_access = array_key_exists('allow_access', $_GET) || array_key_exists('show-reset-form', $_GET) ? true : false;
  if(is_page(82) && !is_user_logged_in() && !$allow_access){
    $login_url = get_permalink(131);
    wp_redirect($login_url);
    exit;
  }
};
