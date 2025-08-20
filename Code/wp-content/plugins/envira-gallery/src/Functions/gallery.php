<?php
/**
 * Envira Gallery Functions.
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
 * Get the Gallery Object.
 *
 * @since 1.7.0
 *
 * @access public
 * @param mixed   $gallery_id Gallery ID.
 * @param boolean $flush_cache Flush Cache.
 * @return array
 */
function envira_get_gallery( $gallery_id, $flush_cache = false ) {

	$gallery = get_transient( '_eg_cache_' . $gallery_id );

	// Attempt to return the transient first, otherwise generate the new query to retrieve the data.
	if ( true === $flush_cache || false === $gallery ) {
		$gallery = _envira_get_gallery( $gallery_id );
		if ( $gallery ) {
			$expiration = envira_get_transient_expiration_time();
			set_transient( '_eg_cache_' . $gallery_id, $gallery, $expiration );
		}
	}

	// Return the gallery data.
	return $gallery;
}

/**
 * Internal method that returns a gallery based on ID.
 *
 * @since 1.7.0
 *
 * @param int $gallery_id     The gallery ID used to retrieve a gallery.
 * @return array|bool Array of gallery data or false if none found.
 */
function _envira_get_gallery( $gallery_id ) {

	$meta = get_post_meta( $gallery_id, '_eg_gallery_data', true );

	/**
	* Version 1.2.1+: Check if $meta has a value - if not, we may be using a Post ID but the gallery
	* has moved into the Envira CPT
	*/
	if ( empty( $meta ) ) {
		$gallery_id = get_post_meta( $gallery_id, '_eg_gallery_id', true );
		$meta       = get_post_meta( $gallery_id, '_eg_gallery_data', true );
	}

	return $meta;
}

/**
 * Envira_get_gallery_by_slug function.
 *
 * @since 1.7.0
 *
 * @access public
 * @param string $slug Gallery Slug.
 * @return array
 */
function envira_get_gallery_by_slug( $slug ) {

	// Attempt to return the transient first, otherwise generate the new query to retrieve the data.
	$gallery = get_transient( '_eg_cache_' . $slug );

	if ( false === $gallery ) {

		$gallery = _envira_get_gallery_by_slug( $slug );

		if ( $gallery ) {
			$expiration = envira_get_transient_expiration_time();
			set_transient( '_eg_cache_' . $slug, $gallery, $expiration );
		}
	}

	// Return the gallery data.
	return $gallery;
}

/**
 * _envira_get_gallery_by_slug function.
 *
 * @since 1.7.0
 *
 * @access private
 * @param string $slug Gallery Slug.
 * @return boolean
 */
function _envira_get_gallery_by_slug( $slug ) {

	// Get Envira CPT by slug.
	$galleries = new WP_Query(
		[
			'post_type'      => 'envira',
			'name'           => $slug,
			'fields'         => 'ids',
			'posts_per_page' => 1,
		]
	);

	if ( $galleries->posts ) {
		return get_post_meta( $galleries->posts[0], '_eg_gallery_data', true );
	}

	// Get Envira CPT by meta-data field (yeah this is an edge case dealing with slugs in shortcode and modified slug in the misc tab of the gallery).
	$galleries = new WP_Query(
		[
			'post_type'      => 'envira',
			'meta_key'       => 'envira_gallery_slug',
			'meta_value'     => $slug, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
			'posts_per_page' => 1,
		]
	);

	if ( $galleries->posts ) {
		return get_post_meta( $galleries->posts[0], '_eg_gallery_data', true );
	}

	// If nothing found, get Envira CPT by _eg_gallery_old_slug.
	// This covers Galleries migrated from Pages/Posts --> Envira CPTs.
	$galleries = new WP_Query(
		[
			'post_type'      => 'envira',
			'no_found_rows'  => true,
			'cache_results'  => false,
			'fields'         => 'ids',
			'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				[
					'key'   => '_eg_gallery_old_slug',
					'value' => $slug,
				],
			],
			'posts_per_page' => 1,
		]
	);

	if ( $galleries->posts ) {
		return get_post_meta( $galleries->posts[0], '_eg_gallery_data', true );
	}

	// No galleries found.
	return false;
}

/**
 * Envira Get Galleries function.
 *
 * @since 1.7.0
 *
 * @access public
 * @param bool   $skip_empty (default: true).
 * @param bool   $ignore_cache (default: false).
 * @param string $search_terms (default: '').
 * @return array
 */
function envira_get_galleries( $skip_empty = true, $ignore_cache = false, $search_terms = '' ) {

	$galleries = get_transient( '_eg_cache_all' );

	// Attempt to return the transient first, otherwise generate the new query to retrieve the data.
	if ( $ignore_cache || ! empty( $search_terms ) || false === $galleries ) {
		$galleries = _envira_get_galleries( $skip_empty, $search_terms );

		// Cache the results if we're not performing a search and we have some results.
		if ( $galleries && empty( $search_terms ) ) {
			$expiration = envira_get_transient_expiration_time();
			set_transient( '_eg_cache_all', $galleries, $expiration );
		}
	}

	// Return the gallery data.
	return $galleries;
}

/**
 * Envira Get Galleries function but just the title and ids.
 *
 * @since 1.7.0
 *
 * @access public
 * @param bool   $skip_empty (default: true).
 * @param bool   $ignore_cache (default: false).
 * @param string $search_terms (default: '').
 * @return array
 */
