<?php
// if direct access than exit the file.
defined( 'ABSPATH' ) || exit();
/**
 * WP dark mode premium color presets.
 *
 * @return array
 * @version 1.0.0
 */
function wp_dark_mode_pro_color_presets() {
	return [
		'1' => [
			'bg'   => '#1B2836',
			'text' => '#fff',
			'link' => '#459BE6',
		],
		'2' => [
			'bg'   => '#1E0024',
			'text' => '#fff',
			'link' => '#E251FF',
		],
		'3' => [
			'bg'   => '#270000',
			'text' => '#fff',
			'link' => '#FF7878',
		],
		'4' => [
			'bg'   => '#160037',
			'text' => '#EBEBEB',
			'link' => '#B381FF',
		],
		'5' => [
			'bg'   => '#121212',
			'text' => '#E6E6E6',
			'link' => '#FF9191',
		],
		'6' => [
			'bg'   => '#000A3B',
			'text' => '#FFFFFF',
			'link' => '#3AFF82',
		],
	];
}
/**
 * Get wp dark mode saved option data.
 *
 * @return boolean
 * @version 1.0.0
 */
function is_darkmode_active() {
	// Is wp dark mode installed and activated.
	if ( ! function_exists( 'wp_dark_mode' ) ) {
		return false;
	}

	return true;

}
