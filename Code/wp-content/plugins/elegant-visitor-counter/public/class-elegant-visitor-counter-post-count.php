<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link
 * @since      3.0.0
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elegant_visitor_counter_post_count
 * @subpackage elegant_visitor_counter/public
 * @author     Sujan Karki <regolithjk@gamil.com>
 */
class Elegant_visitor_counter_post_count {

	/**
	 * @since      3.0.0
	 * @param      $atts
	 * @param      $content
	 * @param      $tag
	 *
	 * @return $meta //post count
	 */

	function get_post_view_count( $atts = [], $content = null, $tag = '' ) {
		$meta = 0;
		$this->set_visitor_count();
		if ( is_single() ) :
			$a = shortcode_atts( array(
				'post_id' => 0
			), $atts );
			$post_id = esc_attr( "{$a['post_id']}" );
			if ( 0 == $post_id && is_single() ) {
				$post_id = get_the_ID();
			}
			if ( !get_post( $post_id ) ) {
				return;
			}
			$meta = get_post_meta( $post_id, '_epvc_post_views', true );
			
			$meta = ('' !== $meta) ? explode( ',', $meta ) : array();
		endif;

		return (int)count( $meta );

	}

	/**
	 * @since      3.0.0
	 * @param
	 *
	 * @return mixed
	 */
	function set_visitor_count() {
		if ( is_single() ) {

			global $post;
			$user_ip = $_SERVER['REMOTE_ADDR'];
			$meta = get_post_meta( $post->ID, '_epvc_post_views', true );
			$meta = '' !== $meta ? explode( ',', $meta ) : array();
			$meta = array_filter( array_unique( $meta ) );
			if ( !in_array( $user_ip, $meta ) ) {

				array_push( $meta, $user_ip );
				update_post_meta( $post->ID, '_epvc_post_views', implode( ',', $meta ) );

			}
		}
	}
}
