<?php
/** prevent direct access */
defined( 'ABSPATH' ) || exit( );
/**
 * check if class `WP_Dark_Mode_Pro` not exists yet
 *
 * @version 1.0.0
 */

if ( ! class_exists( 'WP_Dark_Mode_Pro' ) ) {
	/**
	 * Sets up and initializes the plugin.
	 * Main initiation class
	 *
	 * @since 1.0.0
	 */
	final class WP_Dark_Mode_Pro {
		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;
		/**
		 * Minimum PHP version required
		 *
		 * @var string
		 */
		private static $min_php = '5.6.0';

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @return void
		 * @since  1.0.0
		 * @access public
		 */
		public function __construct() {

			if ( $this->check_environment() ) {

				$this->load_files();

				if ( ! defined( 'WP_DARK_MODE_ULTIMATE_VERSION' ) ) {

					add_action( 'admin_init', [ $this, 'activation_redirect' ] );
					add_action( 'admin_notices', [ $this, 'print_notices' ], 15 );
					add_filter( 'plugin_action_links_' . plugin_basename( WP_DARK_MODE_PRO_FILE ), [ $this, 'plugin_action_links' ] );

					$this->appsero_init_tracker_wp_dark_mode_pro();
				}

				add_action( 'init', [ $this, 'lang' ] );
			}
		}

		/**
		 * redirect to settings page after activation the plugin.
		 *
		 * @return redirect
		 * @version 1.0.0
		 */
		public static function activation_redirect() {

			if ( ! get_option( 'wpdm_license_redirected_pro', false ) ) {
				update_option( 'wpdm_license_redirected_pro', true );

				wp_safe_redirect( admin_url( 'admin.php?page=wp-dark-mode-license' ) );
			}
		}

		/**
		 * Initialize the plugin tracker
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function appsero_init_tracker_wp_dark_mode_pro() {

			if ( ! class_exists( 'Appsero\Client' ) ) {
				if ( file_exists( WP_PLUGIN_DIR . '/wp-dark-mode/includes/appsero/src/Client.php' ) ) {
					require_once WP_PLUGIN_DIR . '/wp-dark-mode/includes/appsero/src/Client.php';
				} elseif ( file_exists( WP_PLUGIN_DIR . '/wp-dark-mode/appsero/Client.php' ) ) {
					require_once WP_PLUGIN_DIR . '/wp-dark-mode/appsero/Client.php';
				} else {
					return;
				}
			}

			// error_log( 'PRO' );
			$client = new \Appsero\Client( '44e81435-c0f1-4149-983b-eb8d9f7a9a66', 'WP Dark Mode Pro', WP_DARK_MODE_PRO_FILE );

			// Active insights.
			$client->insights()->hide_notice()->init();

			// Active automatic updater.
			$client->updater();

			global $wp_dark_mode_license;
			$wp_dark_mode_license = $client->license();

			// Active license page and checker.
			$args = [
				'type'        => 'submenu',
				'menu_title'  => 'License Activation',
				'page_title'  => 'License Activation - WP Dark Mode',
				'menu_slug'   => 'wp-dark-mode-license',
				'parent_slug' => 'wp-dark-mode-settings',
				'position'    => 4,
			];
			$client->license()->add_settings_page( $args );

		}

		/**
		 * Ensure theme and server variable compatibility
		 *
		 * @return boolean
		 * @since  1.0.0
		 * @access private
		 */
		private function check_environment() {

			$return = true;

			/** Check the PHP version compatibility */
			if ( version_compare( PHP_VERSION, self::$min_php, '<=' ) ) {
				$return = false;

				$notice = sprintf( esc_html__( 'Unsupported PHP version Min required PHP Version: "%s"', 'wp-dark-mode-pro' ),
					self::$min_php );
			}

			$activated_plugin = get_option( 'active_plugins' );

			$is_dark_mode_activated = array_search( 'wp-dark-mode/plugin.php', $activated_plugin );

			if ( ! $is_dark_mode_activated ) {

				if ( defined( 'WP_DARK_MODE_ULTIMATE_VERSION' ) ) {
					return false;
				}

				$return = false;

				$notice
					= wp_sprintf( /* translators: 1: Plugin name 2: WP Dark Mode 3: Elementor installation link */ __( '%1$s requires %2$s to be installed and activated to function properly. %3$s',
					'wp-dark-mode-pro' ), '<strong>' . __( 'WP Dark Mode PRO', 'wp-dark-mode-pro' ) . '</strong>',
					'<strong>' . __( 'WP Dark Mode', 'wp-dark-mode-pro' ) . '</strong>',
					'<a href="' . esc_url( admin_url( 'plugin-install.php?s=WP Dark Mode&tab=search&type=term' ) ) . '">'
					. __( 'Please click on this link and install WP Dark Mode', 'wp-dark-mode-pro' ) . '</a>' );
			} else {
				$return = true;
			}
			// elseif ( ! defined( 'WP_DARK_MODE_VERSION' ) || WP_DARK_MODE_PRO_VERSION <= '4.0.0' ) {
			// 	$return = false;

			// 	$notice
			// 		= 'WP Dark Mode PRO - v4.0 requires <a href="' . admin_url('?page=install-wp-dark-mode') . '">WP Dark Mode - v4.0 or later</a> to function properly. Please, Update <a class="button-primary" href="' . admin_url('?page=install-wp-dark-mode') . '">WP Dark Mode</a>';

			// }

			/** Add notice and deactivate the plugin if the environment is not compatible */
			if ( ! $return ) {

				add_action( 'admin_notices', function () use ( $notice ) { ?>
					<div class="notice is-dismissible notice-error">
						<p><?php echo $notice; ?></p>
					</div>
					<?php
				} );

				return $return;
			} else {
				return $return;
			}

		}
		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function load_files() {
			include_once WP_DARK_MODE_PRO_INCLUDES . '/class-enqueue.php';
			include_once WP_DARK_MODE_PRO_INCLUDES . '/functions.php';
			include_once WP_DARK_MODE_PRO_INCLUDES . '/class-widget.php';
			include_once WP_DARK_MODE_PRO_INCLUDES . '/class-hooks.php';

			if ( is_admin() ) {
				include_once WP_DARK_MODE_PRO_INCLUDES . '/class-admin.php';
			}
		}

		/**
		 * Initialize plugin for localization
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function lang() {
			load_plugin_textdomain( 'wp-dark-mode-pro', false, dirname( plugin_basename( WP_DARK_MODE_PRO_FILE ) ) . '/languages/' );
		}

		/**
		 * Plugin action links
		 * plugin_action_links method use for show  WP Dark Mode license and settings in plugin.php
		 *
		 * @param   array $links
		 *
		 * @return array
		 */
		public function plugin_action_links( $links ) {

			$links[] = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=wp-dark-mode-settings' ),
				__( 'Settings', 'wp-dark-mode-pro' ) );

			global $wp_dark_mode_license;

			if ( $wp_dark_mode_license && ! $wp_dark_mode_license->is_valid() ) {
				$links[] = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=wp-dark-mode-license' ),
					__( 'Activate License', 'wp-dark-mode-pro' ) );
			}

			return $links;
		}


		/**
		 * Get the template path.
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function template_path() {
			return apply_filters( 'wp_dark_mode_template_path', 'wp-dark-mode/' );
		}

		/**
		 * Returns path to template file.
		 *
		 * @param   null          $name
		 * @param   boolean|array $args
		 *
		 * @return bool|string
		 * @since 1.0.0
		 */
		public function get_template( $name = null, $args = false ) {
			if ( ! empty( $args ) && is_array( $args ) ) {
				extract( $args );
			}

			$template = locate_template( $this->template_path() . $name . '.php' );

			if ( ! $template ) {
				$template = WP_DARK_MODE_PRO_TEMPLATES . "/$name.php";
			}

			if ( file_exists( $template ) ) {
				include $template;
			} else {
				return false;
			}
		}

		/**
		 * add admin notices
		 *
		 * @param           $class
		 * @param           $message
		 *
		 * @return void
		 */
		public function add_notice( $class, $message ) {

			$notices = get_option( sanitize_key( 'wp_dark_mode_pro_notices' ), [] );

			if ( is_string( $message ) && is_string( $class ) && ! wp_list_filter( $notices, [ 'message' => $message ] ) ) {

				$notices[] = [
					'message' => $message,
					'class'   => $class,
				];

				update_option( sanitize_key( 'wp_dark_mode_pro_notices' ), $notices );
			}

		}

		/**
		 * Print the admin notices
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_notices() {

			if ( defined( 'WP_DARK_MODE_ULTIMATE_VERSION' ) ) {
				return;
			}

			$notices = get_option( sanitize_key( 'wp_dark_mode_pro_notices' ), [] );

			foreach ( $notices as $notice ) {
				?>
				<div class="notice notice-<?php echo $notice['class']; ?>">
					<?php echo $notice['message']; ?>
				</div>
				<?php
				update_option( sanitize_key( 'wp_dark_mode_pro_notices' ), [] );
			}
		}

		/**
		 * Main WP_Dark_Mode Instance.
		 *
		 * Ensures only one instance of WP_Dark_Mode is loaded or can be loaded.
		 *
		 * @return WP_Dark_Mode_Pro - Main instance.
		 * @since 1.0.0
		 * @static
		 */
		public static function instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}


	/** if function `wp_dark_mode_pro` doesn't exists yet. */
	if ( ! function_exists( 'wp_dark_mode_pro' ) ) {
		function wp_dark_mode_pro() {
			return WP_Dark_Mode_Pro::instance();
		}
	}
	/**
	 * kick out the class
	 */
	// wp_die('erere');
	wp_dark_mode_pro();

}

