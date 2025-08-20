<?php

/** block direct access */
defined( 'ABSPATH' ) || exit;

/** check if class `WP_Dark_Mode_Ultimate_Install` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Install' ) ) {
	/**
	 * Class is loaded when the plugin is activated.
	 * The class basically inserts the default data of the plugin.
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Ultimate_Install {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Do the activation stuff
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function __construct() {
			self::create_default_data();
			$this->reset_redirection();
			$this->deactivate_pro_version();
		}


		/**
		 * update dark mode ultimate plugin default important option data
		 *
		 * @return void
		 * @since 2.0.8
		 */
		private static function create_default_data() {

			update_option( 'wp_dark_mode_ultimate_version', WP_DARK_MODE_ULTIMATE_VERSION );

			$install_date = get_option( 'wp_dark_mode_ultimate_install_time' );

			if ( empty( $install_date ) ) {
				update_option( 'wp_dark_mode_ultimate_install_time', time() );
			}

		}

		/**
		 * Singleton instance WP_Dark_Mode_Ultimate_Install class
		 *
		 * @return WP_Dark_Mode_Ultimate_Install|null
		 * @version 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Redirect to license page
		 *
		 * @return void
		 * @since 2.0.8
		 */
		private function reset_redirection() {
			delete_option('wpdm_license_redirected_ultimate');
		}



		/**
		 * Deactivate pro version if ultimate version is activated
		 */
		public static function deactivate_pro_version() {
			if ( is_plugin_active( 'wp-dark-mode-pro/plugin.php' ) ) {
				deactivate_plugins( 'wp-dark-mode-pro/plugin.php' );
			}
		}


	}
}
/**
 * kick out the class
 */
WP_Dark_Mode_Ultimate_Install::instance();