function envira_get_galleries_title_id( $skip_empty = true, $ignore_cache = false, $search_terms = '' ) {

	$galleries = get_transient( '_eg_cache_title_id' );

	// Attempt to return the transient first, otherwise generate the new query to retrieve the data.
	if ( $ignore_cache || ! empty( $search_terms ) || false === $galleries ) {
		$galleries_temp = _envira_get_galleries( $skip_empty, $search_terms );
		// Cache the results if we're not performing a search and we have some results.
		if ( $galleries_temp && empty( $search_terms ) ) {
			$galleries = [];
			foreach ( $galleries_temp as $key => $gallery ) {
				$galleries[ $gallery['id'] ] = $gallery['config']['title'];
			}
			// order galleries by title.
			natcasesort( $galleries );
			$expiration = envira_get_transient_expiration_time();
			set_transient( '_eg_cache_title_id', $galleries, $expiration );
		}
	}

	// Return the gallery data.
	return $galleries;
}

/**
 * Envira Get Galleries function.
 *
 * @since 1.7.0
 *
 * @access public
 * @param bool   $skip_empty (default: true).
 * @param string $search_terms (default: '').
 * @param int    $posts_per_page (default: 99).
 * @param string $orderby (default: post_date).
 * @param string $order (default: DESC).
 * @return $ret array Gallery data.
 */
function _envira_get_galleries( $skip_empty = true, $search_terms = '', $posts_per_page = 99, $orderby = 'post_date', $order = 'DESC' ) {

	// Build WP_Query arguments.
	$args = [
		'post_type'      => 'envira',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'no_found_rows'  => true,
		'fields'         => 'ids',
		'orderby'        => $orderby,
		'order'          => $order,
		'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			[
				'key'     => '_eg_gallery_data',
				'compare' => 'EXISTS',
			],
		],
	];

	// If search terms exist, add a search parameter to the arguments.
	if ( ! empty( $search_terms ) ) {
		$args['s'] = $search_terms;
	}

	// Run WP_Query.
	$galleries = new WP_Query( $args );

	if ( ! isset( $galleries->posts ) || empty( $galleries->posts ) ) {
		return false;
	}

	// Now loop through all the galleries found and only use galleries that have images in them.
	$ret = [];
	foreach ( $galleries->posts as $id ) {

		$data = get_post_meta( $id, '_eg_gallery_data', true );

		// Skip empty galleries.
		if ( $skip_empty && empty( $data['gallery'] ) ) {
			continue;
		}

		// Skip default/dynamic gallery types.
		$type = envira_get_config( 'type', $data );
		if ( 'defaults' === $type || 'dynamic' === $type ) {
			continue;
		}

		// Add title.
		if ( isset( $data['config'] ) && is_array( $data['config'] ) ) {
			$data['config']['title'] = get_the_title( $id );
		}

		// Add gallery to array of galleries.
		$ret[ "$id" ] = $data;
	}

	// Return the gallery data.
	return $ret;
}

/**
 * Gallery image count function.
 *
 * @since 1.7.0
 *
 * @access public
 * @param mixed $gallery_id Gallery Id.
 * @return int
 */
function envira_get_gallery_image_count( $gallery_id ) {

	$data = get_post_meta( $gallery_id, '_eg_gallery_data', true );

	$gallery = apply_filters( 'envira_images_pre_data', $data, $gallery_id, false );

	return ( isset( $gallery['gallery'] ) ? count( $gallery['gallery'] ) : 0 );
}

/**
 * Returns full Gallery Config defaults to json object.
 *
 * @since 1.7.1
 *
 * @access public
 * @param mixed   $gallery_id Gallery Id.
 * @param boolean $raw Raw.
 * @param array   $data Gallery Data.
 * @param boolean $is_mobile Is mobile.
 * @return string
 */
function envira_get_gallery_config( $gallery_id, $raw = false, $data = null, $is_mobile = false ) {

	if ( ! isset( $gallery_id ) ) {
		return false;
	}

	$images = [];

	if ( ! empty( $data ) && ( 'dynamic' === $data['config']['type'] || 'default' === $data['config']['type'] ) ) {

		$data          = $data;
		$original_data = $data;

	} else {

		$data          = envira_get_gallery( $gallery_id );
		$original_data = $data;

		// temp hack: preserve keyboard and mousewheel settings (see 1980).
		$keyboard   = isset( $data['config']['keyboard'] ) ? $data['config']['keyboard'] : 1;
		$mousewheel = isset( $data['config']['mousewheel'] ) ? $data['config']['mousewheel'] : 1;

		// below filter makes keyboard 0 and makes mousewheel reappear as 0.
		$data['config']['keyboard']   = $keyboard;
		$data['config']['mousewheel'] = $mousewheel;

		$data = apply_filters( 'envira_gallery_pre_data', $data, $gallery_id );

	}

	if ( ! isset( $data['config']['gallery_id'] ) && isset( $data['id'] ) ) {
		$data['config']['gallery_id'] = $data['id'];
	}

	if ( $raw ) {

		return $data['config'];

	}

	// Santitize Description.
	if ( ! empty( $data['config']['description'] ) ) {
		$data['config']['description'] = envira_santitize_description( $data['config']['description'] );
	}

	// Santitize Options
	// Todo - create black/white list of options to santitize?
	foreach ( $data['config'] as $key => $value ) {
		$data['config'][ $key ] = envira_santitize_config_setting( $value, $key );
	}

	// This is a work-around for an edge case where mobile lightbox is enabled.
	if ( 1 === intval( $is_mobile ) && 1 === intval( $data['config']['mobile_lightbox'] ) ) {
		$data['config']['lightbox_enabled'] = 1;
	}

	// Add filter here for custom (or blocking) santitizing from addons.
	$data = apply_filters( 'envira_get_gallery_config', $data, $original_data, $is_mobile );

	// Disable/Remove FullScreen if Fullscreen addon is not present.
	if ( ! class_exists( 'Envira_Fullscreen' ) ) {
		if ( isset( $data['config']['open_fullscreen'] ) ) {
			unset( $data['config']['open_fullscreen'] );
		}
	}

	// Remove the download password if its set.
	if ( isset( $data['config']['password_protection_download'] ) ) {
		unset( $data['config']['password_protection_download'] );
	}

	// Disable/Remove Proofing if proofing addon is not present OR proofing isn't even activated.
	if ( ! class_exists( 'Envira_Proofing' ) || empty( $data['config']['proofing'] ) || 0 === $data['config']['proofing'] ) {
		foreach ( $data['config'] as $key => $value ) {
			if ( strtolower( substr( $key, 0, 8 ) ) === 'proofing' ) {
				unset( $data['config'][ $key ] );
			}
		}
		if ( isset( $data['config']['proofing_submitted_message'] ) ) {
			unset( $data['config']['proofing_submitted_message'] );
		}
		if ( isset( $data['config']['proofing_email_message'] ) ) {
			unset( $data['config']['proofing_email_message'] );
		}
		if ( isset( $data['config']['proofing_email_subject'] ) ) {
			unset( $data['config']['proofing_email_subject'] );
		}
	}

	// Disable/Remove FullScreen if CSS addon is not present.
	if ( ! function_exists( 'envira_custom_css_plugins_loaded' ) && isset( $data['config']['custom_css'] ) ) {
		unset( $data['config']['custom_css'] );
	}

	// Auto Thumbnail Size Check.
	$data = envira_maybe_set_thumbnail_size_auto( $data );

	return wp_json_encode( $data['config'] );
}

