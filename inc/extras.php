<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jwd
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jwd_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'jwd_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function jwd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'jwd_pingback_header' );

// Remove poor formatting in shortcodes
function cleanup_shortcode_fix($content) {
  $array = array (
    '<p>[' => '[',
    ']</p>' => ']', 
    ']<br />' => ']',
    ']<br>' => ']'
  );
  $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'cleanup_shortcode_fix', 10);

function increase_postmeta_form_limit() {
	return 200;
}
add_filter('postmeta_form_limit', 'increase_postmeta_form_limit');

