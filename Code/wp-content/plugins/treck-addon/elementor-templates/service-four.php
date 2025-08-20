<?php if ('layout_four' === $settings['layout_type']) : ?>
	<!--Services Three Start-->
	<section class="services-three">
		<?php if (!empty($settings['layout_four_bg_one']['url'])) : ?>
			<div class="services-three__bg-one" style="background-image: url(<?php echo esc_url($settings['layout_four_bg_one']['url']); ?>);"></div>
		<?php endif; ?>
		<?php if (!empty($settings['layout_four_bg_two']['url'])) : ?>
			<div class="services-three__bg-two" style="background-image: url(<?php echo esc_url($settings['layout_four_bg_two']['url']); ?>);"></div>
		<?php endif; ?>
		<div class="container">
			<div class="services-three__top">
				<div class="row">
					<div class="col-xl-7 col-lg-6">
						<div class="services-three__top-left">
							<div class="section-title text-left">
								<div class="section-title__tagline-box">
									<?php
									if (!empty($settings['layout_four_sec_sub_title'])) :
										$this->add_inline_editing_attributes('layout_four_sec_sub_title', 'none');
										treck_elementor_rendered_content($this, 'layout_four_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_four']);
									endif;
									?>
									<div class="section-title__border-box"></div>
								</div>
								<?php
								if (!empty($settings['layout_four_sec_title'])) :
									$this->add_inline_editing_attributes('layout_four_sec_title', 'none');
									treck_elementor_rendered_content($this, 'layout_four_sec_title', 'section-title__title', $settings['section_title_tag_layout_four']);
								endif;
								?>
							</div>
						</div>
					</div>
					<div class="col-xl-5 col-lg-6">
						<div class="services-three__top-right">
							<?php
							if (!empty($settings['layout_four_summary'])) :
								treck_basic_rendered_content($this, $settings,  'layout_four_summary', 'services-three__top-text', 'p');
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="services-three__bottom">
				<div class="row">
					<?php $i = 1;
					foreach ($settings['layout_four_service_items'] as $index => $item) : ?>
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
									<div class="services-three__icon icon-svg-large">
										<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
								</div>
								<div class="services-three__content">
									<div class="services-three__title-box">
										<<?php echo esc_attr($item['service_title_tag_layout_four']); ?> class="services-three__title">
											<?php
											if (!empty($item['title'])) :
												treck_basic_rendered_content($this, $item,  'title', '', 'a');
											endif;
											?>
										</<?php echo esc_attr($item['service_title_tag_layout_four']); ?>>
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
		</div>
	</section>
	<!--Services Three End-->
<?php endif; ?>