<?php

$filter_title = $filter_title ?? "FILTER BY";
$page_link = get_current_url();
$all_link = get_post_type_archive_link( 'post' );
$is_all_match = $all_link == $page_link;

$args = array(
  'taxonomy' => $tax,
);
$filters = get_terms($args);