/**
 * General santitization of configuration settings
 *
 * @since 1.8.3
 *
 * @access public
 * @param string $value The value.
 * @param string $key The key.
 * @return array
 */
function envira_santitize_config_setting( $value, $key ) {

	/* at the moment we are only processing strings, either on their own or in arrays */

	if ( 'custom_css' === $key ) {
		/* Remove comments, updated for PHP 7.3 */
		$regex = [
			"`^([\t\s]+)`ism"                       => '',
			'`^\/\*(.+?)\*\/`ism'                   => '',
			'`(\A|[\n;]+)/\*.+?\*/`s'               => '$1',
			'`(\A|[;\s]+)//.+\R`'                   => "$1\n",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n",
		];
		$value = preg_replace( array_keys( $regex ), $regex, $value );
	}

	if ( gettype( $value ) === 'array' && ! empty( $value ) ) {
		foreach ( $value as $array_key => $array_value ) {
			if ( gettype( $array_value ) === 'string' ) {
				$value[ $array_key ] = htmlentities( $array_value, ENT_QUOTES );
			}
		}
		return $value;
	}

	if ( gettype( $value ) !== 'string' ) {
		return $value;
	}

	return htmlentities( $value, ENT_QUOTES );
}

/**
 * Main santitization function
 *
 * @since 1.8.3
 *
 * @access public
 * @param string $value String value.
 * @return array
 */
function envira_santitize_value( $value ) {

	return htmlentities( $value, ENT_QUOTES );
}

/**
 * Determine if lightbox width and height settings should be set to auto
 *
 * @since 1.8.3
 *
 * @access public
 * @param array $data Gallery data.
 * @return array
 */
function envira_maybe_set_thumbnail_size_auto( $data ) {

	if ( isset( $data['config']['thumbnails_custom_size'] ) && 0 === $data['config']['thumbnails_custom_size'] ) {
		$data['config']['thumbnails_width']  = 'auto';
		$data['config']['thumbnails_height'] = 'auto';
	}

	// if this value 'thumbnails_custom_size' isn't set/exists, then this is a gallery created/updated before 1.8.3 so the width/height values should be honored.
	return $data;
}

/**
 * Santitize Gallery Captions As They Are Requested
 * (This function has been depreciated)
 *
 * @since 1.7.1
 *
 * @access public
 * @param  string $caption The caption.
 * @return string
 */
function envira_santitize_caption( $caption ) {

	if ( empty( $caption ) ) {
		return '';
	}

	return envira_santitize_everything( $caption );
}

/**
 * Replace line breaks.
 *
 * @since 1.8.9.3
 *
 * @access public
 * @param  string $caption The caption.
 * @return string
 */
function envira_replace_linebreaks_with_brs( $caption ) {
	$caption = str_replace( [ "\r\n", "\r", "\n" ], '<br/>', $caption );
	$caption = preg_replace( '/\<br\b[^>]*>/i', ' ', $caption );
	return $caption;
}

/**
 * Replacement for mb_detect_encoding if it doesn't exist
 *
 * @since 1.8.4.2
 *
 * @access public
 *
 * @param string $string_encoded Incoming string.
 * @param string $enc Encoding.
 * @param string $ret Return.
 *
 * @return result
 */
function envira_detect_encoding( $string_encoded, $enc = null, $ret = null ) {

	static $enclist = [
		'UTF-8',
		'ASCII',
		'ISO-8859-1',
		'ISO-8859-2',
		'ISO-8859-3',
		'ISO-8859-4',
		'ISO-8859-5',
		'ISO-8859-6',
		'ISO-8859-7',
		'ISO-8859-8',
		'ISO-8859-9',
		'ISO-8859-10',
		'ISO-8859-13',
		'ISO-8859-14',
		'ISO-8859-15',
		'ISO-8859-16',
		'Windows-1251',
		'Windows-1252',
		'Windows-1254',
	];

	$result = false;

	foreach ( $enclist as $item ) {
		$sample = iconv( $item, $item, $string_encoded );
		if ( md5( $sample ) === md5( $string_encoded ) ) {
			if ( null === $ret ) {
				$result = $item;
			} else {
				$result = true; }
			break;
		}
	}

	return $result;
}

