<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://wordpress.org/plugins/elegant-visitor-counter/
 * @since      1.0.0
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 * @author     Your Name <email@example.com>
 */
class elegant_visitor_counter_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;
		$evc_log_table = $wpdb->prefix . "evc_log";
		//Delete any options that's stored also?
		delete_option( 'evc_db_version' );
		$wpdb->query( "DROP TABLE IF EXISTS $evc_log_table" );
	}

}
