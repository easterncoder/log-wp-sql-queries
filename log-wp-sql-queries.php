<?php
/**
 *
 * Plugin Name: Log WP SQL Queries
 * Author: Mike Lopez <e@mikelopez.com>
 * Version: 0.1.0
 *
 * @package log_wp_sql_queries
 */

namespace log_wp_sql_queries;

if ( ! defined( 'SAVEQUERIES' ) || ! SAVEQUERIES ) {
	return;
}

add_action( 'shutdown', '\log_wp_sql_queries\log_queries' );
/**
 * Log WP SQL Queries to PHP error log.
 * Triggered by WP shutdown action.
 */
function log_queries() {
	global $wpdb;
	$session = md5( microtime() );
	foreach ( $wpdb->queries as $q ) {
		error_log( sprintf( 'WP SQL Query Log (%1$s): %2$s - (%3$s s) [Stack]: %4$s', $session, preg_replace( '/[\r\n]/', '', $q[0] ), $q[1], $q[2] ) );
	}
}