/**
 * Santitize Lightbox Captions As They Are Requested
 * (This function has been depreciated)
 *
 * @since 1.7.1
 *
 * @access public
 * @param string $lightbox_caption Caption.
 * @param string $context Context.
 * @return string
 */
function envira_santitize_lightbox_caption( $lightbox_caption, $context = false ) {

	if ( empty( $lightbox_caption ) ) {
		return false;
	}

	return envira_santitize_everything( $lightbox_caption, 'envira_santitize_lightbox_caption_' . $context );
}


/**
 * Santitize Gallery Titles As They Are Requested
 *
 * @since 1.7.1
 *
 * @access public
 * @param array $meta_data Meta Data.
 * @return void
 */
function envira_santitize_metadata( $meta_data ) {

	if ( ! $meta_data ) {
		return;
	}

	if ( is_array( $meta_data ) && ! empty( $meta_data ) ) {
		foreach ( $meta_data as $key => $data ) {
			$meta_data[ $key ] = envira_santitize_title( $data );
		}
	} else {
		$meta_data = envira_santitize_title( $meta_data );
	}

	return $meta_data;
}


/**
 * Santitize Gallery Titles As They Are Requested
 * (This function has been depreciated)
 *
 * @since 1.7.1
 *
 * @access public
 * @param string $title Gallery title.
 * @return string
 */
function envira_santitize_title( $title ) {

	if ( empty( $title ) || is_array( $title ) ) {
		return;
	}

	return envira_santitize_everything( $title );
}

/**
 * Santitize Gallery Titles As They Are Requested
 *
 * @since 1.7.1
 *
 * @access public
 *
 * @param string  $text String.
 * @param string  $type The type.
 * @param boolean $for_albums The context.
 *
 * @return string
 */
function envira_santitize_everything( $text, $type = 'title', $for_albums = false ) {

	if ( empty( $text ) || is_array( $text ) ) {
		return;
	}

	$encoding = ( function_exists( 'mb_detect_encoding' ) && mb_detect_encoding( $text ) !== 'ASCII' ) ? mb_detect_encoding( $text ) : 'utf-8';

	$filtered_string = $text;

	if ( 'envira_santitize_lightbox_caption_shortcode' === $type || 'opts-caption' === $type || 'title' === $type || 'alt' === $type || 'item-caption' === $type ) {
		$filtered_string = ( htmlentities( $text, ENT_QUOTES, $encoding ) );
	}

	if ( 'title' === $type ) {

		$filtered_string = str_replace( '&quot;', '"', $filtered_string );

		if ( $for_albums ) {
			$filtered_string = str_replace( '"', '&#34;', $filtered_string ); // album fails if quotes in title no matter what.
			$filtered_string = str_replace( "'", '&#39;', $filtered_string ); // album fails if quotes in title no matter what.
			$filtered_string = str_replace( '#', '&#163;', $filtered_string ); // album fails if quotes in title no matter what.
			$filtered_string = str_replace( '?', '&#63;', $filtered_string ); // album fails if quotes in title no matter what.
		}
	}
	if ( 'opts-caption' === $type || 'item-caption' === $type || 'gallery-description' === $type ) {

		$filtered_string = str_replace( '&quot;', '"', $filtered_string );
		if ( false === $for_albums ) {
			$filtered_string = str_replace( '"', '&#34;', $filtered_string ); // album fails if quotes in title no matter what.
		}
		$filtered_string = str_replace( "'", '&#39;', $filtered_string ); // album fails if quotes in title no matter what.
		$filtered_string = str_replace( '#', '&#163;', $filtered_string ); // album fails if quotes in title no matter what.
		$filtered_string = str_replace( '?', '&#63;', $filtered_string ); // album fails if quotes in title no matter what.
		$filtered_string = str_replace( '&&#163;039;', '&#39;', $filtered_string ); // album fails if quotes in title no matter what.

	}
	if ( strpos( $type, 'image_meta' ) !== false ) {
		$filtered_string = str_replace( '"', '&#34;', $filtered_string ); // album fails if quotes in title no matter what.
		$filtered_string = str_replace( "'", '&#39;', $filtered_string ); // album fails if quotes in title no matter what.
		$filtered_string = str_replace( '#', '&#163;', $filtered_string ); // album fails if quotes in title no matter what.
	}
	if ( 'alt' === $type ) {
		$filtered_string = str_replace( '&quot;', '"', $filtered_string );
	}

	// notes:.

	// - converting " to &quote breaks captions (meta-data) in albums lightbox https://testing.enviragallery.com/envira_album/ellie-kennard-album/
	// - no matter what form (&quot; or /" or anything) quotes in title breaks album lightbox https://testing.enviragallery.com/envira_album/ellie-kennard-album/

	return $filtered_string;
}



/**
 * Santitize Gallery Fields As They Are Requested
 * (This function has been depreciated)
 *
 * @since 1.7.1
 *
 * @access public
 * @param string $description Gallery description.
 * @return string
 */
function envira_santitize_description( $description ) {

	return envira_santitize_everything( $description, 'gallery-description' );
}

/**
 * Returns All Gallery Images defaults to json object.
 *
 * @since 1.7.1
 *
 * @access public
 *
 * @param mixed   $gallery_id Gallery id.
 * @param bool    $raw (default: false).
 * @param array   $data (default: null).
 * @param array   $return_sort_ids (default: false).
 * @param boolean $for_albums (default: false).
 * @param string  $gallery_type Type.
 * @param boolean $cache Enable cache.
 *
 * @return array
 */
