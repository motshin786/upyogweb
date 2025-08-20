<?php if ('layout_two' === $settings['layout_type']) : ?>
	<!-- Main Slider Start -->
	<section class="main-slider-two">
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
			<?php foreach ($settings['layout_two_sliders'] as $slider) : ?>
				<div class="item main-slider__slide-1">
					<div class="main-slider-two__bg" style="background-image: url(<?php echo esc_url($slider['background_image']['url']); ?>);">
					</div><!-- /.slider-one__bg -->
					<div class="main-slider-two__shadow" style="background-image: url(<?php echo esc_url($slider['bg_shape']['url']); ?>);"></div>
					<div class="container">
						<div class="main-slider-two__content">
							<div class="main-slider-two__shape-1 img-bounce">
								<?php treck_elementor_rendered_image($slider, 'icon'); ?>
							</div>
							<?php
							if (!empty($slider['title'])) :
								treck_basic_rendered_content($this, $slider,  'title', 'main-slider-two__title', $slider['title_tag_layout_two']);
							endif;
							?>
							<ul class="list-unstyled main-slider-two__points ml-0">
								<?php echo wp_kses_post($slider['check_list']); ?>
							</ul>
							<div class="main-slider-two__btn-box">
								<?php
								if (!empty($slider['button_label'])) :
									treck_basic_rendered_content($this, $slider,  'button_label', 'main-slider-two__btn thm-btn', 'a', 'button_url');
								endif;
								?>
							</div>
						</div>
						<div class="main-slider__feature">
							<div class="row">
								<?php foreach ($settings['layout_two_features'] as $feature) : ?>
									<!--Main Slider Feature Single Start -->
									<div class="col-xl-4 col-lg-4">
										<div class="main-slider__feature-single">
											<div class="main-slider__feature-icon icon-svg-large">
												<?php \Elementor\Icons_Manager::render_icon($feature['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
											</div>
											<div class="main-slider__feature-content">
												<h4 class="main-slider__feature-title">
													<?php
													if (!empty($feature['feature_title'])) :
														treck_basic_rendered_content($this, $feature,  'feature_title', '', 'a', 'button_url');
													endif;
													?>
												</h4>
												<p class="main-slider__feature-text"><?php echo esc_html($feature['summary']); ?></p>
											</div>
											<div class="main-slider__feature-arrow">
												<a <?php esc_attr(!empty($feature['button_url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($feature['button_url']['url']); ?>"><span class="icon-down"></span></a>
											</div>
										</div>
									</div>
									<!--Main Slider Feature Single End -->
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
	<!--Main Slider Start -->
<?php endif; ?>