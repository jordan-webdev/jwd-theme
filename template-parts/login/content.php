<?php
/*
 * Login / Register Forms
 */
?>

<div class="padding-site">
  <div class="container-site">

    <div class="forms grid-x grid-margin-x">
      <div class="login cell medium-6 large-4 large-offset-2">
        <div class="container-site">
          <?php get_template_part('template-parts/login/part', 'login'); ?>
        </div>
      </div>

      <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
        <div class="register cell medium-6 large-4">
          <div class="container-site">
            <?php get_template_part('template-parts/login/part', 'register-form'); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>