function envira_get_gallery_images( $gallery_id, $raw = false, $data = null, $return_sort_ids = false, $for_albums = false, $gallery_type = false, $cache = true ) {

	if ( ! empty( $data ) && isset( $data['config']['sort_order'] ) && '1' === $data['config']['sort_order'] ) {

		$data = envira_insure_random_gallery( $data, $gallery_id, $cache );

	} else {

		/* if this isn't random sorting, then let's use transient caching */

		$cache = ( ! is_envira_debug_on() && true === $cache ) ? get_transient( '_eg_fragment_json_' . $gallery_id ) : false;

		if ( 'gutenberg' === $gallery_type ) {
			$data = envira_sort_gallery( $data, $data['config']['sort_order'], $data['config']['sorting_direction'] );
		}

		if ( $cache ) {

			if ( $raw ) {

				return json_decode( $cache['gallery_images'], true );

			} elseif ( false === $return_sort_ids ) {

					return $cache['gallery_images'];

			} else {

				return $cache;
			}
		}
	}

	if ( ! isset( $gallery_id ) ) {
		return false;
	}

	$images  = [];
	$sizes   = get_intermediate_image_sizes();
	$sizes[] = 'full';
	// make sure to get the album data because we need to check settings for title/caption override.
	$album_data = ( $for_albums && ! empty( $data ) ) ? $data : false;

	$is_dynamic = ! empty( $data ) && ( 'dynamic' === $data['config']['type'] || ! empty( $data['dynamic_id'] ) );

	if ( ! $is_dynamic ) {
		$data = envira_get_gallery( $gallery_id );
	}

	// Make sure it gets filtered.

	$i        = 0;
	$id_array = [];

	if ( isset( $data['gallery'] ) && is_array( $data['gallery'] ) ) {

		foreach ( (array) $data['gallery'] as $id => $item ) {

			// If the item isn't an array, bail. GH 2779.
			if ( ! is_array( $item ) ) {
				continue;
			}

			// Skip over images that are pending (ignore if in Preview mode).
			if ( isset( $item['status'] ) && 'pending' === $item['status'] && ! is_preview() ) {
				continue;
			}

			if ( is_numeric( $id ) && isset( $data['config']['type'] ) && 'instagram' !== $data['config']['type'] && 'fc' !== $data['config']['type'] ) {
				$image_size = envira_get_config( 'lightbox_image_size', $data );
				$image_data = wp_get_attachment_metadata( $id );
				$src        = wp_get_attachment_image_src( $id, $image_size );

				// check and see if this gallery as image_meta.
				if ( isset( $image_data['image_meta'] ) ) {
					// santitize image_meta.
					$image_data['image_meta']['caption'] = isset( $image_data['image_meta']['caption'] ) && ! empty( $image_data['image_meta']['caption'] ) && 'null' !== $image_data['image_meta']['caption'] ? envira_santitize_everything( $image_data['image_meta']['caption'], 'image_meta-caption', $for_albums ) : '';
					$image_data['image_meta']['title']   = isset( $image_data['image_meta']['title'] ) && ! empty( $image_data['image_meta']['title'] ) && 'null' !== $image_data['image_meta']['title'] ? envira_santitize_everything( $image_data['image_meta']['title'], 'image_meta-title', $for_albums ) : '';
					if ( isset( $image_data['image_meta']['keywords'] ) && is_array( $image_data['image_meta']['keywords'] ) && ! empty( $image_data['image_meta']['keywords'] ) ) {
						foreach ( $image_data['image_meta']['keywords'] as $index => $keyword ) {
							$image_data['image_meta']['keywords'][ $index ] = envira_santitize_everything( $keyword, 'image_meta-keyword', $for_albums );
						}
					}
					if ( is_array( $image_data['image_meta'] ) && ! empty( $image_data['image_meta'] ) ) {
						foreach ( $image_data['image_meta'] as $image_meta_id => $image_meta_data ) {
							if ( 'caption' === $image_meta_id || 'title' === $image_meta_id ) {
								continue;
							}
							$image_data['image_meta'][ $image_meta_id ] = envira_santitize_everything( $image_data['image_meta'][ $image_meta_id ], 'image_meta-' . $image_meta_id, $for_albums );
						}
					}

					$item['meta'] = $image_data['image_meta'];

				}

				/* album specific info */
				if ( $for_albums ) {
					$src = isset( $album_data['config']['lightbox_image_size'] ) && ! empty( $album_data['config']['lightbox_image_size'] ) ? wp_get_attachment_image_src( $id, $album_data['config']['lightbox_image_size'] ) : wp_get_attachment_image_src( $id, 'full' );

				}

				// assign src, but give non-scaled if full size image requested.
				$item['src']        = ! empty( $src[0] ) ? $src[0] : false;
				$new_full_sized_url = false;

				if ( 'full' === $image_size ) {
					$full_image          = wp_get_attachment_image_url( $id, $image_size );
					$full_image_filename = basename( $full_image );
					$new_full_sized_url  = false;
					if ( false !== strpos( $full_image_filename, '-scaled.' ) ) {
						// if WordPress 5.3 has considered full image 'scaled' we can undo this.
						$oringial_image_name = isset( $image_data['original_image'] ) && ! empty( $image_data['original_image'] ) ? $image_data['original_image'] : false;
						if ( $oringial_image_name ) {
							$new_full_sized_url = str_replace( $full_image_filename, $oringial_image_name, $full_image );
						} else {
							// if the oringial metadata isn't there...
							$oringial_image_name = str_replace( '-scaled.', '.', $full_image_filename );
							$new_full_sized_url  = str_replace( $full_image_filename, $oringial_image_name, $full_image );
							// TODO: Check and see if file exists?
						}
					}
				}

				$item['src'] = ( ! empty( $new_full_sized_url ) ) ? $new_full_sized_url : $item['src'];

				foreach ( $sizes as $size ) {
					$size_url      = wp_get_attachment_image_src( $id, $size );
					$item[ $size ] = isset( $size_url[0] ) && false !== $size_url[0] ? $size_url[0] : false;
				}
			}
			$dimensions = envira_get_thumbnail_dimensions( $data );

			$thumb_args = [
				'position' => envira_get_config( 'crop_position', $data ),
				'width'    => $dimensions['width'],
				'height'   => $dimensions['height'],
				'quality'  => 100,
				'retina'   => false,
			];

			$src = ( isset( $item['src'] ) && ! empty( trim( $item['src'] ) ) ) ? ( $item['src'] ) : false;
			// TODO refactor. In some cases we've resized the image before getting here. Explore further.
			$thumb = envira_resize_image( $src, $thumb_args['width'], $thumb_args['height'], true, envira_get_config( 'crop_position', $data ), $thumb_args['quality'], $thumb_args['retina'], $data );

			$item['title'] = ( isset( $item['title'] ) && ! empty( trim( $item['title'] ) ) ) ? envira_santitize_everything( $item['title'], 'title', $for_albums ) : '';
			$item['index'] = $i;
			$item['id']    = $id;
			$item['thumb'] = $thumb;
			$item['video'] = isset( $item['video_in_gallery'] ) ? true : false;

			$caption = envira_get_config( 'lightbox_title_caption', $data ) === 'title' ? envira_santitize_everything( $item['title'], 'captiontitle' ) : envira_santitize_everything( $item['title'], 'captioncaption' );

			$the_data = ( false !== $album_data ) ? $album_data : $data;

			$item['opts'] = [
				'caption' => ( isset( $item['caption'] ) && ! empty( trim( $item['caption'] ) ) ) ? envira_santitize_everything( $item['caption'], 'opts-caption', $for_albums ) : '',
				'thumb'   => $thumb,
				'title'   => ( isset( $item['title'] ) && ! empty( trim( $item['title'] ) ) ) ? envira_santitize_everything( $item['title'], 'opts-title' ) : '',
			];

			$item['alt']        = ( isset( $item['alt'] ) && ! empty( trim( $item['alt'] ) ) ) ? envira_santitize_everything( $item['alt'], 'alt' ) : '';
			$item['gallery_id'] = $gallery_id;
			$item['caption']    = ( isset( $item['caption'] ) && ! empty( trim( $item['caption'] ) ) ) ? envira_santitize_everything( $item['caption'], 'item-caption', $for_albums ) : false;

			/* album specific info */
			if ( $for_albums ) {
				$item['gallery_title'] = envira_get_config( 'title', $data ) ? envira_santitize_everything( envira_get_config( 'title', $data ), 'gallery-title' ) : envira_santitize_everything( get_the_title( $gallery_id ), 'gallery-title' );
			}

			$item = apply_filters( 'envira_gallery_output_item_data', $item, $id, $data, $i );

			$images[ $id ] = $item;

			$id_array[] = $id;

			++$i;

		}
	}

	// this holds all data, which we will store in transient - so that we can pull out what we need from the cache (see above).
	$full_data = [
		'gallery_images' => wp_json_encode( $images, JSON_UNESCAPED_UNICODE ),
		'sorted_ids'     => wp_json_encode( $id_array, JSON_UNESCAPED_UNICODE ),
	];

	// set the transient.
	$transient = set_transient( '_eg_fragment_json_' . $gallery_id, $full_data, WEEK_IN_SECONDS );

	if ( $raw ) {

		return $images;

	}

	if ( false === $return_sort_ids ) {

		return wp_json_encode( $images, JSON_UNESCAPED_UNICODE );

	} else {

		return ( $full_data );

	}
}

