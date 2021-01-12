<?php
// Blacklist classes from body_class()
// Author: kaiser
// https://wordpress.stackexchange.com/questions/15850/remove-classes-from-body-class

add_filter( 'body_class', 'body_class_blacklist', 10, 2 );
function body_class_blacklist( $wp_classes, $extra_classes ) {

    // List of the only WP generated classes that are not allowed
    $blacklist = array('admin-bar');

    // Filter the body classes
    $wp_classes = array_diff( $wp_classes, $blacklist );

    // Add the extra classes back untouched
    return array_merge( $wp_classes, (array) $extra_classes );
}
