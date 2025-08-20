<?php

// block direct access
defined( 'ABSPATH' ) || exit;

/** check if class `WP_Dark_Mode_PRO_Install` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_PRO_Install' ) ) {
	/**
	 * Class is loaded when the plugin is activated.
	 * The class basically inserts the default data of the plugin.
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_PRO_Install {
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
		}

		/**
		 * Update default data
		 *
		 * @return void
		 * @since 2.0.8
		 */
		private static function create_default_data() {

			update_option( 'wp_dark_mode_pro_version', WP_DARK_MODE_PRO_VERSION );

			$install_date = get_option( 'wp_dark_mode_pro_install_time' );

			if ( empty( $install_date ) ) {
				update_option( 'wp_dark_mode_pro_install_time', time() );
			}

		}
		/**
		 * Singleton instance WP_Dark_Mode_PRO_Install class
		 *
		 * @return WP_Dark_Mode_PRO_Install|null
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
			delete_option( 'wpdm_license_redirected_pro' );
		}

	}

	/**
	 * kick out the class
	 */
	WP_Dark_Mode_PRO_Install::instance();
}

