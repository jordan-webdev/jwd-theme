<?php
// Excerpt Modification

function jwd_custom_excerpt_length( $length ) {
    return 22;
}
add_filter( 'excerpt_length', 'jwd_custom_excerpt_length', 999 );

function jwd_custom_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'jwd_custom_excerpt_more');
