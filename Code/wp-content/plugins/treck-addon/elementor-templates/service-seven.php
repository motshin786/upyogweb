<?php if ('layout_seven' === $settings['layout_type']) : ?>

	<!--Coaching five Start-->
	<section class="coaching-five">
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_seven_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_seven_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_seven_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_seven']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>

				<?php
				if (!empty($settings['layout_seven_sec_title'])) :
					$this->add_inline_editing_attributes('layout_seven_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_seven_sec_title', 'section-title__title', $settings['section_title_tag_layout_seven']);
				endif;
				?>
			</div>
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_seven_service_items'] as $index => $item) : ?>
					<!--Coaching One Single Start-->
					<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="coaching-one__single">
							<div class="coaching-one__img-box">
								<div class="coaching-one__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
								<div class="coaching-one__content">
									<div class="coaching-one__shape-1">
										<?php treck_elementor_rendered_image($item, 'shape'); ?>
									</div>
									<<?php echo esc_attr($item['service_title_tag_layout_seven']); ?> class="coaching-one__title">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'a');
										endif;
										?>
									</<?php echo esc_attr($item['service_title_tag_layout_seven']); ?>>
									<div class="coaching-one__arrow-box">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>" class="coaching-one__arrow">
											<?php \Elementor\Icons_Manager::render_icon($item['url_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
										</a>
									</div>
								</div>
								<div class="coaching-one__hover-content">
									<div class="coaching-one__hover-shape-1"></div>
									<div class="coaching-one__hover-icon">
										<?php treck_elementor_rendered_image($item, 'icon'); ?>
									</div>
									<<?php echo esc_attr($item['service_title_tag_layout_seven']); ?> class="coaching-one__hover-title">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'a');
										endif;
										?>
									</<?php echo esc_attr($item['service_title_tag_layout_seven']); ?>>
									<?php
									if (!empty($item['text'])) :
										treck_basic_rendered_content($this, $item,  'text', 'coaching-one__hover-text', 'p');
									endif;
									?>
									<div class="coaching-one__hover-arrow-box">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>" class="coaching-one__hover-arrow">
											<?php \Elementor\Icons_Manager::render_icon($item['hover_url_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Coaching One Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Coaching five End-->

<?php endif; ?>