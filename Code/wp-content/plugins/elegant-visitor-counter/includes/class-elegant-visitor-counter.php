<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link
 * @since      1.0.0
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/includes
 * @author     Sujan Karki <regolithjk@gamil.com>
 */
class Elegant_visitor_counter {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      elegant_visitor_counter_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $elegant_visitor_counter The string used to uniquely identify this plugin.
	 */
	protected $elegant_visitor_counter;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ELEGANT_VISITOR_COUNTER_VERSION' ) ) {
			$this->version = ELEGANT_VISITOR_COUNTER_VERSION;
		} else {
			$this->version = '2.0.0';
		}
		$this->elegant_visitor_counter = 'elegant-elegant-visitor-counter';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - elegant_visitor_counter_Loader. Orchestrates the hooks of the plugin.
	 * - elegant_visitor_counter_i18n. Defines internationalization functionality.
	 * - elegant_visitor_counter_Admin. Defines all hooks for the admin area.
	 * - elegant_visitor_counter_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-elegant-visitor-counter-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-elegant-visitor-counter-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-elegant-visitor-counter-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-elegant-visitor-counter-public.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site for post count in single page.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-elegant-visitor-counter-post-count.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site for post count in single page.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-display-post-count-backend-listing.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site for post count in single page.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-elegant-visitor-counter-settings.php';


		$this->loader = new Elegant_visitor_counter_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the elegant_visitor_counter_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new elegant_visitor_counter_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    3.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new elegant_visitor_counter_Admin( $this->get_elegant_visitor_counter(), $this->get_version() );
		$plugin_public_post_view_backend = new Display_post_count_backend_listing( $this->get_elegant_visitor_counter(), $this->get_version() );
		$plugin_settings_backend = new Elegant_visitor_counter_settings( $this->get_elegant_visitor_counter(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public_post_view_backend, 'display_post_count_backend' );
		$this->loader->add_action( 'admin_menu', $plugin_settings_backend, 'evc_register_settings' );
		$this->loader->add_action( 'admin_init', $plugin_settings_backend, 'setup_field_total_color' );
		$this->loader->add_action( 'admin_init', $plugin_settings_backend, 'setup_field_evc_alignment' );
		$this->loader->add_action( 'admin_init', $plugin_settings_backend, 'setup_field_total_text_color' );
		$this->loader->add_action( 'admin_init', $plugin_settings_backend, 'setup_sections' );
		$this->loader->add_action( 'admin_post_truncate_evc_log', $plugin_settings_backend, 'truncate_evc_log_callback' );
		$this->loader->add_action( 'admin_post_nopriv_truncate_evc_log', $plugin_settings_backend, 'truncate_evc_log_callback' );
		$this->loader->add_filter( 'plugin_action_links_elegant-visitor-counter/elegant-visitor-counter.php', $plugin_admin, 'add_action_links' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Elegant_visitor_counter_Public( $this->get_elegant_visitor_counter(), $this->get_version() );
		$plugin_public_post_view = new Elegant_visitor_counter_post_count( $this->get_elegant_visitor_counter(), $this->get_version() );


		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'widgets_init', $plugin_public, 'visitor_counter_plugin_widget' );
		$this->loader->add_action( 'init', $plugin_public, 'evc_log_user' );

		$this->loader->add_shortcode( 'init', $plugin_public, 'evc_add_shortcode' );
		$this->loader->add_shortcode( 'visitor-counter', $plugin_public, 'shortcode_for_visitor_counter' );
		$this->loader->add_shortcode( 'post-counter', $plugin_public_post_view, 'get_post_view_count' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_elegant_visitor_counter() {
		return $this->elegant_visitor_counter;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    elegant_visitor_counter_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
