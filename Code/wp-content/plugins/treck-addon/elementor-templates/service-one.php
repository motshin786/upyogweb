<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Services One Start-->
	<section class="services-one">
		<div class="container">
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
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_one_service_items'] as $index => $item) : ?>
					<!--Services One Single Start-->
					<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="services-one__single">
							<div class="services-one__single-inner">
								<div class="services-one__hover-content">
									<div class="services-one__hover-bg" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);">
									</div>
									<div class="services-one__hover-title-box">
										<<?php echo esc_attr($item['service_title_tag_layout_one']); ?> class="services-one__hover-title">
											<?php
											if (!empty($item['title'])) :
												treck_basic_rendered_content($this, $item,  'title', '', 'a');
											endif;
											?>
										</<?php echo esc_attr($item['service_title_tag_layout_one']); ?>>
										<div class="services-one__hover-shpae">
											<?php treck_elementor_rendered_image($item, 'shape'); ?>
										</div>
									</div>
									<div class="services-one__arrow">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>">
											<?php \Elementor\Icons_Manager::render_icon($item['url_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
										</a>
									</div>
								</div>
								<div class="services-one__icon icon-svg-large">
									<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
								<<?php echo esc_attr($item['service_title_tag_layout_one']); ?> class="services-one__title">
									<?php
									if (!empty($item['title'])) :
										treck_basic_rendered_content($this, $item,  'title', '', 'a');
									endif;
									?>
								</<?php echo esc_attr($item['service_title_tag_layout_one']); ?>>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'services-one__text', 'p');
								endif;
								?>
							</div>
						</div>
					</div>
					<!--Services One Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Services One End-->
<?php endif; ?>