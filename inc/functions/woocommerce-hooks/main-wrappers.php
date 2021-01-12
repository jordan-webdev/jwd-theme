<?php

// Main Page Wrap
add_action('woocommerce_before_main_content', function() { ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
<?php });

add_action('woocommerce_after_main_content', function() { ?>
    </main>
  </div>
<?php });
