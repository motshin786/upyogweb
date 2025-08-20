<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Hooks_Pro` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Hooks_Pro' ) ) {
	/**
	 * Load admin site and user site important hook.
	 *
	 * @version 1.0.0
	 */
	class WP_Dark_Mode_Hooks_Pro {
		/**
		 * @var null
		 */
		private static $instance = null;
		/**
		 * WP_Dark_Mode_Hooks_Pro constructor.
		 * load filter and action hook
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function __construct() {

			add_filter( 'the_content', [ $this, 'render_post_page_switcher' ], 999 );

			add_filter( 'wp_dark_mode_pro_active', [ $this, 'is_pro_active' ] );

			add_filter( 'wp_dark_mode_color_presets', [ $this, 'color_presets' ] );

			add_action( 'admin_footer', [ $this, 'admin_footer_scripts' ] );

			add_action( 'wp_head', [ $this, 'render_style' ] );

			// usage chart
			add_action( 'wp_ajax_wp_dark_mode_visits', [ $this, 'handle_wp_dark_mode_visits' ] );
			add_action( 'wp_ajax_nopriv_wp_dark_mode_visits', [ $this, 'handle_wp_dark_mode_visits' ] );

			add_action( 'wp_ajax_wp_dark_mode_usage', [ $this, 'handle_wp_dark_mode_usage' ] );
			add_action( 'wp_ajax_nopriv_wp_dark_mode_usage', [ $this, 'handle_wp_dark_mode_usage' ] );

			add_filter( 'wp_dark_mode_is_enabled', [ $this, 'is_dark_mode_enabled' ] );

			// nav-menu
			add_filter( 'wp_get_nav_menu_items', [ $this, 'get_nav_menu_items' ], 20 );
			add_action( 'wp_update_nav_menu_item', [ $this, 'custom_wp_update_nav_menu_item' ], 10, 2 );

			add_action( 'wp_ajax_wp_dark_mode_get_exclude_posts', [ $this, 'handle_exclude_posts' ] );
			add_action( 'wp_ajax_wp_dark_mode_get_exclude_products', [ $this, 'handle_exclude_products' ] );
			add_action( 'wp_ajax_wp_dark_mode_get_exclude_tags', [ $this, 'handle_exclude_tags' ] );

		}
		/**
		 * handle exclude tags
		 * Get all tags and filter IDs and names from tags and send data in json format
		 *
		 * @return json
		 * @version 1.0.0
		 */
		public function handle_exclude_tags() {
			$term = ! empty( $_REQUEST['term']['term'] ) ? sanitize_text_field( $_REQUEST['term']['term'] ) : '';

			$data[] = [
				'id'   => 0,
				'text' => __( 'No Tags Found', 'wp-dark-mode-pro' ),
			];

			if ( ! empty( $term ) ) {

				$cats = get_terms(
					'post_tag',
					[
						'hide_empty' => false,
						'search'     => $term,
					]
				);

				if ( ! empty( $cats ) ) {

					$data = [];
					foreach ( $cats as $cat ) {
						$data[] = [
							'id'   => $cat->term_id,
							'text' => $cat->name,
						];
					}
				}
			}

			echo json_encode( $data );

			die();

		}
		/**
		 * handle exclude products
		 * Get all products and filter IDs and names from products and send data in json format
		 *
		 * @return json
		 * @version 1.0.0
		 */
		public function handle_exclude_products() {
			$term = ! empty( $_REQUEST['term']['term'] ) ? sanitize_text_field( $_REQUEST['term']['term'] ) : '';

			$data[] = [
				'id'   => 0,
				'text' => __( 'No Products Found', 'wp-dark-mode-pro' ),
			];

			if ( ! empty( $term ) ) {
				$posts = get_posts(
					[
						'post_type'   => 'product',
						'post_status' => 'publish',
						's'           => $term,
					]
				);

				if ( ! empty( $posts ) ) {

					$data = [];
					foreach ( $posts as $post ) {
						$data[] = [
							'id'   => $post->ID,
							'text' => get_the_title( $post->ID ),
						];
					}
				}
			}

			echo json_encode( $data );

			die();

		}
		/**
		 * handle exclude posts
		 * Get all posts and filter IDs and names from posts and send data in json format
		 *
		 * @return json
		 * @version 1.0.0
		 */
		public function handle_exclude_posts() {
			$term = ! empty( $_REQUEST['term']['term'] ) ? sanitize_text_field( $_REQUEST['term']['term'] ) : '';

			$data[] = [
				'id'   => 0,
				'text' => __( 'No Post Found', 'wp-dark-mode-pro' ),
			];

			if ( ! empty( $term ) ) {
				$posts = get_posts(
					[
						'post_type'   => 'post',
						'post_status' => 'publish',
						's'           => $term,
					]
				);

				if ( ! empty( $posts ) ) {

					$data = [];
					foreach ( $posts as $post ) {
						$data[] = [
							'id'   => $post->ID,
							'text' => get_the_title( $post->ID ),
						];
					}
				}
			}

			echo json_encode( $data );

			die();

		}
		/**
		 * Saves the properties of a menu item or create a new one.
		 *
		 * @param int $menu_id the ID of the menu. If 0, makes the menu item a draft orphan.
		 * @param int $menu_item_db_id The ID of the menu item. If 0, creates a new menu item.
		 *
		 * @return null
		 * @version 1.0.o
		 */
		public function custom_wp_update_nav_menu_item( $menu_id = 0, $menu_item_db_id = 0 ) {

			if ( empty( $_POST['menu-item-url'][ $menu_item_db_id ] )
			     || '#darkmode_switcher' !== $_POST['menu-item-url'][ $menu_item_db_id ] ) { //phpcs:ignore
				return;
			}

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return;
			}

			check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

			if ( empty( $_POST['switch_style'][ $menu_item_db_id ] ) ) {
				return;
			}

			$switch_style = intval( $_POST['switch_style'][ $menu_item_db_id ] );

			update_post_meta( $menu_item_db_id, '_switch_style', $switch_style );

			$nav_switches                     = (array) get_option( 'wp_dark_mode_nav_switches' );
			$nav_switches[ $menu_item_db_id ] = $switch_style;
			update_option( 'wp_dark_mode_nav_switches', $nav_switches );

		}
		/**
		 * Get all nav menu items and find out dark mode-switcher and put dark mode switcher shortcode
		 *
		 * @param array $items all nav items.
		 *
		 * @return array
		 * @version 1.0.0
		 */
		public function get_nav_menu_items( $items ) {

			if ( wp_dark_mode_is_hello_elementora() ) {
				foreach ( $items as $item ) {
					if ( $item->post_name == 'darkmode-switcher' ) {

						$switch_style = get_post_meta( $item->ID, '_switch_style', true );
						$switch_style = ! empty( $switch_style ) ? $switch_style : 3;

						$item->title = do_shortcode( '[wp_dark_mode_switch style=' . $switch_style . ']' );
					}
				}
			}

			return $items;
		}
		/**
		 * Enable dark mode depend on dark mode premium feature capability
		 * Enable/disable specific categories,tags,products,posts,page etc
		 *
		 * @return bool
		 * @version 1.0.0
		 */
		public function is_dark_mode_enabled() {

			global $post;
			$post_id = ! empty( $post->ID ) ? $post->ID : '';

			if ( is_404() ) {
				$post_id = '404';
			}

			if ( is_page() || is_home() || is_404() ) {

				// exclude pages
				$exclude_all_pages = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_all_pages', 'off' );

				// fix wc shop page
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$post_id = wc_get_page_id( 'shop' );
				}

				if ( $exclude_all_pages ) {
					if ( ! in_array( $post_id, wp_dark_mode_exclude_pages_except() ) ) {
						return false;
					}
				} else {
					if ( in_array( $post_id, wp_dark_mode_exclude_pages() ) ) {
						return false;
					}
				}
			} elseif ( is_single() ) {
				// Exclude products
				$exclude_products     = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_products', [] );
				$exclude_all_products = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_all_products', 'off' );
				$specific_products    = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'specific_products', [] );

				if ( 'product' == get_post_type( $post_id ) ) {
					if ( $exclude_all_products ) {
						if ( ! in_array( $post_id, $specific_products ) ) {
							return false;
						}
					} else {
						if ( in_array( $post_id, $exclude_products ) ) {
							return false;
						}
					}
				}

				// Exclude posts
				$exclude_posts     = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_posts', [] );
				$exclude_all_posts = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_all_posts', 'off' );
				$except_posts      = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_posts_except', [] );

				if ( 'post' == get_post_type( $post_id ) ) {
					if ( $exclude_all_posts ) {
						if ( ! in_array( $post_id, $except_posts ) ) {
							return false;
						}
					} else {
						if ( in_array( $post_id, $exclude_posts ) ) {
							return false;
						}
					}
				}

				// check exclude_post_types
				$exclude_post_types = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_post_types', [] );
				if ( ! empty( $exclude_post_types ) && ! empty( get_post_type( $post_id ) ) ) {
					if ( in_array( get_post_type( $post_id ), $exclude_post_types ) ) {
						return false;
					}
				}

				// Exclude categories
				$exclude_all_categories = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_all_categories', 'off' );
				$exclude_categories     = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_categories', [] );
				$specific_categories    = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'specific_categories', [] );
				$categories             = wp_get_post_terms( $post_id, 'category', [ 'fields' => 'ids' ] );

				if ( ! is_wp_error( $categories ) ) {
					if ( $exclude_all_categories ) {

						// If no match
						if ( ! array_intersect( $categories, $specific_categories ) ) {
							return false;
						}
					} else {
						// If exclude match
						if ( array_intersect( $categories, $exclude_categories ) ) {
							return false;
						}
					}
				}

				// Exclude WC categories
				$exclude_all_wc_categories = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_all_wc_categories', 'off' );
				$exclude_wc_categories     = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_wc_categories', [] );
				$specific_wc_categories    = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'specific_wc_categories', [] );
				$wc_categories             = wp_get_post_terms( $post_id, 'product_cat', [ 'fields' => 'ids' ] );

				if ( ! is_wp_error( $wc_categories ) ) {
					if ( $exclude_all_wc_categories ) {

						// If no match
						if ( ! array_intersect( $wc_categories, $specific_wc_categories ) ) {
							return false;
						}
					} else {
						// If exclude match
						if ( array_intersect( $wc_categories, $exclude_wc_categories ) ) {
							return false;
						}
					}
				}

				// Exclude tags
				$exclude_all_tags = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_all_tags', 'off' );
				$exclude_tags     = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'exclude_tags', [] );
				$specific_tags    = wp_dark_mode_get_settings( 'wp_dark_mode_triggers', 'specific_tags', [] );
				$tags             = (array) wp_get_post_terms( $post_id, 'post_tag', [ 'fields' => 'ids' ] );

				if ( $exclude_all_tags ) {

					// If no match
					if ( ! array_intersect( $tags, $specific_tags ) ) {
						return false;
					}
				} else {
					// If exclude match
					if ( array_intersect( $tags, $exclude_tags ) ) {
						return false;
					}
				}
			} elseif ( is_tax() ) {

				$cat_id = get_queried_object_id();

				// Exclude WC categories
				$exclude_all_wc_categories = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_all_wc_categories', 'off' );
				$exclude_wc_categories     = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'exclude_wc_categories', [] );
				$specific_wc_categories    = wp_dark_mode_get_settings( 'wp_dark_mode_wc', 'specific_wc_categories', [] );

				if ( $exclude_all_wc_categories ) {

					// If no match
					if ( ! in_array( $cat_id, $specific_wc_categories ) ) {
						return false;
					}
				} else {
					// If exclude match
					if ( in_array( $cat_id, $exclude_wc_categories ) ) {
						return false;
					}
				}
			}

			return true;
		}
		/**
		 * Count How much users dark mode visit and update wp dark mode visits option value.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function handle_wp_dark_mode_visits() {
			$date = date( 'm-d-Y' );

			$visits = get_option( 'wp_dark_mode_visits' );

			$count = ! empty( $visits[ $date ] ) ? absint( $visits[ $date ] ) + 1 : 1;

			$visits[ $date ] = $count;

			update_option( 'wp_dark_mode_visits', $visits );

			die();

		}
		/**
		 * Count How much users use dark mode and update wp_dark_mode_usage option value.
		 *
		 * @return void
		 * @version 1.0.0
		 */
		public function handle_wp_dark_mode_usage() {

			$active = intval( $_REQUEST['active'] );

			$date = date( 'm-d-Y' );

			$usage = get_option( 'wp_dark_mode_usage' );

			$count = ! empty( $usage[ $date ] ) ? intval( $usage[ $date ] ) : 0;
			$count = $active ? $count + 1 : $count - 1;

			if ( $count < 0 ) {
				$count = 0;
			}

			$usage[ $date ] = $count;

			update_option( 'wp_dark_mode_usage', $usage );

			die();

		}
		/**
		 * Render Wp dark mode css style
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function render_style() {
			if ( ! wp_dark_mode_is_hello_elementora() ) {
				return;
			}

			$css = '';

			// Switch Custom Position CSS
			$position = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switcher_position', 'right_bottom' );
			if ( 'custom' == $position ) {
				$switch_side    = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_side', 'right_bottom' );
				$bottom_spacing = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'bottom_spacing', 10 );
				$side_spacing   = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'side_spacing', 10 );

				ob_start();
				printf( 'bottom: %spx;', $bottom_spacing );

				if ( 'left_bottom' === $switch_side ) {
					printf( 'left: %spx !important;right:auto !important', $side_spacing );
				} else {
					printf( 'right: %spx !important;left:auto !important', $side_spacing );
				}

				$switch_position_css = ob_get_clean();
				$css                .= sprintf( '.wp-dark-mode-switcher.floating,.wp-dark-mode-side-toggle-wrap.floating{%s}', $switch_position_css );

			}

			// Switch cta color CSS
			$cta_bg_color   = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'cta_bg_color' );
			$cta_text_color = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'cta_text_color' );

			if ( ! empty( $cta_bg_color ) ) {
				$css .= sprintf( '.wp-dark-mode-switcher{--wp-dark-mode-cta-bg: %s;}', $cta_bg_color );
			}

			if ( ! empty( $cta_text_color ) ) {
				$css .= sprintf( '.wp-dark-mode-switcher .wp-dark-mode-switcher-cta {color: %s;}', $cta_text_color );
			}

			printf( '<style>%s</style>', $css );

		}
		/**
		 * Load wp dark mode js in admin footer for handle dark mode switcher
		 * Its working on only admin site
		 *
		 * @return mixed
		 * @version 1.0.0
		 */
		public function admin_footer_scripts() {

			global $current_screen;

			if ( empty( $current_screen ) || 'toplevel_page_wp-dark-mode-settings' != $current_screen->id ) {
				return;
			}

			?>
			<script>
				;(function ($) {
					$(document).ready(function () {

						//custom css
						if (wpDarkMode.is_settings_page) {
							wp.codeEditor.initialize($('.custom_css textarea'), wpDarkMode.cm_settings);
						}

						//switch menus
						if ($('.switch_menus select').length) {
							$('.switch_menus select').select2({
								placeholder: 'Select Menus',
								multiple: true,
							});
						}

						//exclude pages
						if ($('.exclude_pages select').length) {
							$('.exclude_pages select').select2({
								placeholder: 'Select Pages',
								multiple: true,
							});
						}


						//exclude categories
						if ($('.exclude_categories select').length) {
							$('.exclude_categories select').select2({
								placeholder: 'Select Categories',
								multiple: true,
							});
						}


						//exclude wc categories
						if ($('.exclude_wc_categories select').length) {
							$('.exclude_wc_categories select').select2({
								placeholder: 'Search Categories',
								multiple: true,
							});
						}

						//exclude products
						if ($('.exclude_products select').length) {
							$('.exclude_products select').select2({
								placeholder: 'Search Products',
								multiple: true,
								ajax: {
									url: wpDarkModeProAdmin.ajax_url,
									dataType: 'json',
									type: "POST",
									quietMillis: 50,

									data: term => ({
										term: term,
										action: 'wp_dark_mode_get_exclude_products',
									}),

									processResults: data => {
										return {results: data}
									},

									cache: true

								},
							});
						}

						//exclude posts
						if ($('.exclude_posts select').length) {
							$('.exclude_posts select').select2({
								placeholder: 'Search Posts',
								multiple: true,
								ajax: {
									url: wpDarkModeProAdmin.ajax_url,
									dataType: 'json',
									type: "POST",
									quietMillis: 50,

									data: term => ({
										term: term,
										action: 'wp_dark_mode_get_exclude_posts',
									}),

									processResults: data => {
										return {results: data}
									},

									cache: true

								},
							});
						}


						//exclude tags
						if ($('.exclude_tags select').length) {
							$('.exclude_tags select').select2({
								placeholder: 'Select tags',
								multiple: true,
								ajax: {
									url: wpDarkModeProAdmin.ajax_url,
									dataType: 'json',
									type: "POST",
									quietMillis: 50,

									data: term => ({
										term: term,
										action: 'wp_dark_mode_get_exclude_tags',
									}),

									processResults: data => {
										return {results: data}
									},

									cache: true

								},
							});
						}


						//custom_post_types
						if ($('.exclude_post_types select').length) {
							$('.exclude_post_types select').select2({
								placeholder: 'Select post types',
								multiple: true,
							});
						}


					});
				})(jQuery);
			</script>
			<?php
		}
		/**
		 * Check WP dark mode pro is active
		 *
		 * @return boolean
		 * @version 1.0.0
		 */
		public function is_pro_active() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_pro_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Pro Lifetime' )
						   || $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Pro Yearly' );

			return $wp_dark_mode_license->is_valid() && $is_pro_plan;
		}
		/**
		 * Set wp dark mode extra color presets
		 *
		 * @return array
		 * @version 1.0.0
		 */
		public function color_presets( $color_presets ) {
			$color_presets = array_merge(
				$color_presets,
				[

					[
						'bg'   => '#270000',
						'text' => '#fff',
						'link' => '#FF7878',
					],
					[
						'bg'   => '#160037',
						'text' => '#EBEBEB',
						'link' => '#B381FF',
					],
					[
						'bg'   => '#121212',
						'text' => '#E6E6E6',
						'link' => '#FF9191',
					],
					[
						'bg'   => '#000A3B',
						'text' => '#FFFFFF',
						'link' => '#3AFF82',
					],
					[
						'bg'   => '#171717',
						'text' => '#BFB7C0',
						'link' => '#F776F0',
					],
					[
						'bg'   => '#003711',
						'text' => '#FFFFFF',
						'link' => '#84FF6D',
					],
					[
						'bg'   => '#23243A',
						'text' => '#D6CB99',
						'link' => '#FF9323',
					],
					[
						'bg'   => '#151819',
						'text' => '#D5D6D7',
						'link' => '#DAA40B',
					],
					[
						'bg'   => '#18191A',
						'text' => '#DCDEE3',
						'link' => '#2D88FF',
					],
					[
						'bg'   => '#141d26',
						'text' => '#fff',
						'link' => '#1C9CEA',
					],
				]
			);

			return $color_presets;
		}

		/**
		 * Render post page switcher
		 *
		 * @param $content
		 *
		 * @return string
		 */
		public function render_post_page_switcher( $content ) {

			if ( ! wp_dark_mode_enabled() ) {
				return $content;
			}

			$above_post = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'show_above_post' );
			$above_page = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'show_above_page' );
			$style      = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_style', '1' );

			if ( $above_post && is_single() && in_the_loop() && is_main_query() ) {
				$content = do_shortcode( "[wp_dark_mode style='$style' class='post_page' ]" ) . $content;
			}

			if ( $above_page && is_page() && in_the_loop() && is_main_query() ) {
				$content = do_shortcode( "[wp_dark_mode style='$style' class='post_page' ]" ) . $content;
			}

			return $content;
		}

		/**
		 * Singleton instance WP_Dark_Mode_Hooks_Pro class
		 *
		 * @return WP_Dark_Mode_Hooks_Pro|null
		 *
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
	}
}
/**
 * kick out the class.
 */
WP_Dark_Mode_Hooks_Pro::instance();

