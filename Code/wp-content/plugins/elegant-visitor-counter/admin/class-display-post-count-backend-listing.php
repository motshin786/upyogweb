<?php

/**
 * Display post count in backend post listing page
 * @since      3.0.1
 */
class Display_post_count_backend_listing {

	/*
	 * function to get the post count of a Post
	 *
	 * @since      3.0.1
	 * @param      $post_ID
	 */
	function evc_columns_head( $defaults ) {
		$defaults['post_views'] = '<span class="dash-icon dashicons dashicons-chart-bar" title="Post Views"></span>';

		return $defaults;
	}

	/*
	 * function to display table heading
	 *
	 * @since      3.0.1
	 * @param      $defaults
	 */
	function evc_columns_content( $column_name, $post_ID ) {
		if ( $column_name == 'post_views' ) {
			$post_post_views = $this->evc_get_post_count( $post_ID );
			if ( $post_post_views ) {
				echo '<p>' . $post_post_views . '</p>';
			}
		}
	}

	/*
	* SHOW THE post count in listing page of post
	*
	* @since      3.0.1
	* @param      $defaults
	*/
	function evc_get_post_count( $post_ID ) {
		$meta = 0;
		$meta = get_post_meta( $post_ID, '_epvc_post_views', true );
		$meta = '' !== $meta ? explode( ',', $meta ) : array();

		return (int)count( $meta );
	}

	/*
		 * add_filter, add_action to display post count in backend
		 *
		 * @since      3.0.1
		 * @param      $defaults
		 */
	function display_post_count_backend() {
		add_filter( 'manage_posts_columns', array( $this, 'evc_columns_head' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'evc_columns_content' ), 10, 2 );
	}
}