/**
 * Obtains thumbnail dimensions according to config.
 *
 * @param array $data Gallery data.
 *
 * @return array{width: numeric, height: numeric}
 */
function envira_get_thumbnail_dimensions( $data ) {
	$thumbnails_custom_size    = envira_get_config( 'thumbnails_custom_size', $data );
	$thumbnails_height         = envira_get_config( 'thumbnails_height', $data );
	$thumbnails_height_default = envira_get_config_default( 'thumbnails_height' );
	$thumbnails_width          = envira_get_config( 'thumbnails_width', $data );
	$thumbnails_width_default  = envira_get_config_default( 'thumbnails_width' );

	return [
		'width'  => $thumbnails_custom_size ? $thumbnails_width : $thumbnails_width_default,
		'height' => $thumbnails_custom_size ? $thumbnails_height : $thumbnails_height_default,
	];
}

/**
 * Helper method for setting default config values.
 *
 * @since 1.7.0
 *
 * @param string $key   The default config key to retrieve.
 * @return string       Key value on success, false on failure.
 */
function envira_get_config_default( $key ) {
	// Get the current post ID. If ajax, grab it from the $_POST variable.
	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification is handled in ajax.
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_POST['post_id'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification is handled in ajax.
		$post_id = absint( $_POST['post_id'] );
	} else {
		$post_id = get_the_ID();
	}

	// Prepare default values.
	$defaults = envira_get_config_defaults( $post_id );

	// Return the key specified.
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : false;
}

