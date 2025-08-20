<?php
/**
 * https://wppool.dev/wp-dark-mode
 *
 * @package WP_Dark_Mode_Pro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit();
// Define constants.
if ( ! defined( 'WP_DARK_MODE_PRO_VERSION' ) ) {

	define( 'WP_DARK_MODE_PRO_VERSION', '3.0.4' );
	define( 'WP_DARK_MODE_PRO_FILE', __FILE__ );
	define( 'WP_DARK_MODE_PRO_PATH', dirname( WP_DARK_MODE_PRO_FILE ) );
	define( 'WP_DARK_MODE_PRO_INCLUDES', WP_DARK_MODE_PRO_PATH . '/includes/' );
	define( 'WP_DARK_MODE_PRO_URL', plugins_url( '', WP_DARK_MODE_PRO_FILE ) );
	define( 'WP_DARK_MODE_PRO_ASSETS', WP_DARK_MODE_PRO_URL . '/assets/' );
	define( 'WP_DARK_MODE_PRO_TEMPLATES', WP_DARK_MODE_PRO_PATH . '/templates/' );

	if ( ! defined( 'WP_DARK_MODE_ULTIMATE_VERSION' ) ) {
		// Register activation hook if WP Dark Mode Ultimate is not active.
		register_activation_hook(
			__FILE__,
			function () {
				require WP_DARK_MODE_PRO_INCLUDES . 'class-install.php';
			}
		);
	}

	// Load plugin base file directly if WP Dark Mode Ultimate is active.
	if ( defined('WP_DARK_MODE_ULTIMATE_VERSION') ) {
		require WP_DARK_MODE_PRO_INCLUDES . 'class-base.php';
	} else {
		// Load plugin base file after WP Dark Mode is loaded.
		add_action( 'plugins_loaded', function () {
			require WP_DARK_MODE_PRO_INCLUDES . 'class-base.php';
		}, 0 );
	}
}