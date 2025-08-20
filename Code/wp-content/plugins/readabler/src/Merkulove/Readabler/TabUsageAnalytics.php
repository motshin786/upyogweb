<?php
/**
 * Readabler
 * Web accessibility for Your WordPress site.
 * Exclusively on https://1.envato.market/readabler
 *
 * @encoding        UTF-8
 * @version         1.6.5
 * @copyright       (C) 2018 - 2023 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 * @license         Envato License https://1.envato.market/KYbje
 **/

namespace Merkulove\Readabler;

use Merkulove\Readabler\Unity\Settings;
use Merkulove\Readabler\Unity\TabGeneral;

final class TabUsageAnalytics {

	/**
	 * @param $tabs - List of tabs with all settings and fields.
	 *
	 * @return array - List of tabs with all settings and fields.
	 */
	public static function create_tab_analytics( $tabs ): array {

		$options = Settings::get_instance()->options;

		$fields = self::fields_highlight_titles( $options ) ?? [];

		$offset = 8;
		return array_slice( $tabs, 0, $offset, true ) +
	        [
				'usage_analytics' => [
		        'enabled'       => count( $fields ) > 0,
		        'class'         => TabGeneral::class,
		        'label'         => esc_html__( 'Analytics', 'readabler' ),
		        'title'         => esc_html__( 'Usage analytics', 'readabler' ),
		        'show_title'    => true,
		        'icon'          => 'show_chart',
		        'fields'        => self::fields_highlight_titles( $options )
	        ]
	        ] + array_slice( $tabs, $offset, NULL, true );

	}

	/**
	 * @param $options
	 *
	 * @return array
	 */
	private static function fields_highlight_titles( $options ): array {

		$key = 'analytics';
		$divider = 0;
		$fields = [];

		$fields[ $key ] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Usage analytics', 'readabler' ),
			'description'       => wp_sprintf(
				/* translators: %s - link to dashboard */
				esc_html__( 'Collect anonymous information about usage of Readabler by your visitors. Usage Analytics widget available on your website %s', 'readabler' ),
				'<a href="' . esc_url( admin_url(  ) ) . '">' . esc_html__( 'WordPress Dashboard', 'readabler' ) . '</a>',
			),
			'default'           => 'off',
		];

		// Send interval
		$default_send_interval = 2;
		$fields[ $key . '_send_interval' ] = [
			'type'              => 'slider',
			'label'             => esc_html__( 'Send interval', 'readabler' ),
			'description'       => esc_html__( 'Interval for sending data to the server:', 'readabler' ) .
               ' <strong>' .
               esc_attr( $options[ $key . '_send_interval' ] ?? $default_send_interval ) .
               '</strong>' . esc_html__( ' seconds', 'readabler' ),
			'min'               => 1,
			'max'               => 60,
			'step'              => 1,
			'default'           => $default_send_interval,
			'discrete'          => false,
		];

		$fields[ $key . '_divider_' . $divider++ ] = [
			'type'              => 'divider',
		];

		// Dashboard widget
		$fields[ $key . '_dashboard_widget' ] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Dashboard widget', 'readabler' ),
			'description'       => esc_html__( 'Show usage analytics widget on the dashboard', 'readabler' ),
			'default'           => 'on',
		];

		// Post metabox
		$fields[ $key . '_metabox' ] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Post metabox', 'readabler' ),
			'description'       => esc_html__( 'Show usage analytics metabox on the post edit page', 'readabler' ),
			'default'           => 'on',
		];

		// Analytics column
		$fields[ $key . '_column' ] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Analytics column', 'readabler' ),
			'description'       => esc_html__( 'Show usage analytics column on the posts list page', 'readabler' ),
			'default'           => 'on',
		];

		$fields[ $key . '_divider_' . $divider++ ] = [
			'type'              => 'divider',
		];

		$fields[ $key . '_gdpr' ] = [
			'type'              => 'switcher',
			'label'             => esc_html__( 'Strict GDPR', 'readabler' ),
			'description'       => esc_html__( 'Enable to comply strong GDPR regulation in some countries. Recommended to enable for Germany jurisdiction websites.', 'readabler' ),
			'default'           => 'off',
		];

		$fields[ $key . '_divider_' . $divider++ ] = [
			'type'              => 'divider',
		];

		// Reset table
		$fields[ $key . '_reset' ] = [
			'type'              => 'button',
			'label'             => esc_html__( 'Clear analytics', 'readabler' ),
			'description'       => esc_html__( 'Reset usage analytics data and remove table with all data', 'readabler' ),
			'icon'              => 'delete',
			'attr'              =>  [
				"class" => "mdc-button--outlined"
			]
		];

		return $fields;

	}


}