/**
 * Helper method for retrieving config values.
 *
 * @since 1.0.0
 *
 * @param string $key       The config key to retrieve.
 * @param array  $data      Gallery data.
 * @param string $default_value A default value to use.
 *
 * @return mixed            Key value on success, empty string on failure.
 */
function envira_get_config( $key, $data, $default_value = null ) {

	if ( ! is_array( $data ) ) {

		return envira_get_config_default( $key );

	}

	$is_mobile_keys = [];

	// If we are on a mobile device, some config keys have mobile equivalents, which we need to check instead.
	if ( envira_mobile_detect()->isMobile() ) {
		$is_mobile_keys = [
			'lightbox_enabled'                  => 'mobile_lightbox',
			'gallery_link_enabled'              => 'mobile_gallery_link_enabled',
			'arrows'                            => 'mobile_arrows',
			'toolbar'                           => 'mobile_toolbar',
			'thumbnails'                        => 'mobile_thumbnails',
			'thumbnails_width'                  => 'mobile_thumbnails_width',
			'thumbnails_height'                 => 'mobile_thumbnails_height',
			'additional_copy_automatic_title'   => 'additional_copy_automatic_title_mobile',
			'additional_copy_automatic_caption' => 'additional_copy_automatic_caption_mobile',
			'gallery_automatic_title_caption'   => 'gallery_automatic_title_caption_mobile',
			'additional_copy_title'             => 'additional_copy_title_mobile',
			'additional_copy_caption'           => 'additional_copy_caption_mobile',
			'gallery_column_title_caption'      => 'gallery_column_title_caption_mobile',
		];

		if ( isset( $data['config']['mobile'] ) && false !== $data['config']['mobile'] ) {
			$is_mobile_keys['crop_width']  = 'mobile_width';
			$is_mobile_keys['crop_height'] = 'mobile_height';

		}

		$is_mobile_keys = apply_filters( 'envira_gallery_get_config_mobile_keys', $is_mobile_keys );

		if ( array_key_exists( $key, $is_mobile_keys ) ) {
			// Use the mobile array key to get the config value.
			$key = $is_mobile_keys[ $key ];
		}
		// If the user hasn't overrided lightbox thumbnails with custom sizes, make sure these are set to auto.
	} elseif ( ( 'thumbnails_height' === $key || 'thumbnails_width' === $key ) && ( ! isset( $data['config']['thumbnails_custom_size'] ) || false === $data['config']['thumbnails_custom_size'] ) ) {
		$data['config'][ $key ] = 'auto';
	}

	// The toolbar is not needed for base dark so lets disable it.
	if ( 'toolbar' === $key && isset( $data['config']['lightbox_theme'] ) && 'base_dark' === $data['config']['lightbox_theme'] ) {
		$data['config'][ $key ] = 0;
	}

	// Disable/Remove FullScreen if Fullscreen addon is not present.
	if ( ! class_exists( 'Envira_Fullscreen' ) ) {
		if ( isset( $data['config']['open_fullscreen'] ) ) {
			unset( $data['config']['open_fullscreen'] );
		}
	}

	if ( isset( $data['config'] ) ) {
		$data['config'] = apply_filters( 'envira_gallery_get_config', $data['config'], $key );
	} else {
		$data['config'][ $key ] = false;
	}

	$default_value = null !== $default_value ? $default_value : envira_get_config_default( $key );

	return isset( $data['config'][ $key ] ) ? $data['config'][ $key ] : $default_value;
}


/**
 * Envira Get Gallery Data function.
 *
 * @access public
 * @param mixed $gallery_id The gallery id.
 * @return $data
 */
function envira_get_gallery_data( $gallery_id ) {

	// If no ID is set create a new gallery.
	if ( ! isset( $gallery_id ) ) {

		return false;
	}

	$data = get_post_meta( $gallery_id, '_eg_gallery_data', true );

	return $data;
}

/**
 * Helper function to prepare the metadata for an image in a gallery.
 *
 * @since 1.7.0
 *
 * @param array $gallery_data   Array of data for the gallery.
 * @param int   $id             The attachment ID to prepare data for.
 * @param array $image          Attachment image. Populated if inserting from the Media Library.
 * @return array $gallery_data Amended gallery data with updated image metadata.
 */
function envira_prepare_gallery_data( $gallery_data, $id, $image = false ) {

	// Get attachment.
	$attachment = get_post( $id );

	// Add this image to the start or end of the gallery, depending on the setting.
	$media_position = envira_get_setting( 'media_position' );

	// Depending on whether we're inserting from the Media Library or not, prepare the image array.
	if ( ! $image ) {
		$url       = wp_get_attachment_image_src( $id, 'full' );
		$alt_text  = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$new_image = [
			'status'  => 'active',
			'src'     => isset( $url[0] ) ? esc_url( $url[0] ) : '',
			'title'   => get_the_title( $id ),
			'link'    => ( isset( $url[0] ) ? esc_url( $url[0] ) : '' ),
			'alt'     => ! empty( $alt_text ) ? $alt_text : '',
			'caption' => ! empty( $attachment->post_excerpt ) ? $attachment->post_excerpt : '',
			'thumb'   => '',
		];
	} else {
		$new_image = [
			'status'  => 'active',
			'src'     => ( isset( $image['src'] ) ? $image['src'] : $image['url'] ),
			'title'   => $image['title'],
			'link'    => $image['link'],
			'alt'     => $image['alt'],
			'caption' => $image['caption'],
			'thumb'   => '',
		];
	}

	// Allow Addons to possibly add metadata now.
	$image = apply_filters( 'envira_gallery_ajax_prepare_gallery_data_item', $new_image, $image, $id, $gallery_data );

	// If gallery data is not an array (i.e. we have no images), just add the image to the array.
	if ( ! isset( $gallery_data['gallery'] ) || ! is_array( $gallery_data['gallery'] ) ) {
		$gallery_data['gallery']        = [];
		$gallery_data['gallery'][ $id ] = $image;
	} else {

		switch ( $media_position ) {
			case 'before':
				// Add image to start of images array
				// Store copy of images, reset gallery array and rebuild.
				$images                         = $gallery_data['gallery'];
				$gallery_data['gallery']        = [];
				$gallery_data['gallery'][ $id ] = $image;
				foreach ( $images as $old_image_id => $old_image ) {
					$gallery_data['gallery'][ $old_image_id ] = $old_image;
				}
				break;
			case 'after':
			default:
				// Add image, this will default to the end of the array.
				$gallery_data['gallery'][ $id ] = $image;
				break;
		}
	}

	// Filter and return.
	$gallery_data = apply_filters( 'envira_gallery_ajax_item_data', $gallery_data, $attachment, $id, $image );

	return $gallery_data;
}

