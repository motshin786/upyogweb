<?php if ('layout_three' === $settings['layout_type']) : ?>

	<!-- Main Sllider Start -->
	<section class="main-slider-three">
		<div class="main-slider__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{"loop": <?php echo esc_attr(('yes' == $settings['loop']) ? 'true' : 'false'); ?>,
			"items": <?php echo esc_attr($settings['items']['size']); ?>, 
			"navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"], 
			"margin": 0, 
			"dots": <?php echo esc_attr(('yes' == $settings['enable_dots']) ? 'true' : 'false'); ?>, 
			"nav": <?php echo esc_attr(('yes' == $settings['enable_nav']) ? 'true' : 'false'); ?>, 
			"animateOut": "slideOutDown", 
			"animateIn": "fadeIn", 
			"active": true, 
			"smartSpeed": 1000, 
			"autoplay": true, 
			"autoplayTimeout": 7000, 
			"autoplayHoverPause": false}'>
			<?php foreach ($settings['layout_three_sliders'] as $slider) : ?>
				<div class="item main-slider-three__slide-1">
					<div class="main-slider-three__bg" style="background-image: url(<?php echo esc_url($slider['background_image']['url']); ?>);">
					</div><!-- /.slider-one__bg -->
					<div class="container">
						<div class="main-slider-three__content">
							<?php
							if (!empty($slider['sub_title'])) :
								treck_basic_rendered_content($this, $slider,  'sub_title', 'main-slider-three__sub-title', $slider['sub_title_tag_layout_three']);
							endif;
							?>

							<<?php echo esc_attr($slider['title_tag_layout_three']); ?> class="main-slider-three__title">
								<?php echo wp_kses_post($slider['title']); ?>
							</<?php echo esc_attr($slider['title_tag_layout_three']); ?>>

							<div class="main-slider-three__btn-box">
								<?php
								if (!empty($slider['button_one_label'])) :
									treck_basic_rendered_content($this, $slider,  'button_one_label', 'main-slider-three__btn-one thm-btn', 'a', 'button_one_url');
								endif;

								if (!empty($slider['button_two_label'])) :
									treck_basic_rendered_content($this, $slider,  'button_two_label', 'main-slider-three__btn-two thm-btn', 'a', 'button_two_url');
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
	<!--Main Sllider Start -->

<?php endif; ?>