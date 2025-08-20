<?php

/**
 * Created by PhpStorm.
 * User: adom
 * Date: 2/26/2019
 * Time: 3:22 PM
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elegant_visitor_counter_post_count
 * @subpackage elegant_visitor_counter/admin
 * @author     Sujan Karki <regolithjk@gamil.com>
 * @since    3.1
 */
class Elegant_visitor_counter_settings
{

	function __construct()
	{
		register_setting('evc_settings', 'evc_alignment');
		register_setting('evc_settings', 'total_color');
		register_setting('evc_settings', 'total_text_color');
	}

	/*
	 * register plugin to setting menu in admin panel
	 */
	function evc_register_settings()
	{
		add_options_page('Elegant Visitor Counter', 'Elegant Visitor Counter', 'manage_options', 'evc_settings', array($this, 'evc_options_page'));
	}

	/*
	 * callback to view page
	 * @since    3.1
	 */

	function evc_options_page()
	{
		include_once 'partials/elegant-visitor-counter-admin-display.php';
	}

	/*
	 * section callback
	 * @since    3.1
	 */
	public function section_callback($arguments)
	{
		switch ($arguments['id']) {
			case 'total_color':
				// echo 'Change color of total visitor count.';
				break;
			case 'total_text_color':
				// echo 'Change color of text in total visitor count.';
				break;
			case 'evc_alignment':
				// echo 'Change alignment of all the visitor counter.';
				break;
		}
	}

	/*
	* setup section
	* @since    3.1
	*/
	public function setup_sections()
	{
		add_settings_section('total_color', 'Change Color of Total Visitors', array($this, 'section_callback'), 'evc_settings');
		add_settings_section('total_text_color', 'Change Color of Total Visitors Text', array($this, 'section_callback'), 'evc_settings');
		add_settings_section('evc_alignment', 'Change alignment', array($this, 'section_callback'), 'evc_settings');
	}

	/*
	 * add setting field for color picker
	 * @since    3.1
	 */
	public function setup_field_total_color()
	{
		add_settings_field('total_color', 'Color', array($this, 'total_color_callback'), 'evc_settings', 'total_color');
	}

	/*
	 * add setting field for color picker
	 * @since    3.1
	 */
	public function setup_field_total_text_color()
	{
		add_settings_field('total_text_color', 'Color', array($this, 'total_text_color_callback'), 'evc_settings', 'total_text_color');
	}

	/*
	 * add setting field for alignment
	 * @since    3.1
	 */
	public function setup_field_evc_alignment()
	{
		add_settings_field('evc_alignment', 'Alignment', array($this, 'evc_alignment_callback'), 'evc_settings', 'evc_alignment');
	}

	/*
	 * form field for color field
	 * @since    3.1
	 */
	public function total_color_callback($arguments)
	{
		echo '<input name="total_color" id="total_color" class="jscolor" type="text" value="' . get_option('total_color') . '" />';
	}

	/*
	 * form field for color field
	 * @since    3.1
	 */
	public function total_text_color_callback($arguments)
	{
		echo '<input name="total_text_color" id="total_text_color" class="jscolor" type="text" value="' . get_option('total_text_color') . '" />';
	}

	/*
	 * form field for alignment
	 * @since    3.1
	 */
	public function evc_alignment_callback($arguments)
	{
?>
		<input type="radio" name="evc_alignment" value="left" <?php echo (get_option('evc_alignment') == "left") ? 'checked=""' : ""; ?>> Left<br>
		<input type="radio" name="evc_alignment" value="center" <?php echo (get_option('evc_alignment') == "center") ? 'checked=""' : ""; ?>> Center
		<br>
		<input type="radio" name="evc_alignment" value="right" <?php echo (get_option('evc_alignment') == "right") ? 'checked=""' : ""; ?>> Right
<?php
	}

	/*
	 * form field for alignment
	 * @since    3.1
	 */
	public function truncate_evc_log_callback()
	{
		if (!isset($_POST['action']) || !wp_verify_nonce($_POST['_wpnonce'], 'truncate_evc_log')) {
			wp_die('Security check failed. Please try again.');
		}

		// Check if the current user has the capability to manage options (change this capability as needed)
		if (!current_user_can('manage_options')) {
			wp_die('You do not have sufficient permissions to access this page.');
		}

		// Perform the truncation of the evc_log table
		global $wpdb;
		$table_name = $wpdb->prefix . 'evc_log';
		$wpdb->query("TRUNCATE TABLE $table_name");

		wp_redirect(admin_url('options-general.php?page=evc_settings'));
		exit;
	}
}