/**
 * Random transient cache suffix
 *
 * @param string $gallery_id Gallery ID.
 * @return string
 */
function envira_get_random_transient_suffix( $gallery_id ) {
	return apply_filters( 'envira_get_random_transient_suffix', $gallery_id );
}

add_filter( 'envira_gallery_pre_data', 'envira_insure_random_gallery', 10, 3 );
add_filter( 'envira_images_pre_data', 'envira_insure_random_gallery', 10, 3 );


/**
 * Helper function to ensure random galleries bypass cache and are displayed randomly on the front end
 *
 * @since 1.7.0
 *
 * @param array   $data Array of data for the gallery.
 * @param int     $gallery_id The attachment ID to prepare data for.
 * @param boolean $should_cache_default Flush the transient or not.
 * @return array $data Updated gallery data
 */
function envira_insure_random_gallery( $data, $gallery_id, $should_cache_default = null ) {

	if ( ! $data || ! isset( $data['config']['sort_order'] ) || '1' !== $data['config']['sort_order'] ) {
		return $data;
	}

	if ( null === $should_cache_default ) {
		$should_cache_default = false;
	}

	$should_cache = apply_filters( 'envira_gallery_should_cache', $should_cache_default, $data );

	// Store transient, but check and see if there's one already.
	$gallery_data = get_transient( '_eg_fragment_gallery_random_sort_' . envira_get_random_transient_suffix( $data['id'] ) );
	// Attempt to return the transient first, otherwise generate the new query to retrieve the data.
	if ( false === $gallery_data || false === $should_cache ) {
		$expiration   = DAY_IN_SECONDS; // envira_get_transient_expiration_time could also be used here.
		$gallery_data = envira_sort_gallery( $data, '1', 'DESC' ); // '1' = random
		set_transient( '_eg_fragment_gallery_random_sort_' . envira_get_random_transient_suffix( $data['id'] ), $gallery_data, $expiration );
	}

	return $gallery_data;
}

add_filter( 'envira_gallery_get_transient_markup', 'envira_maybe_clear_cache_random', 10, 2 );

/**
 * Helper function to ensure random galleries bypass cache and are displayed randomly on the front end
 *
 * @since 1.7.0
 *
 * @param array $transient  Transient.
 * @param int   $data       Array of data for the gallery.
 * @return boolean          Allow cache or not.
 */
function envira_maybe_clear_cache_random( $transient, $data ) {
	if ( ! $data || ! isset( $data['config']['sort_order'] ) || 1 !== $data['config']['sort_order'] ) {
		return $transient;
	} else {
		return false;
	}
}

/**
 * Helper method to get the version the gallery was updated or created.
 *
 * @since 1.7.1
 *
 * @access public
 * @param mixed $gallery_id Gallery ID.
 * @return bool|intenger
 */
function envira_get_gallery_version( $gallery_id ) {

	if ( empty( $gallery_id ) ) {

		return false;

	}

	$version = get_post_meta( $gallery_id, '_eg_version', true );

	if ( ! empty( $version ) ) {

		return $version;

	}

	return false;
}

/**
 * Maybe update the gallery, check the version.
 *
 * @since 1.7.1
 *
 * @access public
 * @param mixed $gallery_id Gallery id.
 * @return boolean
 */
function envira_maybe_update_gallery( $gallery_id ) {

	$version = envira_get_gallery_version( $gallery_id );

	if ( ! isset( $version ) || version_compare( $version, '1.8.0', '<' ) ) {

		return true;
	}

	return false;
}

// Conditionally load the template tag.
if ( ! function_exists( 'envira_gallery' ) ) {

	/**
	 * Primary template tag for outputting Envira galleries in templates.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $id       The ID of the gallery to load.
	 * @param string $type      The type of field to query.
	 * @param array  $args          Associative array of args to be passed.
	 * @param bool   $result    Flag to echo or return the gallery HTML.
	 */
	function envira_gallery( $id, $type = 'id', $args = [], $result = false ) {

		// If we have args, build them into a shortcode format.
		$args_string = ! empty( $args ) ? ' ' . str_replace( '=', '="', http_build_query( $args, null, '" ', PHP_QUERY_RFC3986 ) ) . '" ' : false;

		// Build the shortcode.
		$shortcode = ! empty( $args_string ) ? '[envira-gallery ' . $type . '="' . $id . '"' . $args_string . ']' : '[envira-gallery ' . $type . '="' . $id . '"]';

		// Return or echo the shortcode output.
		if ( $result ) {

			return do_shortcode( $shortcode );

		} else {

			echo do_shortcode( $shortcode );

		}
	}
}
