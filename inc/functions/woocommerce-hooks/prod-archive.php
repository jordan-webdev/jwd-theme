<?php

// Inner Hero
add_action('woocommerce_archive_description', function(){
  $qo = get_queried_object(); $ID = $qo->term_id;
  $mod = get_field("inner_hero", "product_cat_" .$ID);
  $args = array(
    'mod' => $mod,
    'title' => $qo->name,
  );
  get_template_part('modules/mod', 'inner-hero', $args);


});
