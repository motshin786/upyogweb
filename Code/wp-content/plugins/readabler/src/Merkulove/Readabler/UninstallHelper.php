<?php
/**
 * Readabler
 * Web accessibility for Your WordPress site.
 * Exclusively on https://1.envato.market/readabler
 *
 * @encoding        UTF-8
 * @version         1.6.5
 * @copyright       (C) 2018 - 2023 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 * @license         Envato License https://1.envato.market/KYbje
 **/

namespace Merkulove\Readabler;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: UninstallHelper class contain main plugin logic.
 * @since 1.0.0
 **/
final class UninstallHelper {

	/**
	 * The one true UninstallHelper.
	 *
     * @since 1.0.0
     * @access private
	 * @var UninstallHelper
	 **/
	private static $instance;

    /**
     * Implement plugin uninstallation.
     *
     * @param string $uninstall_mode - Uninstall mode: plugin, plugin+settings, plugin+settings+data
     *
     * @since  1.0.0
     * @access public
     *
     * @return void
     **/
    public function uninstall( $uninstall_mode ) {

        /** Remove Plugin and Settings. */
        if ( 'plugin' === $uninstall_mode ) {

			delete_option( 'mdp-readabler-grace' );

        /** Remove Plugin and Settings. */
        } elseif ( 'plugin+settings' === $uninstall_mode ) {

        /** Remove Plugin, Settings, and all created data. */
        } elseif ( 'plugin+settings+data' === $uninstall_mode ) {

			self::remove_table();

        }

    }

	/**
	 * Remove the table.
	 *
	 * @return void
	 */
	private static function remove_table(): void {

		global $wpdb;

		$table_name = $wpdb->prefix . 'readabler_usage_analytics';

		// Check if the table already exists.
		$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
		if ( $wpdb->get_var( $query ) === $table_name ) {
			/** @noinspection SqlNoDataSourceInspection */
			$sql = "DROP TABLE $table_name;";
			$wpdb->query( $sql );
		}

	}

	/**
	 * Main UninstallHelper Instance.
	 * Insures that only one instance of UninstallHelper exists in memory at any one time.
	 *
	 * @static
     * @since 1.0.0
     * @access public
     *
	 * @return UninstallHelper
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

}
