<?php if ('layout_nine' === $settings['layout_type']) : ?>

	<!--Services Three Start-->
	<section class="services-five">
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_nine_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_nine_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_nine_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_nine']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['layout_nine_sec_title'])) :
					$this->add_inline_editing_attributes('layout_nine_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_nine_sec_title', 'section-title__title', $settings['section_title_tag_layout_nine']);
				endif;
				?>
			</div>
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_nine_service_items'] as $index => $item) : ?>
					<!--Services Three Single Start-->
					<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="services-three__single">
							<div class="services-three__img-box">
								<div class="services-three__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
									<div class="services-three__icon-two icon-svg-large">
										<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
								</div>
								<div class="services-three__icon">
									<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
							</div>
							<div class="services-three__content">
								<div class="services-three__title-box">
									<<?php echo esc_attr($item['service_title_tag_layout_nine']); ?> class="services-three__title">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'a');
										endif;
										?>
									</<?php echo esc_attr($item['service_title_tag_layout_nine']); ?>>
								</div>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'services-three__text', 'p');
								endif;
								?>
								<div class="services-three__arrow">
									<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($item['url']['url']); ?>">
										<?php \Elementor\Icons_Manager::render_icon($item['read_more_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!--Services Three Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Services Three End-->
<?php endif; ?>