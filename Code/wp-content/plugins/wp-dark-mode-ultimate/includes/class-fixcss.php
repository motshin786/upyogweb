<?php
/**
 * Fixes CSS selectors.
 *
 * @package WP_Dark_Mode_Ultimate
 * @since 3.0.0
 */

// Namespace.
namespace WP_Dark_Mode_Ultimate;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'FixCSS') ) {
	/**
	 * Fixes CSS selectors.
	 *
	 * @since 3.0.0
	 */
	class FixCSS {
		/**
		 * Adds parent selector to all selectors for a given CSS string, keeping the CSS properties in one line.
		 *
		 * @param string $css CSS string; Nested 1 level only.
		 * @param string $custom_selector Parent selector.
		 * @return string Fixed CSS string.
		 */
		public function add_selector( $css, $custom_selector ) {
			$css = $this->minify( $css );

			// Split the CSS string into an array of individual rules.
			$css_rules = preg_split('/}/', $css);
			// Initialize the new CSS string.
			$new_css = '';
			// Loop through each rule.
			foreach ( $css_rules as $rule ) {
				// Split the rule into the selector and properties.
				$parts = preg_split('/{/', $rule, 2);
				// If the rule has a selector and properties.
				if ( count($parts) == 2 ) {
					// Add the selector to the new CSS string, followed by a newline.
					$new_css .= $custom_selector . ' ' . trim($parts[0]) . " {\n";
					// Add the properties to the new CSS string, indented by one tab.
					$new_css .= "\t" . trim($parts[1]) . "\n";
					// Add the closing curly brace for the rule.
					$new_css .= "}\n";
				}
			}
			return $new_css;
		}

		/**
		 * Minifies CSS.
		 *
		 * @param string $css CSS string.
		 * @return string Minified CSS string.
		 */
		public function minify( $css ) {
			// Remove comments.
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

			// Remove space after colons.
			$css = str_replace(': ', ':', $css);

			// Remove whitespace.
			$css = str_replace([ "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ], '', $css);

			return $css;
		}
	}
}