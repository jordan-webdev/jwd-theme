<?php
// Filter that only occurs once

function add_filter_once( $hook, $callback, $priority = 10, $params = 1 ) {
	add_filter( $hook, function( $first_arg ) use( $callback ) {
		static $ran = false;

		if ( $ran ) {
			return $first_arg;
		}

		$ran = true;
		return call_user_func_array( $callback, func_get_args() );
	}, $priority, $params );
}
