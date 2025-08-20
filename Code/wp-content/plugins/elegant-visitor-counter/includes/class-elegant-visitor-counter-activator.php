<?php
/**
 * Fired during plugin activation
 *
 * @link       https://wordpress.org/plugins/elegant-visitor-counter/
 * @since      1.0.0
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 * @author     Your Name <email@example.com>
 */
class elegant_visitor_counter_Activator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		global $evc_db_version;
		$evc_log_table = $wpdb->prefix . 'evc_log';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sql = "CREATE TABLE IF NOT EXISTS $evc_log_table (`LogID` int(11) NOT NULL AUTO_INCREMENT, `IP` varchar(20) NOT NULL, `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`LogID`));";
		dbDelta( $sql );
		add_option( 'evc_db_version', $evc_db_version );
	}
}
