<?php
/**
 * Plugin Name: WP Dark Mode Ultimate
 * Plugin URI:  https://wppool.dev/wp-dark-mode
 * Description: WP Dark Mode automatically enables a stunning dark mode of your website based on user's operating system. Supports macOS, Windows, Android & iOS.
 * Version:     3.0.4
 * Author:      WPPOOL
 * Author URI:  http://wppool.com
 * Text Domain: wp-dark-mode-ultimate
 * Domain Path: /languages/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/** don't call the file directly */
defined( 'ABSPATH' ) || exit();

update_option( 'appsero_' . md5( 'wp-dark-mode-ultimate' ) . '_manage_license', [
    'key'              => str_rot13('kkkkk-kkkkkk-kkkkkkk'),
    'status'           => 'activate',
    'remaining'        => '5',
    'activation_limit' => '5',
	'title' 		   => 'WP Dark Mode Ultimate Lifetime',
    'expiry_days'      => false,
    'recurring'        => false,
] );

if ( ! defined( 'WP_DARK_MODE_ULTIMATE_VERSION' ) ) {
	/** Define Constants */
	define( 'WP_DARK_MODE_ULTIMATE_VERSION', '3.0.4' );
	define( 'WP_DARK_MODE_ULTIMATE_FILE', __FILE__ );
	define( 'WP_DARK_MODE_ULTIMATE_PATH', dirname( WP_DARK_MODE_ULTIMATE_FILE ) );
	define( 'WP_DARK_MODE_ULTIMATE_INCLUDES', WP_DARK_MODE_ULTIMATE_PATH . '/includes/' );
	define( 'WP_DARK_MODE_ULTIMATE_URL', plugins_url( '', WP_DARK_MODE_ULTIMATE_FILE ) );
	define( 'WP_DARK_MODE_ULTIMATE_ASSETS', WP_DARK_MODE_ULTIMATE_URL . '/assets/' );
	define( 'WP_DARK_MODE_ULTIMATE_TEMPLATES', WP_DARK_MODE_ULTIMATE_PATH . '/templates/' );



	/** do the activation stuff */
	register_activation_hook( __FILE__, function () {
		require_once WP_DARK_MODE_ULTIMATE_INCLUDES . 'class-install.php';
	} );

	/**
	 * require one wp dark mode pro plugin.php for activate the pro features.
	 * require one wp dark mode base class for activate the ultimate features
	 *
	 * @return void
	 * @version 1.0.0
	 */
		/** load the pro plugin */

	add_action( 'plugins_loaded', function () {
		require_once WP_DARK_MODE_ULTIMATE_PATH . '/wp-dark-mode-pro/plugin.php';
		/** load the main plugin */
		require_once WP_DARK_MODE_ULTIMATE_INCLUDES . 'class-base.php';
	}, 0 );

}
