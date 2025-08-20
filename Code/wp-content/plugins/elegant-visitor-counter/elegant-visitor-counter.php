<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link
 * @since             3.1
 * @package           elegant_visitor_counter
 *
 * @wordpress-plugin
 * Plugin Name:       Elegant Visitor Counter
 * Plugin URI:
 * Description:       Elegant visitor counter lets you count the visitors of the website along with counter of post view; which allows you to count the visitor of a specific post.
 * Version:           3.1
 * Author:            Sujan Karki
 * Author URI:        http://sujankarki.info.np
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elegant-visitor-counter
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
/**
 * Currently plugin version.
 * Start at version 2.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ELEGANT_VISITOR_COUNTER_VERSION', '3.1' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elegant-visitor-counter-activator.php
 */
global $evc_db_version;
$evc_db_version = '1';
function activate_elegant_visitor_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elegant-visitor-counter-activator.php';
	elegant_visitor_counter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elegant-visitor-counter-deactivator.php
 */
function deactivate_elegant_visitor_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elegant-visitor-counter-deactivator.php';
	elegant_visitor_counter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elegant_visitor_counter' );
register_deactivation_hook( __FILE__, 'deactivate_elegant_visitor_counter' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elegant-visitor-counter.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elegant_visitor_counter() {

	$plugin = new Elegant_visitor_counter();
	$plugin->run();

}

run_elegant_visitor_counter();