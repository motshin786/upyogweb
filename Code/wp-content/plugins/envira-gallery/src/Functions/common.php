<?php
/**
 * Envira Common Functions.
 *
 * @since 1.7.0
 *
 * @package Envira_Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 * Helper Method for Cropping Position.
 *
 * @since 1.7.0
 *
 * @access public
 * @return array
 */
function envira_crop_position() {

	$position = [
		[
			'value' => 'c',
			'name'  => __( 'Center', 'envira-gallery' ),
		],
		[
			'value' => 'tl',
			'name'  => __( 'Top Left', 'envira-gallery' ),
		],
		[
			'value' => 'tr',
			'name'  => __( 'Top Right', 'envira-gallery' ),
		],
		[
			'value' => 'bl',
			'name'  => __( 'Bottom Left', 'envira-gallery' ),
		],
		[
			'value' => 'br',
			'name'  => __( 'Bottom Right', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_crop_positions', $position );
}

/**
 * Helper method for retrieving columns.
 *
 * @since 1.7.0
 *
 * @return array Array of column data.
 */
function envira_get_columns() {

	$columns = [
		[
			'value' => '2',
			'name'  => __( 'Two Columns (2)', 'envira-gallery' ),
		],
		[
			'value' => '3',
			'name'  => __( 'Three Columns (3)', 'envira-gallery' ),
		],
		[
			'value' => '4',
			'name'  => __( 'Four Columns (4)', 'envira-gallery' ),
		],
		[
			'value' => '5',
			'name'  => __( 'Five Columns (5)', 'envira-gallery' ),
		],
		[
			'value' => '6',
			'name'  => __( 'Six Columns (6)', 'envira-gallery' ),
		],
		[
			'value' => '7',
			'name'  => __( 'Seven Columns (7)', 'envira-gallery' ),
		],
		[
			'value' => '8',
			'name'  => __( 'Eight Columns (8)', 'envira-gallery' ),
		],
		[
			'value' => '9',
			'name'  => __( 'Nine Columns (9)', 'envira-gallery' ),
		],
		[
			'value' => '10',
			'name'  => __( 'Ten Columns (10)', 'envira-gallery' ),
		],
		[
			'value' => '11',
			'name'  => __( 'Eleven Columns (11)', 'envira-gallery' ),
		],
		[
			'value' => '12',
			'name'  => __( 'Twelve Columns (12)', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_columns', $columns );
}

/**
 * Helper method for retrieving layouts.
 *
 * @since 1.9.0
 *
 * @return array Array of column data.
 */
function envira_get_layouts() {

	$layouts = [
		'automatic' => [
			'name'      => 'Automatic',
			'config'    => [
				'columns' => '0',
			],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/automatic-layout.png',
		],
		'mason'     => [
			'name'      => 'Mason',
			'config'    => [
				'columns' => '3',
				'isotope' => true,
			],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/mason-layout.png',

		],
		'grid'      => [
			'name'      => 'Grid',
			'config'    => [
				'columns' => '3',
				'isotope' => false,
			],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/grid-layout.png',
		],
		'square'    => [
			'name'      => 'Square',
			'config'    => [],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/square-layout.png',
		],
		'blogroll'  => [
			'name'      => 'Blogroll',
			'config'    => [
				'columns' => 3,
				'isotope' => false,
			],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/blogroll-layout.png',
		],
		'bnb'       => [
			'name'      => 'BnB',
			'config'    => [
				'columns' => 1,
				'isotope' => false,
			],
			'thumbnail' => trailingslashit( ENVIRA_URL ) . 'assets/images/bnb-layout.png',
		],
	];

	return apply_filters( 'envira_gallery_layouts', $layouts );
}

/**
 * Helper method for retrieving layout config.
 *
 * @since 1.9.0
 * @param string $layout The layout.
 * @return array Array of column data.
 */
function envira_get_layout_config( $layout ) {

	$layouts = envira_get_layouts();

	return $layouts[ $layout ]['config'];
}

/**
 * Helper method for retrieving justified gallery themes.
 *
 * @since 1.7.0
 *
 * @return array Array of gallery theme data.
 */
function envira_get_justified_gallery_themes() {

	$themes = [
		[
			'value' => 'normal',
			'name'  => __( 'Normal', 'envira-gallery' ),
			'file'  => ENVIRA_FILE,
		],
	];

	return apply_filters( 'envira_gallery_justified_gallery_themes', $themes );
}

/**
 * Helper method for retrieving justified gallery themes.
 *
 * @since 1.7.0
 *
 * @return array Array of gallery theme data.
 */
function envira_get_justified_gallery_themes_details() {

	$details = [
		[
			'value' => 'normal',
			'name'  => __( 'Normal', 'envira-gallery' ),
			'file'  => ENVIRA_FILE,
		],
		[
			'value' => 'hover',
			'name'  => __( 'On Hover', 'envira-gallery' ),
			'file'  => ENVIRA_FILE,
		],
	];

	return apply_filters( 'envira_gallery_justified_gallery_themes_details', $details );
}

/**
 * Helper method for retrieving display description options.
 *
 * @since 1.7.0
 *
 * @return array Array of description placement options.
 */
function envira_get_display_description_options() {

	$descriptions = [
		[
			'name'  => __( 'Do not display', 'envira-gallery' ),
			'value' => 0,
		],
		[
			'name'  => __( 'Display above galleries', 'envira-gallery' ),
			'value' => 'above',
		],
		[
			'name'  => __( 'Display below galleries', 'envira-gallery' ),
			'value' => 'below',
		],
	];

	return apply_filters( 'envira_gallery_display_description_options', $descriptions );
}

/**
 * Helper method for retrieving display sorting options.
 *
 * @since 1.7.0
 *
 * @param bool $is_album Is an album.
 * @return array Array of sorting options
 */
function envira_get_sorting_options( $is_album = false ) {

	$options = [
		[
			'name'  => __( 'No Sorting', 'envira-gallery' ),
			'value' => 0,
		],
		[
			'name'  => __( 'Random', 'envira-gallery' ),
			'value' => 1, // Deliberate, as we map the 'random' config key which was a true/false.
		],
		[
			'name'  => __( 'Published Date', 'envira-gallery' ),
			'value' => 'date',
		],
		[
			'name'  => __( 'Title', 'envira-gallery' ),
			'value' => 'title',
		],
		[
			'name'  => __( 'Caption', 'envira-gallery' ),
			'value' => 'caption',
		],
		[
			'name'  => __( 'Alt', 'envira-gallery' ),
			'value' => 'alt',
		],
	];

	if ( false === $is_album ) {
		$options[] = [
			'name'  => __( 'Filename', 'envira-gallery' ),
			'value' => 'src',
		];
		$options[] = [
			'name'  => __( 'URL', 'envira-gallery' ),
			'value' => 'link',
		];
	}

	return apply_filters( 'envira_gallery_sorting_options', $options );
}

/**
 * Helper method for retrieving sorting directions
 *
 * @since 1.7.0
 *
 * @return array Array of sorting directions
 */
function envira_get_sorting_directions() {

	$directions = [
		[
			'name'  => __( 'Ascending (A-Z)', 'envira-gallery' ),
			'value' => 'ASC',
		],
		[
			'name'  => __( 'Descending (Z-A)', 'envira-gallery' ),
			'value' => 'DESC',
		],
	];

	return apply_filters( 'envira_gallery_sorting_directions', $directions );
}

/**
 * Helper method for retrieving title displays.
 *
 * @since 1.7.0
 *
 * @return array Array of title display data.
 */
function envira_get_title_displays() {

	$displays = [
		[
			'value' => 'float',
			'name'  => __( 'Float', 'envira-gallery' ),
		],
		[
			'value' => 'inside',
			'name'  => __( 'Inside', 'envira-gallery' ),
		],
		[
			'value' => 'outside',
			'name'  => __( 'Outside', 'envira-gallery' ),
		],
		[
			'value' => 'over',
			'name'  => __( 'Over', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_title_displays', $displays );
}

/**
 * Helper method for retrieving arrow positions.
 *
 * @since 1.7.0
 *
 * @return array Array of arrow position display data.
 */
function envira_get_arrows_positions() {

	$displays = [
		[
			'value' => 'inside',
			'name'  => __( 'Inside', 'envira-gallery' ),
		],
		[
			'value' => 'outside',
			'name'  => __( 'Outside', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_arrows_positions', $displays );
}

/**
 * Helper method for retrieving lightbox transition effects.
 *
 * @since 1.7.0
 *
 * @return array Array of transition effect data.
 */
function envira_get_transition_effects() {

	$effects = [
		[
			'value' => 'false',
			'name'  => __( 'No Effect', 'envira-gallery' ),
		],
		[
			'value' => 'fade',
			'name'  => __( 'Fade', 'envira-gallery' ),
		],
		[
			'value' => 'slide',
			'name'  => __( 'Slide', 'envira-gallery' ),
		],
		[
			'value' => 'circular',
			'name'  => __( 'Circular', 'envira-gallery' ),
		],
		[
			'value' => 'tube',
			'name'  => __( 'Tube', 'envira-gallery' ),
		],
		[
			'value' => 'rotate',
			'name'  => __( 'Rotate', 'envira-gallery' ),
		],
		[
			'value' => 'zoom-in-out',
			'name'  => __( 'Zoom-In-Out', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_transition_effects', $effects );
}

/**
 * Helper Method for Envira Open Effects.
 *
 * @access public
 * @return array
 */
function envira_get_envirabox_open_effects() {

	$effects = [
		[
			'value' => 'none',
			'name'  => __( 'No Effect', 'envira-gallery' ),
		],
		[
			'value' => 'fade',
			'name'  => __( 'Fade', 'envira-gallery' ),
		],
		[
			'value' => 'zoom-in-out',
			'name'  => __( 'Zoom-In-Out', 'envira-gallery' ),
		],
		[
			'value' => 'zoom',
			'name'  => __( 'Zoom', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_open_effects', $effects );
}

/**
 * Helper method for retrieving toolbar positions.
 *
 * @since 1.7.0
 *
 * @return array Array of toolbar position data.
 */
function envira_get_toolbar_positions() {

	$positions = [
		[
			'value' => 'top',
			'name'  => __( 'Top', 'envira-gallery' ),
		],
		[
			'value' => 'bottom',
			'name'  => __( 'Bottom', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_toolbar_positions', $positions );
}

/**
 * Helper method for retrieving thumbnail positions.
 *
 * @since 1.7.0
 *
 * @return array Array of thumbnail position data.
 */
function envira_get_thumbnail_positions() {

	$positions = [
		[
			'value' => 'top',
			'name'  => __( 'Top', 'envira-gallery' ),
		],
		[
			'value' => 'bottom',
			'name'  => __( 'Bottom', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_thumbnail_positions', $positions );
}

/**
 * Helper method for retrieving Justified Last Row.
 *
 * @since 1.7.0
 *
 * @return array Array of last data.
 */
function envira_get_justified_last_row() {

	$layouts = [
		[
			'value' => 'nojustify',
			'name'  => __( 'Left', 'envira-gallery' ),
		],
		[
			'value' => 'center',
			'name'  => __( 'Center', 'envira-gallery' ),
		],
		[
			'value' => 'right',
			'name'  => __( 'Right', 'envira-gallery' ),
		],
		[
			'value' => 'justify',
			'name'  => __( 'Fill', 'envira-gallery' ),
		],
		[
			'value' => 'hide',
			'name'  => __( 'Hide', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_justified_last_row', $layouts );
}

/**
 * Helper method for retrieving additional copy options for legacy gallery views
 *
 * @since 1.7.0
 *
 * @return array Array of last data.
 */
function envira_get_additional_copy_options() {

	$options = [
		false           => __( 'None', 'envira-gallery' ),
		'title'         => __( 'Title', 'envira-gallery' ),
		'caption'       => __( 'Caption', 'envira-gallery' ),
		'title_caption' => __( 'Title + Caption', 'envira-gallery' ),
	];

	return apply_filters( 'envira_gallery_get_additional_copy_options', $options );
}

/**
 * Retrieves the slider config defaults.
 *
 * @since 1.7.0
 *
 * @param int $post_id The current post ID.
 * @return array sArray of slider config defaults.
 */
function envira_get_config_defaults( $post_id ) {

	// Prepare default values.
	$defaults = [

		// Images Tab.
		'type'                                     => 'default',

		// Config Tab.
		'layout'                                   => 'automatic',
		'columns'                                  => '4',
		'justified_row_height'                     => 150, // automatic/justified layout.
		'justified_gallery_theme'                  => 'normal',
		'justified_margins'                        => 1,
		'justified_last_row'                       => 'nojustify',
		'justified_gallery_theme_detail'           => '',
		'gallery_theme'                            => 'base',
		'display_description'                      => 0,
		'description'                              => '',
		'gutter'                                   => 10,
		'margin'                                   => 10,
		'random'                                   => 0,
		'sorting_direction'                        => 'ASC',
		'image_size'                               => 'default', // Default = uses the below crop_width and crop_height.
		'image_sizes_random'                       => [],
		'crop_width'                               => 640,
		'crop_height'                              => 480,
		'square_size'                              => 300,
		'crop'                                     => 0,
		'crop_position'                            => 'c',
		'dimensions'                               => 0,
		'isotope'                                  => 1,
		'css_animations'                           => 1, // Depricated @since 1.8.0.
		'css_opacity'                              => 100, // Depricated @since 1.8.0.
		'lightbox_title_caption'                   => 'title',
		'additional_copy_title'                    => 0,
		'additional_copy_caption'                  => 0,
		'additional_copy_automatic_title'          => 1,
		'additional_copy_automatic_caption'        => 1,
		'additional_copy_title_mobile'             => 0,
		'additional_copy_caption_mobile'           => 0,
		'additional_copy_automatic_title_mobile'   => 1,
		'additional_copy_automatic_caption_mobile' => 1,
		'lazy_loading'                             => 1, // lazy loading 'ON' for new galleries.
		'lazy_loading_delay'                       => 500,
		'sort_order'                               => '0',

		// Lightbox.
		'lightbox_enabled'                         => 1,
		'gallery_link_enabled'                     => 1,
		'lightbox_theme'                           => 'base_dark',
		'lightbox_image_size'                      => 'default',
		'lightbox_html_caption'                    => 0,
		'title_display'                            => 'float',
		'arrows'                                   => 1,
		'arrows_position'                          => 'inside',
		'keyboard'                                 => 1, // Depricated @since 1.8.1.
		'mousewheel'                               => 1, // Depricated @since 1.8.1.
		'toolbar'                                  => 1,
		'toolbar_title'                            => 0,
		'toolbar_position'                         => 'top',
		'aspect'                                   => 1,
		'loop'                                     => 1,
		'lightbox_open_close_effect'               => 'fade',
		'effect'                                   => 'fade',
		'html5'                                    => 0,
		'supersize'                                => 0,

		// Thumbnails.
		'thumbnails'                               => 1,
		'thumbnails_width'                         => 75,
		'thumbnails_height'                        => 50,
		'thumbnails_position'                      => 'bottom',

		// Mobile.
		'mobile'                                   => 1,
		'mobile_width'                             => 320,
		'mobile_height'                            => 240,
		'mobile_lightbox'                          => 1,
		'mobile_touchwipe'                         => 1,
		'mobile_touchwipe_close'                   => 0,
		'mobile_arrows'                            => 1,
		'mobile_toolbar'                           => 1,
		'mobile_thumbnails'                        => 1,
		'mobile_thumbnails_width'                  => 75,
		'mobile_thumbnails_height'                 => 50,
		'mobile_justified_row_height'              => 80,

		// Misc.
		'title'                                    => '',
		'slug'                                     => '',
		'classes'                                  => [],
		'rtl'                                      => 0,

		'show_more_text'                           => __( 'Click for more', 'envira-gallery' ),
	];

	// Allow devs to filter the defaults.
	$defaults = apply_filters( 'envira_gallery_defaults', $defaults, $post_id );

	return $defaults;
}

add_action( 'upload_mimes', 'envira_add_file_types_to_uploads' );

/**
 * Add support for SVgs to the meida Library
 *
 * @since 1.8.6
 *
 * @param array $file_types Core file types.
 * @return array
 */
function envira_add_file_types_to_uploads( $file_types ) {

	$new_filetypes        = [];
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types           = array_merge( $file_types, $new_filetypes );

	return $file_types;
}

/**
 * Returns an array of supported file type groups and file types
 *
 * @since 1.7.0
 *
 * @return array Supported File Types
 */
function envira_get_supported_filetypes() {

	$supported_file_types = [
		[
			'title'      => __( 'Image Files', 'envira-gallery' ),
			'extensions' => 'svg,jpg,jpeg,jpe,gif,png,bmp,tif,tiff,SVG,JPG,JPEG,JPE,GIF,PNG,BMP,TIF,TIFF,webp,WEBP',
		],
	];

	// Allow Developers and Addons to filter the supported file types.
	$supported_file_types = apply_filters( 'envira_gallery_supported_file_types', $supported_file_types );

	return $supported_file_types;
}

/**
 * Returns an array of support file types in full MIME format
 *
 * @since 1.7.0
 *
 * @return array Supported File Types
 */
function envira_get_supported_filetypes_mimes() {

	$supported_file_types = [
		'image/jpg',
		'image/jpeg',
		'image/jpe',
		'image/gif',
		'image/png',
		'image/bmp',
		'image/tif',
		'image/tiff',
		'image/webp',
	];

	// Allow Developers and Addons to filter the supported file types.
	$supported_file_types = apply_filters( 'envira_gallery_supported_file_types_mimes', $supported_file_types );

	return $supported_file_types;
}

/**
 * Returns an array of positions for new images to be added to in an existing Gallery
 *
 * @since 1.7.0
 *
 * @return array
 */
function envira_get_media_positions() {

	$positions = [
		[
			'value' => 'before',
			'name'  => __( 'Before Existing Images', 'envira-gallery' ),
		],
		[
			'value' => 'after',
			'name'  => __( 'After Existing Images', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_media_positions', $positions );
}

/**
 * Returns an array of media deletion options, when an Envira Gallery is deleted
 *
 * @since 1.7.0
 *
 * @return array
 */
function envira_get_media_delete_options() {

	$options = [
		[
			'value' => '',
			'name'  => __( 'No', 'envira-gallery' ),
		],
		[
			'value' => '1',
			'name'  => __( 'Yes', 'envira-gallery' ),
		],
	];

	return apply_filters( 'envira_gallery_media_delete_options', $options );
}

/**
 * Sorts the gallery
 *
 * @since 1.7.0
 *
 * @param array   $data Gallery Data.
 * @param string  $sort_type Sorting Type.
 * @param string  $sort_direction Sorting Direction.
 * @param boolean $flush_cache Flush the transient or not.
 * @return array
 */
function envira_sort_gallery( $data, $sort_type, $sort_direction, $flush_cache = false ) {

	// Dont go any further if datas not set.
	if ( empty( $data ) ) {
		return false;
	}

	// We need this part of $data populated with something.
	if ( empty( $data['gallery'] ) ) {
		return $data;
	}

	// Return if we dont have a sort type.
	if ( empty( $sort_type ) || empty( $sort_direction ) ) {
		return $data;
	}

	if ( empty( $data['gallery'] ) ) {
		echo 'no gallery images?';
		exit;
	}

	// Update the sort type.
	$data['config']['sort_order'] = $sort_type;

	switch ( $sort_type ) {
		case '1':
			// Shuffle keys.
			$keys = array_keys( $data['gallery'] );
			shuffle( $keys );

			// Rebuild array in new order.
			$new = [];
			foreach ( $keys as $key ) {
				$new[ $key ] = $data['gallery'][ $key ];
			}

			// Assign back to gallery.
			$data['gallery'] = $new;

			break;
		case 'src':
		case 'title':
		case 'status':
		case 'caption': // new for backend sort.
		case 'alt': // new for backend sort.
		case 'link':
			// Get metadata.
			$keys = [];
			foreach ( $data['gallery'] as $id => $item ) {
				if ( isset( $item[ $sort_type ] ) ) {
					if ( 'src' === $sort_type ) {
						$keys[ $id ] = basename( wp_strip_all_tags( $item[ $sort_type ] ) );
					} else {
						$keys[ $id ] = wp_strip_all_tags( $item[ $sort_type ] );
					}
				}
			}

			// Sort titles / captions.
			if ( 'ASC' === $sort_direction ) {

				natcasesort( $keys );

			} else {

				arsort( $keys, SORT_NATURAL | SORT_FLAG_CASE );

			}

			// Iterate through sorted items, rebuilding gallery.
			$new_sort = [];
			foreach ( $keys as $key => $title ) {
				$new_sort[ $key ] = $data['gallery'][ $key ];
			}

			// Assign back to gallery.
			$data['gallery'] = $new_sort;

			break;
		/**
		* Published Date.
		*/
		case 'date':
			// Get published date for each.
			$keys = [];
			foreach ( $data['gallery'] as $id => $item ) {
				// If the attachment isn't in the Media Library, we can't get a post date - assume now.
				$attachment = get_post( $id );
				if ( ! is_numeric( $id ) || ( false === $attachment ) ) {
					$keys[ $id ] = gmdate( 'Y-m-d H:i:s' );
				} else {
					$keys[ $id ] = ( ! empty( $attachment->post_date ) ) ? $attachment->post_date : false;
				}
			}

			// Sort titles / captions.
			if ( 'ASC' === $sort_direction ) {
				asort( $keys );
			} else {
				arsort( $keys );
			}

			// Iterate through sorted items, rebuilding gallery.
			$new = [];
			foreach ( $keys as $key => $title ) {
				$new[ $key ] = $data['gallery'][ $key ];
			}

			// Assign back to gallery.
			$data['gallery'] = $new;
			break;
		case 'date':
			break;
		case '0':
			break;

	}

	$data = apply_filters( 'envira_sort_gallery_custom', $data, $sort_type, $sort_direction, $flush_cache );

	return $data;
}

/**
 * Helper method to return the max execution time for scripts.
 *
 * @since 1.7.0
 */
function envira_get_max_execution_time() {

	$time = ini_get( 'max_execution_time' );
	return ! $time || empty( $time ) ? (int) 0 : $time;
}

/**
 * Helper method to return the transient expiration time
 *
 * @since 1.7.0
 *
 * @param string $plugin Plugin to get transient Expiration Time.
 * @return int Expiration Time (in seconds)
 */
function envira_get_transient_expiration_time( $plugin = 'envira-gallery' ) {

	// Define the default.
	$default = DAY_IN_SECONDS;

	// Allow devs to filter this depending on the plugin.
	$default = apply_filters( 'envira_gallery_get_transient_expiration_time', $default, $plugin );

	// Return.
	return $default;
}

/**
 * Iterates through all Post Types, returning an array of reserved slugs
 *
 * @since 1.7.0
 */
function envira_standalone_get_reserved_post_type_slugs() {

	$post_types = get_post_types();
	if ( ! is_array( $post_types ) ) {
		return; // Something went wrong fetching Post Types.
	}

	$slugs = [];
	foreach ( $post_types as $post_type ) {
		// Skip our own post type.
		if ( 'envira' === $post_type || 'envira_album' === $post_type ) {
			continue;
		}

		$post_type_obj = get_post_type_object( $post_type );

		if ( ! isset( $post_type_obj->rewrite['slug'] ) ) {
			continue;
		}

		// Add slug to array.
		$slugs[] = $post_type_obj->rewrite['slug'];
	}

	return $slugs;
}

/**
 * Checks whether to see if Standlone is enabled.
 *
 * Since 1.7.0
 *
 * @access public
 * @return bool
 */
function envira_is_standalone_enabled() {

	$standalone = envira_get_setting( 'standalone_enabled' );

	if ( ! $standalone ) {

		return false;

	}

	return true;
}

/**
 * Helper method to minify a string of data.
 *
 * @since 1.7.0
 *
 * @param string $string_data String of data to minify.
 * @param bool   $strip_double_foward_slashes Strip Double Forward Slashes.
 *
 * @return string $string Minified string of data.
 */
function envira_minify( $string_data, $strip_double_foward_slashes = true ) {

	// Added a switch for stripping double forwardslashes.
	// This can be disabled when using URLs in JS, to ensure http:// doesn't get removed.
	// All other comment removal and minification will take place.
	$strip_double_foward_slashes = apply_filters( 'envira_minify_strip_double_forward_slashes', $strip_double_foward_slashes );

	if ( $strip_double_foward_slashes ) {
		$clean = preg_replace( '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/', '', $string_data );
	} else {
		// Use less aggressive method.
		$clean = preg_replace( '!/\*.*?\*/!s', '', $string_data );
		$clean = preg_replace( '/\n\s*\n/', "\n", $clean );
	}

	$clean = str_replace( [ "\r\n", "\r", "\t", "\n", '  ', '    ', '        ' ], '', $clean );

	return apply_filters( 'envira_gallery_minified_string', $clean, $string_data );
}

/**
 * Gets the slug from the options table. If blank or does not exist, defaults
 * to 'envira'
 *
 * @since 1.7.0
 *
 * @param string $type Type (gallery|albums).
 * @return string $slug Slug.
 */
function envira_standalone_get_the_slug( $type ) {

	// Get slug.
	switch ( $type ) {
		case 'gallery':
			$slug = get_option( 'envira-gallery-slug' );
			if ( ! $slug || empty( $slug ) ) {
				// Fallback to check for previous version option name.
				$slug      = get_option( 'envira_standalone_slug' );
				$galleries = envira_get_galleries( false, false ); // don't ignore empty, don't ignore cache.
				if ( ( ! $slug || empty( $slug ) ) && false === $galleries ) {
					$slug = 'gallery';
				} else {
					$slug = 'envira';
				}
			}
			break;

		case 'albums':
			$slug = get_option( 'envira-albums-slug' );
			if ( ! $slug || empty( $slug ) ) {
				$albums = function_exists( 'get_albums' ) ? envira_get_albums( false, false ) : false; // don't ignore empty, don't ignore cache.
				if ( false === $albums ) {
					$slug = 'album';
				} else {
					$slug = 'envira_album';
				}
			}
			break;

		default:
			$slug = 'envira'; // Fallback.
			break;
	}

	return $slug;
}

/**
 * Old function that got the slug from the options table. Has to be here if someone is using older albums addon.
 *
 * @since 1.8.4.5
 *
 * @param string $type Type (gallery|albums).
 * @return string $slug Slug.
 */
function envira_standalone_get_slug( $type ) {

	return envira_standalone_get_the_slug( $type );
}

/**
 * Helper method for getting a setting's value. Falls back to the default
 * setting value if none exists in the options table.
 *
 * @since 1.7.0
 *
 * @param string $key   The setting key to retrieve.
 * @param string $default_value Default value.
 *
 * @return string       Key value on success, false on failure.
 */
function envira_get_setting( $key, $default_value = '' ) {

	// Prefix the key.
	$prefixed_key = 'envira_gallery_' . $key;

	// Get the option value.
	$value = get_option( $prefixed_key );

	// If no value exists, fallback to the default.
	if ( ! isset( $value ) || false === $value ) {
		$value = ( '' !== $default_value ) ? $default_value : envira_get_setting_default( $key );
	}

	// Allow devs to filter.
	$value = apply_filters( 'envira_gallery_get_setting', $value, $key, $prefixed_key );

	return $value;
}

/**
 * Helper method for getting a setting's default value
 *
 * @since 1.7.0
 *
 * @param string $key   The default setting key to retrieve.
 * @return string       Key value on success, false on failure.
 */
function envira_get_setting_default( $key ) {

	// Prepare default values.
	$defaults = envira_get_setting_defaults();

	// Return the key specified.
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : false;
}

/**
 * Retrieves the default settings
 *
 * @since 1.7.0
 *
 * @return array       Array of default settings.
 */
function envira_get_setting_defaults() {

	// Prepare default values.
	$defaults = [
		'media_position'     => 'after',
		'standalone_enabled' => true,
		'compression_sizes'  => [],
	];

	// Allow devs to filter the defaults.
	$defaults = apply_filters( 'envira_gallery_settings_defaults', $defaults );

	return $defaults;
}

/**
 * Helper method for updating a setting's value.
 *
 * @since 1.7.0
 *
 * @param string $key   The setting key.
 * @param string $value The value to set for the key.
 * @return void
 */
function envira_update_setting( $key, $value ) {

	// Prefix the key.
	$key = 'envira_gallery_' . $key;

	// Allow devs to filter.
	$value = apply_filters( 'envira_gallery_get_setting', $value, $key );

	// Update option.
	update_option( $key, $value );
}

/**
 * Helper Method to get allowed tags.
 *
 * @access public
 * @param array $tags (default: array()) Tags to allow.
 * @return array
 */
function envira_get_allowed_tags( $tags = [] ) {

	$allowed_html_tags = [
		'a'      => [
			'href'   => [],
			'title'  => [],
			'class'  => [],
			'target' => [],
		],
		'br'     => [],
		'hr'     => [],
		'em'     => [],
		'strong' => [],
		'p'      => [],
		'strike' => [],
		'del'    => [],
	];

	$tags = wp_parse_args( $tags, $allowed_html_tags );

	return apply_filters( 'envira_gallery_allowed_tags', $tags );
}
