<?php if ('layout_one' == $settings['layout_type']) : ?>

	<div class="services-details__img">
		<?php treck_elementor_rendered_image($settings, 'layout_one_image'); ?>
		<div class="services-details__img-icon icon-svg-large">
			<?php \Elementor\Icons_Manager::render_icon($settings['layout_one_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
		</div>
	</div>
<?php endif; ?>