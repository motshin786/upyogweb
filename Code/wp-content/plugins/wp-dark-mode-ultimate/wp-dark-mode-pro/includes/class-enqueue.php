<?php

/** block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Pro_Enqueue` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Pro_Enqueue' ) ) {
	/**
	 * Enqueue all admin or frontend scripts
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Pro_Enqueue {
		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Pro_Enqueue constructor.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ], 11 );
		}

		/**
		 * Load frontend Scripts
		 *
		 * @param $hook
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function frontend_scripts( $hook ) {

			if ( ! wp_dark_mode_enabled() ) {
				return;
			}

			/** wp-dark-mode frontend js */
			wp_enqueue_script(
				'wp-dark-mode-pro-frontend',
				WP_DARK_MODE_PRO_ASSETS . '/js/frontend.min.js',
				[ 'wp-util' ],
				WP_DARK_MODE_PRO_VERSION,
				true
			);

			/** localize array */
			$localize_array = [
				'pluginUrl'            => WP_DARK_MODE_PRO_URL,
				'analytics'            => 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'enable_analytics', 'on' ),
				'match_os_mode'        => 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_general', 'enable_os_mode', 'on' ),
				'time_based_mode'      => 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_advanced', 'time_based_mode', 'off' ),
				'start_at'             => wp_dark_mode_get_settings( 'wp_dark_mode_advanced', 'start_at' ),
				'end_at'               => wp_dark_mode_get_settings( 'wp_dark_mode_advanced', 'end_at' ),
				'dynamic_content_mode' => 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_accessibility', 'dynamic_content_mode', 'off' ),
				'sunset_mode'          => 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_advanced', 'sunset_mode', 'off' ),
			];

			wp_localize_script( 'wp-dark-mode-frontend', 'wpDarkModePro', $localize_array );
			wp_localize_script( 'wp-dark-mode-pro-frontend', 'wpDarkModePro', $localize_array );

		}

		/**
		 * Load addmin scripts
		 *
		 * @param string $hook current page.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function admin_scripts( $hook ) {

			/** wp-dark-mode-pro admin css */
			wp_enqueue_style( 'wp-dark-mode-pro-admin', WP_DARK_MODE_PRO_ASSETS . '/css/admin.css', false, WP_DARK_MODE_PRO_VERSION );

			/** wp-dark-mode-pro admin js */
			wp_enqueue_script( 'wp-dark-mode-pro-admin', WP_DARK_MODE_PRO_ASSETS . '/js/admin.min.js', [ 'wp-dark-mode-admin' ], WP_DARK_MODE_PRO_VERSION, true );

			global $current_screen, $wp_dark_mode_license;

			$current_screen = get_current_screen();

			wp_localize_script(
				'wp-dark-mode-admin',
				'wpDarkModeProAdmin',
				[
					'ajax_url'         => admin_url( 'admin-ajax.php' ),
					'pluginUrl'        => WP_DARK_MODE_PRO_URL,
					'is_valid_license' => $this->wp_dark_mode_handle_content(),
				]
			);

		}

		/**
		 * Singleton instance WP_Dark_Mode_Pro_Enqueue class
		 *
		 * @return WP_Dark_Mode_Pro_Enqueue|null
		 * @version 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
		/**
		 * Premium license is valid or not
		 *
		 * @return bool
		 * @version 1.0.0
		 */
		public function wp_dark_mode_handle_content() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			return $wp_dark_mode_license->is_valid();
		}

	}
}
/**
 * kick out the class
 */
WP_Dark_Mode_Pro_Enqueue::instance();





