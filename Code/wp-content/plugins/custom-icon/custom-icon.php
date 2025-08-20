<?php
/**
 * Plugin Name:       Interactive Geo Maps - Custom Icon
 * Description:       Adds custom icons to Interactive Geo Maps plugin
 * Version:           1.0
 * Requires PHP:      7.0
 * Author:            Carlos Moreira
 * Author URI:        https://cmoreira.net/
 */

add_filter( 'igm_available_icons', 'igm_custom_marker_icon' );
function igm_custom_marker_icon( $list ) {

	$list['custom_marker'] = [
		'title' => 'Custom Marker',
		'path'  => 'm10,0.40566c-3.97385,0 -7.19575,3.2219 -7.19575,7.19575s5.99646,11.99292 7.19575,11.99292s7.19575,-8.01907 7.19575,-11.99292s-3.2219,-7.19575 -7.19575,-7.19575zm0,11.99292c-2.64564,0 -4.79717,-2.15273 -4.79717,-4.79717s2.15153,-4.79717 4.79717,-4.79717s4.79717,2.15273 4.79717,4.79717s-2.15153,4.79717 -4.79717,4.79717z',
	];

	return $list;
}
?>