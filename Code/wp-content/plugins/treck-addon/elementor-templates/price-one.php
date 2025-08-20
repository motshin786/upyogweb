<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Pricing Page Start-->
	<section class="pricing-page">
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
			<div class="pricing-page__main-tab-box tabs-box">
				<ul class="tab-buttons list-unstyled ml-0">
					<?php
					$i = 1;
					foreach ($settings['filter'] as $item) : ?>
						<li data-tab="#<?php echo esc_attr($item['slug']); ?>" class="tab-btn <?php echo esc_attr(($i == 1) ? 'active-btn' : ''); ?>"><span><?php echo esc_html($item['name']); ?></span></li>
					<?php
						$i++;
					endforeach; ?>
				</ul>
				<div class="tabs-content">
					<?php
					$i = 1;
					foreach ($settings['filter'] as $filter) : ?>
						<!--tab-->
						<div class="tab <?php echo esc_attr(($i == 1) ? 'active-tab' : ''); ?>" id="<?php echo esc_attr($filter['slug']); ?>">
							<div class="pricing-page__inner">
								<div class="row">
									<?php foreach ($settings['layout_one_pricing_items'] as $item) : ?>
										<?php if ($item['slug'] == $filter['slug']) : ?>
											<!--Pricing Page Single Start-->
											<div class="col-xl-4 col-lg-4">
												<div class="pricing-page__single">
													<div class="pricing-page__single-inner">
														<?php if (!empty($item['shape']['url'])) : ?>
															<div class="pricing-page__shape-1">
																<?php treck_elementor_rendered_image($item, 'shape'); ?>
															</div>
														<?php endif; ?>
														<div class="pricing-page__price-box">
															<h3 class="pricing-page__price"><?php echo esc_html($item['price']); ?></h3>
															<p class="pricing-page__price-sub-title"><?php echo esc_html($item['title']); ?></p>
														</div>
														<div class="pricing-page__icon icon-svg-large">
															<?php \Elementor\Icons_Manager::render_icon($item['price_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
														</div>
														<div class="pricing-page__content">
															<h4 class="pricing-page__title"><?php echo esc_html($item['features_title']); ?></h4>
															<ul class="list-unstyled pricing-page__service-list ml-0">
																<?php echo wp_kses_post($item['features']); ?>
															</ul>
															<div class="pricing-page__btn-box">
																<?php
																if (!empty($item['button_label'])) :
																	treck_basic_rendered_content($this, $item,  'button_label', 'thm-btn pricing-page__btn', 'a', 'button_url');
																endif;
																?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--Pricing Page Single End-->
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<!--tab-->
					<?php
						$i++;
					endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<!--Pricing Page End-->
<?php endif; ?>