<?php
/**
 * RAEL_Default_Compat setup
 *
 * @package Responsive_Addons_For_Elementor
 */

namespace Responsive_Addons_For_Elementor\Themes;

use Responsive_Addons_For_Elementor\ModulesManager\Theme_Builder\RAEL_Theme_Builder;

/**
 * Astra theme compatibility.
 */
class RAEL_Default_Compat {

	/**
	 *  Initiator
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'hooks' ) );
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( rael_header_enabled() ) {
			// Replace header.php template.
			add_action( 'get_header', array( $this, 'override_header' ) );

			// Display RAEL's header in the replaced header.
			add_action( 'rael_header', 'rael_render_header' );
		}

		if ( rael_footer_enabled() ) {
			// Replace footer.php template.
			add_action( 'get_footer', array( $this, 'override_footer' ) );

			// Display RAEL's footer in the replaced footer.
			add_action( 'rael_footer', 'rael_render_footer' );
		}

		if ( rael_single_enabled() || rael_archive_enabled() || get_rael_error_404_id() || rael_single_page_enabled() ) {
			// Replace templates.
			add_filter( 'template_include', array( $this, 'override_single' ), 11 /* After Plugins/WooCommerce */ );
		}
	}

	/**
	 * Function for overriding the header in the elmentor way.
	 *
	 * @return void
	 */
	public function override_header() {
		require RAEL_DIR . 'themes/default/rael-header.php';
		$templates   = array();
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	/**
	 * Function for overriding the footer in the elmentor way.
	 *
	 * @return void
	 */
	public function override_footer() {
		require RAEL_DIR . 'themes/default/rael-footer.php';
		$templates   = array();
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	/**
	 * Function for overriding the single,archive templates in the elmentor way.
	 *
	 * @return void
	 */
	public function override_single() {

		if ( is_404() ) {
			require RAEL_DIR . 'themes/default/rael-header-footer-single.php';
		}
		if ( is_page() ) {
			require RAEL_DIR . 'themes/default/rael-header-footer-single.php';
		}
		if ( is_single() ) {
			require RAEL_DIR . 'themes/default/rael-header-footer-single.php';
		}
		if ( is_archive() ) {
			require RAEL_DIR . 'themes/default/rael-header-footer-archive.php';
		}
	}

}

new RAEL_Default_Compat();
