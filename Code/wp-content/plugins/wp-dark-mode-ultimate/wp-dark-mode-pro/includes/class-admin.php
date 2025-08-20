<?php
/**
 * WP Dark Mode Pro Admin
 *
 * @package WP Dark Mode
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Class WP_Dark_Mode_Admin
 *
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Dark_Mode_Pro_Admin' ) ) {
	/**
	 * Its use to display notices and show how much user use dark mode chart bar.
	 * Work on admin site
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Pro_Admin {
		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Admin constructor.
		 *
		 * load action hook.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_init', [ $this, 'display_notices' ], 999 );

			// usage chart
			add_action( 'wp_ajax_get_visit_usage', [ $this, 'get_visit_usage' ] );

		}
		/**
		 * How much percentage of users use dark mode each day.
		 * Get how many user use dark mode
		 * display chart bar
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function get_visit_usage() {
			$length = ! empty( $_REQUEST['length'] ) ? intval( $_REQUEST['length'] ) : 30;

			$visits = get_option( 'wp_dark_mode_visits' );
			$usages = get_option( 'wp_dark_mode_usage' );

			$visits = array_slice( $visits, - $length, $length, true );

			$values = [];
			$labels = [];

			if ( ! empty( $visits ) ) {
				foreach ( $visits as $date => $visit ) {
					$usage = ! empty( $usages[ $date ] ) ? $usages[ $date ] : 0;

					if ( $visit < 0 ) {
						$visit = 0;
					}

					if ( $usage < 0 ) {
						$usage = 0;
					}

					$labels[] = $date;
					$values[] = ceil( ( $usage / $visit ) * 100 );

				}
			}

			wp_send_json_success(
				[
					'labels' => $labels,
					'values' => $values,
				]);

		}
		/**
		 * Display wp dark mode license not valid notices
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function display_notices() {

			if ( class_exists( 'WP_Dark_Mode_Ultimate' ) ) {
				return;
			}

			global $wp_dark_mode_license;

			if ( $wp_dark_mode_license && ! $wp_dark_mode_license->is_valid() ) {
				ob_start();
				wp_dark_mode()->get_template(
					'admin/license-notice',
					[
						'plugin_name' => 'WP Dark Mode PRO',
						'version'     => WP_DARK_MODE_VERSION,
					]
				);
				$notice_html = ob_get_clean();

				wp_dark_mode_pro()->add_notice( 'warning notice-large is-dismissible', $notice_html );
			}
		}

		/**
		 * Singleton instance WP_Dark_Mode_Admin class
		 *
		 * @return WP_Dark_Mode_Admin|null
		 * @version 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}

	/**
	 * kick out the class
	 */
	WP_Dark_Mode_Pro_Admin::instance();
}

