<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Pro_Shortcode` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Pro_Shortcode' ) ) {
	/**
	 * Register WP dark Mode switcher shortcode.
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Pro_Shortcode {
		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Pro_Shortcode constructor.
		 * load add_shortcode action hook.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {
			add_shortcode( 'wp_dark_mode_switch', [ $this, 'render_dark_mode_btn' ] );
		}

		/**
		 * render the dark mode switcher button
		 * load switch button template.
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function render_dark_mode_btn( $atts ) {

			if ( ! wp_dark_mode_enabled() ) {
				return false;
			}

			$atts = shortcode_atts(
				[
					'floating' => 'no',
					'style'    => 1,
				],
				$atts
			);

			if ( ! $this->wp_dark_mode_change_content() ) {
				return '';
			}

			ob_start();
			if ( $atts['style'] == 14 && 'no' == $atts['floating'] ) {
				wp_dark_mode()->get_template( 'btn-2', $atts );
			} elseif ( file_exists( WP_DARK_MODE_TEMPLATES . "/btn-{$atts['style']}.php" ) ) {
				wp_dark_mode()->get_template( "btn-{$atts['style']}", $atts );
			} else {
				wp_dark_mode()->get_template( 'btn-1', $atts );
			}

			return ob_get_clean();
		}
		/**
		 * Create license checking method
		 * Its use to check the liscense is valid or not
		 * Its return if the license is valid return true or not valid return false
		 *
		 * @return bool
		 * @version 1.0.0
		 */
		public function wp_dark_mode_change_content() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			return $wp_dark_mode_license->is_valid();
		}

		/**
		 * Singleton instance WP_Dark_Mode_Pro_Shortcode class
		 *
		 * @return WP_Dark_Mode_Pro_Shortcode|null
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
 */
WP_Dark_Mode_Pro_Shortcode::instance();

