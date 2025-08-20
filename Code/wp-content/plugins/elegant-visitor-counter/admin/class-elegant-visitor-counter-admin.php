<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/elegant-visitor-counter/
 * @since      1.0.0
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/admin
 * @author     Your Name <email@example.com>
 */
class elegant_visitor_counter_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $elegant_visitor_counter The ID of this plugin.
	 */
	private $elegant_visitor_counter;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $elegant_visitor_counter The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $elegant_visitor_counter, $version ) {

		$this->elegant_visitor_counter = $elegant_visitor_counter;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in elegant_visitor_counter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The elegant_visitor_counter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->elegant_visitor_counter, plugin_dir_url( __FILE__ ) . 'css/elegant-visitor-counter-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in elegant_visitor_counter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The elegant_visitor_counter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//		wp_enqueue_script( $this->elegant_visitor_counter, plugin_dir_url( __FILE__ ) . 'js/elegant-visitor-counter-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->elegant_visitor_counter, plugin_dir_url( __FILE__ ) . 'js/jscolor.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Settings link of plugin
	 *
	 * @since    3.1
	 */
	function add_action_links( $links ) {
		$settings_link = '<a href="options-general.php?page=evc_settings">' . __( 'Settings' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
	}

}
