<?php
use WP_Dark_Mode_Ultimate\FixCSS;

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Ultimate_Hooks` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Hooks' ) ) {
	/**
	 * Load admin site and user site important hook.
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Ultimate_Hooks {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Ultimate_Hooks constructor.
		 *
		 * load admin site and frontend site active and filter hook.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {

			if ( 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_color', 'customize_colors', 'off' ) ) {
				add_filter( 'wp_dark_mode_bg_color', [ $this, 'darkmode_bg_color' ] );
				add_filter( 'wp_dark_mode_text_color', [ $this, 'darkmode_text_color' ] );
				add_filter( 'wp_dark_mode_link_color', [ $this, 'darkmode_link_color' ] );
			}

			add_filter( 'wp_dark_mode_ultimate_active', [ $this, 'is_ultimate_active' ] );

			add_action( 'wp_head', [ $this, 'custom_css' ] );

			/** add menu item */
			if ( 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'enable_menu_switch', 'off' ) ) {
				$switch_menus = (array) wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_menus', [] );

				if ( ! empty( $switch_menus ) ) {
					foreach ( $switch_menus as $switch_menu ) {
						add_filter( 'wp_nav_menu_' . $switch_menu . '_items', [ $this, 'add_switch_to_menu' ], 10 );
					}
				}
			}

			add_filter( 'cron_schedules', [ $this, 'cron_schedules' ] );
			add_action( 'init', [ $this, 'init_cron_job' ] );
			add_action( 'wp_dark_mode_send_email_reporting', [ $this, 'send_email_reporting' ] );

			$performance_mode = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_performance', 'performance_mode', 'off' );
			if ( ! is_admin() && $performance_mode ) {
				add_filter( 'script_loader_tag', [ $this, 'add_asyncdefer_attribute' ], 10, 2 );
			}

			add_filter( 'wp_dark_mode_performance_mode', [ $this, 'performance_mode' ]);

			// admin_init
			add_action( 'admin_init', [ $this, 'admin_init' ] );

		}
		/**
		 * get performance setting value
		 *
		 * @return bool
		 * @version 1.0.0
		 */
		public function performance_mode() {
			return 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_performance', 'performance_mode', 'off' );
		}
		/**
		 * Filters the HTML script tag of an enqueued script.
		 *
		 * if the unique handle/name of the registered script has 'async' in it
		 * return the tag with the async attribute
		 *
		 * if the unique handle/name of the registered script has 'defer' in it
		 * return the tag with the defer attribute
		 *
		 * @param string $tag The <script> tag for the enqueued script.
		 * @param string $handle The script's registered handle.
		 *
		 * @return string $tag
		 * @version 1.0.0
		 */
		public function add_asyncdefer_attribute( $tag, $handle ) {

			// if the unique handle/name of the registered script has 'async' in it
			if ( strpos( $handle, 'async' ) !== false ) {
				// return the tag with the async attribute
				return str_replace( '<script ', '<script async ', $tag );
			} // if the unique handle/name of the registered script has 'defer' in it
			else if ( strpos( $handle, 'defer' ) !== false ) {
				// return the tag with the defer attribute
				return str_replace( '<script ', '<script defer ', $tag );
			} // otherwise skip
			else {
				return $tag;
			}
		}
		/**
		 * Set cron schedules time.
		 *
		 * This Cron job will work once a month.
		 *
		 * Filter description
		 * The filter accepts an array of non-default cron schedules in arrays (an array of arrays). The outer array has a key that is the name of the schedule (for example, ‘weekly’). The value is an array with two keys, one is ‘interval’ and the other is ‘display’.
		 * The ‘interval’ is a number in seconds of when the cron job shall run. So, for a hourly schedule, the ‘interval’ value would be 3600 or 60*60. For for a weekly schedule, the ‘interval’ value would be 60*60*24*7 or 604800.
		 * The ‘display’ is the description of the non-default cron schedules. For the ‘weekly’ key, the ‘display’ may be __(‘Once Weekly’).
		 *
		 * @param array $new_schedules An array of non-default cron schedule arrays. Default empty.
		 *
		 * @return array
		 * @version 1.0.0
		 */
		public function cron_schedules( $schedules ) {

			$schedules['monthly'] = [
				'interval' => 2635200,
				'display'  => __( 'Once a month', 'wp-dark-mode-ultimate'),
			];

			return $schedules;
		}
		/**
		 * Init cron job
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function init_cron_job() {

			$analytics       = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'enable_analytics', 'off' );
			$email_reporting = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'email_reporting', 'off' );

			$hook = 'wp_dark_mode_send_email_reporting';

			if ( $analytics && $email_reporting ) {
				$frequency = wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'reporting_frequency', 'weekly' );

				$schedule = wp_get_schedule( $hook );

				// If settings changed clear previous hook
				if ( $schedule != $frequency ) {
					wp_clear_scheduled_hook( $hook );
				}

				// Add hook event
				if ( ! wp_next_scheduled( $hook ) ) {
					wp_schedule_event( time(), $frequency, $hook );
				}
			} else {
				wp_clear_scheduled_hook( $hook );
			}

		}
		/**
		 * Send dark mode visits reporting email.
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function send_email_reporting() {

			$frequency = wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'reporting_frequency', 'weekly' );

			if ( 'daily' == $frequency ) {
				$length = 1;
			} elseif ( 'monthly' == $frequency ) {
				$length = 30;
			} else {
				$length = 7;
			}

			$visits = get_option( 'wp_dark_mode_visits' );
			$usages = get_option( 'wp_dark_mode_usage' );

			$visits = array_slice( $visits, - $length, $length, true );

			$values = [];

			if ( ! empty( $visits ) ) {
				foreach ( $visits as $date => $visit ) {
					$usage = ! empty( $usages[ $date ] ) ? $usages[ $date ] : 0;

					if ( $visit < 0 ) {
						$visit = 0;
					}

					if ( $usage < 0 ) {
						$usage = 0;
					}

					$values[ $date ] = ceil( ( $usage / $visit ) * 100 );

				}
			}

			$email   = wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'reporting_email', get_option( 'admin_email' ) );
			$subject = wp_dark_mode_get_settings( 'wp_dark_mode_analytics_reporting', 'reporting_email_subject',
				__( 'Weekly Dark Mode Usage Summary of ', 'wp-dark-mode-ultimate' ) . get_bloginfo( 'name' ) );

			$headers = [ 'Content-Type: text/html; charset=UTF-8' ];

			$user      = get_user_by( 'email', $email );
			$user_name = ! empty( $user->display_name ) ? $user->display_name : 'There';

			ob_start();
			wp_dark_mode_ultimate()->get_template( 'usage-email', [
				'values'    => $values,
				'user_name' => $user_name,
				'frequency' => $frequency,
				'length'    => $length,
			] );
			$message = ob_get_clean();

			wp_mail( $email, $subject, $message, $headers );

		}


		/**
		 * Add dark mode switch to menu
		 *
		 * @param array $items all menu
		 *
		 * @return array
		 * @version 1.0.0
		 */
		public function add_switch_to_menu( $items ) {
			$style = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_style', '1' );

			if ( in_array( $style, [ 14, 15, 16, 17 ] ) ) {
				return $items;
			}

			$menu_item_li = sprintf( '<li class="wp-dark-mode-menu-item" id="wp-dark-mode-menu-item"><a href="#darkmode_switcher"> %1$s</a></li>', do_shortcode( '[wp_dark_mode style=' . $style . ']' ) );

			$items .= $menu_item_li;

			return $items;

		}
		/**
		 * Custom css method
		 *
		 * @version 1.0.0
		 */
		public function custom_css() {
			if ( ! wp_dark_mode_enabled() ) {
				return;
			}

			if ( ! wp_dark_mode()->is_ultimate_active() ) {
				return;
			}

			$custom_css = wp_dark_mode_get_settings( 'wp_dark_mode_custom_css', 'custom_css' );

			$fix_css    = new FixCSS();
			$custom_css = $fix_css->add_selector( $custom_css, 'html.wp-dark-mode-active' );

			try {
				printf( '<style id="wp-dark-mode-custom-css">%s</style>', esc_html( $custom_css ) );
			} catch ( Exception $exception ) {
				printf( '' );
			}

		}
		/**
		 * Check ultimate license is valid or not
		 *
		 * @return boolean
		 * @version 1.0.0
		 */
		public function is_ultimate_active() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_ultimate_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Lifetime' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Yearly' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 1 Site' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 50 Sites' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Ultimate Yearly - 1Site' );

			return $is_ultimate_plan;
		}
		/**
		 * Get dark mode bg color option value
		 *
		 * @return string
		 * @version 1.0.0
		 */
		public function darkmode_bg_color( $color ) {
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_bg_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_bg_color' );
			}

			return $color;
		}
		/**
		 * Get dark mode text color value
		 *
		 * @return string
		 * @version 1.0.0
		 */
		public function darkmode_text_color( $color ) {
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_text_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_text_color' );
			}

			return $color;
		}
		/**
		 * Get dark mode link color value
		 *
		 * @return string
		 * @version 1.0.0
		 */
		public function darkmode_link_color( $color ) {
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_link_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_link_color' );
			}

			return $color;
		}
		/**
		 * Check ultimate license is valid or not help by title
		 *
		 * @return boolean
		 * @version 1.0.0
		 */
		public function wp_dark_mode_css_apply() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_ultimate_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Lifetime' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Yearly' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 1 Site' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 50 Sites' )
								|| $wp_dark_mode_license->is_valid_by( 'title', 'Ultimate Yearly - 1Site' );

			return $wp_dark_mode_license->is_valid() && $is_ultimate_plan;
		}


		/**
		 * Singleton instance WP_Dark_Mode_Ultimate_Hooks class
		 *
		 * @return WP_Dark_Mode_Ultimate_Hooks|null
		 * @version 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}


		/**
		 * admin_init
		 * redirect to license page
		 */
		public function admin_init() {
			$wpdm_license_redirected = boolval(get_option( 'wpdm_license_redirected_ultimate' ));

			if ( ! $wpdm_license_redirected ) {
				update_option( 'wpdm_license_redirected_ultimate', true );
				wp_redirect( admin_url( 'admin.php?page=wp-dark-mode-license' ) );
				exit;
			}
		}
	}
}
/**
 * kick out the class
 *
 * @version 1.0.0
 */
WP_Dark_Mode_Ultimate_Hooks::instance();

