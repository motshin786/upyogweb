<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Services Two Start -->
	<section class="services-two">
		<div class="section-title text-center">
			<div class="section-title__tagline-box">
				<?php
				if (!empty($settings['sec_sub_title'])) :
					$this->add_inline_editing_attributes('sec_sub_title', 'none');
					treck_elementor_rendered_content($this, 'sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_one']);
				endif;
				?>
				<div class="section-title__border-box"></div>
			</div>

			<?php
			if (!empty($settings['sec_title'])) :
				$this->add_inline_editing_attributes('sec_title', 'none');
				treck_elementor_rendered_content($this, 'sec_title', 'section-title__title', $settings['section_title_tag_layout_one']);
			endif;
			?>
		</div>
		<div class="services-two__wrap">
			<?php if (!empty($settings['layout_one_bg_image']['url'])) : ?>
				<div class="services-two__shape-1" style="background-image: url(<?php echo esc_url($settings['layout_one_bg_image']['url']); ?>);"></div>
			<?php endif; ?>
			<div class="container">
				<div class="services-two__inner">
					<div class="services-two__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
						<?php $i = 1;
						foreach ($settings['layout_one_visa_items'] as $index => $item) : ?>
							<!--Services Two Single End -->
							<div class="item">
								<div class="services-two__single">
									<div class="services-two__single-inner">
										<div class="services-two__content">
											<<?php echo esc_attr($item['service_title_tag_layout_one']); ?> class="services-two__title">
												<?php
												if (!empty($item['title'])) :
													treck_basic_rendered_content($this, $item,  'title', '', 'a');
												endif;
												?>
											</<?php echo esc_attr($item['service_title_tag_layout_one']); ?>>
											<?php
											if (!empty($item['tag_line'])) :
												treck_basic_rendered_content($this, $item,  'tag_line', 'services-two__text-1', 'p');
											endif;
											?>
										</div>
										<div class="services-two__img-box">
											<div class="services-two__icon icon-svg-large">
												<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
											</div>
											<div class="services-two__img">
												<?php treck_elementor_rendered_image($item, 'image'); ?>
											</div>
										</div>
										<div class="services-two__hover-content-box">
											<div class="services-two__hover-bg" style="background-image: url(<?php echo esc_url($item['hover_image']['url']); ?>);">
											</div>
											<div class="services-two__hover-content">
												<<?php echo esc_attr($item['service_title_tag_layout_one']); ?> class="services-two__hover-title">
													<?php
													if (!empty($item['title'])) :
														treck_basic_rendered_content($this, $item,  'title', '', 'a');
													endif;
													?>
												</<?php echo esc_attr($item['service_title_tag_layout_one']); ?>>
												<?php
												if (!empty($item['text'])) :
													treck_basic_rendered_content($this, $item,  'text', 'services-two__hover-text', 'p');
												endif;
												?>
											</div>
											<div class="services-two__hover-icon icon-svg-large">
												<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Services Two Single End -->
						<?php $i++;
						endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Services Two End -->
<?php endif; ?>