<?php if ('layout_two' === $settings['layout_type']) : ?>
	<!--Countries Two Start -->
	<section class="countries-two">
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_two_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_two_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_two_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_two']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['layout_two_sec_title'])) :
					$this->add_inline_editing_attributes('layout_two_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_two_sec_title', 'section-title__title', $settings['section_title_tag_layout_two']);
				endif;
				?>
			</div>
			<div class="countries-two__bottom">
				<div class="countries-two__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
					<?php $i = 1;
					foreach ($settings['layout_two_country_items'] as $index => $item) : ?>
						<!--Countries Two Single Start-->
						<div class="item">
							<div class="countries-two__single">
								<div class="countries-two__name-and-img">
									<div class="countries-two__name">
										<<?php echo esc_attr($item['country_title_tag_layout_two']); ?>>
											<?php
											if (!empty($item['title'])) :
												treck_basic_rendered_content($this, $item,  'title', '', 'a');
											endif;
											?>
										</<?php echo esc_attr($item['country_title_tag_layout_two']); ?>>
									</div>
									<div class="countries-two__img">
										<?php treck_elementor_rendered_image($item, 'image'); ?>
									</div>
								</div>
								<ul class="countries-two__points list-unstyled ml-0">
									<?php echo wp_kses_post($item['content']); ?>
								</ul>
							</div>
						</div>
						<!--Countries Two Single End-->
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<!--Countries Two End -->
<?php endif; ?>