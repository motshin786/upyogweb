<?php

/** block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Ultimate_Enqueue` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Enqueue' ) ) {
	/**
	 * Enqueue all admin or frontend scripts
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Ultimate_Enqueue {
		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Ultimate_Enqueue constructor.
		 * load admin site and frontend site script enqueue hook
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		}
		/**
		 * load frontend scripts
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function frontend_scripts( $hook ) {
			wp_enqueue_script( 'wp-dark-mode-ultimate', WP_DARK_MODE_ULTIMATE_ASSETS . '/js/frontend.js', [],
				WP_DARK_MODE_ULTIMATE_VERSION, true );
		}

		/**
		 * Load admin scripts
		 *
		 * @param $hook current page
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function admin_scripts( $hook ) {
			if ( 'toplevel_page_wp-dark-mode-settings' == $hook ) {
				wp_enqueue_script('wp-dark-mode-ultimate', WP_DARK_MODE_ULTIMATE_ASSETS . '/js/admin.min.js', [ 'wp-dark-mode-admin' ], WP_DARK_MODE_ULTIMATE_VERSION, true);
			}

		}
		/**
		 * Singleton instance WP_Dark_Mode_Ultimate_Enqueue class
		 *
		 * @return WP_Dark_Mode_Ultimate_Enqueue|null
		 * @version 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}
}
/**
 * kick out the class
 *
 * @version 1.0.0
 */
WP_Dark_Mode_Ultimate_Enqueue::instance();





