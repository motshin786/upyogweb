<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function treck_child_theme_setup()
{
    load_child_theme_textdomain('treck-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'treck_child_theme_setup');

if (!function_exists('treck_child_thm_parent_css')) :
    function treck_child_thm_parent_css()
    {
        // loading parent styles
        wp_enqueue_style('treck-parent-style', get_template_directory_uri() . '/style.css', array('treck-fonts', 'treck-icons', 'bootstrap', 'fontawesome'));

        // loading child style based on parent style
        wp_enqueue_style('treck-style', get_stylesheet_directory_uri() . '/style.css', array('treck-parent-style'));
    }

endif;
add_action('wp_enqueue_scripts', 'treck_child_thm_parent_css');

// END ENQUEUE PARENT ACTION