<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package treck
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<script
src="https://translation-plugin.bhashini.co.in/v2/website_translation_
utility.js" data-pos-x="5" data-pos-y="10"></script>
</head>

<body <?php body_class(); ?>>
<!-- Your website content goes here -->
<!-- Bhashini Translation Plugin Script -->
<script
src="https://translation-plugin.bhashini.co.in/v2/website_transla
tion_utility.js" data-pos-x="5" data-pos-y="10"></script>



<style>
.counter-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 0 0 -100px ;
}

#total-visitors-counter {
    display: inline-block;
    font-size: 1.5em;
    font-family: 'Courier New', Courier, monospace;
    color: #fff;
    background: #574B73;
    padding: 5px 10px;
    border-radius: 5px;
    text-align: center;
    letter-spacing: 0.1em;
    font-weight: bold;
}

</style>
<script>
	document.addEventListener('DOMContentLoaded', function () {
    const counterElement = document.getElementById('total-visitors-counter');
    const startValue = parseInt(counterElement.getAttribute('data-start'));
    const endValue = parseInt(counterElement.getAttribute('data-end'));
    const duration = 2000; // Animation duration in milliseconds
    const stepTime = Math.max(Math.floor(duration / (endValue - startValue)), 20);
    let currentValue = startValue;

    function animateCounter() {
        currentValue += 1;
        counterElement.textContent = currentValue.toString().padStart(5, '0'); // Pad with leading zeros
        if (currentValue < endValue) {
            setTimeout(animateCounter, stepTime);
        }
    }

    counterElement.textContent = startValue.toString().padStart(5, '0'); // Set initial value with leading zeros
    animateCounter();
});

</script>

	<?php wp_body_open(); ?>

	<?php $treck_preloader_status = get_theme_mod('preloader', 'no'); ?>
	<?php if ('yes' == $treck_preloader_status) : ?>
		<!-- Preloader -->
		<div class="preloader">
			<div class="preloader__image"></div>
		</div>
	<?php endif; ?>
	<!-- /.preloader -->

	<div id="page" class="site page-wrapper">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'treck'); ?></a>

		<?php do_action('treck_header'); ?>

		<?php $treck_page_header_status = empty(get_post_meta(get_the_ID(), 'treck_show_page_banner', true)) ? 'on' : get_post_meta(get_the_ID(), 'treck_show_page_banner', true);
		?>

		<?php if (is_page() && 'on' === $treck_page_header_status) : ?>
			<?php get_template_part('template-parts/layout/page', 'header'); ?>
		<?php elseif (!is_page()) : ?>
			<?php get_template_part('template-parts/layout/page', 'header'); ?>
		<?php endif; ?>