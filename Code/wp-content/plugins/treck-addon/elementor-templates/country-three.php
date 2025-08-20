<?php if ('layout_three' === $settings['layout_type']) : ?>
	<!--Countries-Three Start-->
	<section class="countries-three">
		<?php if (!empty($settings['layout_three_shape_one']['url'])) : ?>
			<div class="countries-three__shape-1 float-bob-y">
				<?php treck_elementor_rendered_image($settings, 'layout_three_shape_one'); ?>
			</div>
		<?php endif; ?>
		<?php if (!empty($settings['layout_three_shape_two']['url'])) : ?>
			<div class="countries-three__shape-2 float-bob-y">
				<?php treck_elementor_rendered_image($settings, 'layout_three_shape_two'); ?>
			</div>
		<?php endif; ?>
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_three_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_three_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_three_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_three']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>

				<?php
				if (!empty($settings['layout_three_sec_title'])) :
					$this->add_inline_editing_attributes('layout_three_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_three_sec_title', 'section-title__title', $settings['section_title_tag_layout_three']);
				endif;
				?>

			</div>
			<div class="countries-three__top">
				<div class="countries-three__main-tab-box tabs-box">
					<ul class="tab-buttons clearfix list-unstyled ml-0">
						<?php $i = 1;
						foreach ($settings['layout_three_country_items'] as $index => $item) : ?>
							<li data-tab="#tab_number<?php echo esc_attr($i); ?>" class="tab-btn <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-btn' : '')); ?>">
								<div class="img-box">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
							</li>
						<?php $i++;
						endforeach; ?>
					</ul>
					<div class="tabs-content">
						<?php $i = 1;
						foreach ($settings['layout_three_country_items'] as $index => $item) : ?>
							<div class="tab <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-tab' : '')); ?>" id="tab_number<?php echo esc_attr($i); ?>">
								<div class="countries-three__main-content-box">
									<div class="countries-three__title-box">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', 'countries-three__title', $item['country_title_tag_layout_three']);
										endif;
										?>
									</div>
									<p class="countries-three__text"><?php echo wp_kses($item['summary'], 'treck_allowed_tags'); ?></p>
									<div class="countries-three__arrow">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>"><span class="icon-up-right"></span></a>
									</div>
								</div>
							</div>
							<!--tab-->
						<?php $i++;
						endforeach; ?>
					</div>
				</div>
			</div>
			<div class="countries-three__bottom">
				<?php if (!empty($settings['layout_three_bottom_shape']['url'])) : ?>
					<div class="countries-three__bottom-shape">
						<?php treck_elementor_rendered_image($settings, 'layout_three_bottom_shape'); ?>
					</div>
				<?php endif; ?>
				<div class="countries-three__bottom-content">
					<?php
					if (!empty($settings['layout_three_bottom_title'])) :
						treck_basic_rendered_content($this, $settings,  'layout_three_bottom_title', 'countries-three__bottom-text', 'p');
					endif;
					?>
				</div>
				<div class="countries-three__btn-box">
					<?php
					if (!empty($settings['layout_three_button_label'])) :
						treck_basic_rendered_content($this, $settings,  'layout_three_button_label', 'countries-three__btn thm-btn', 'a', 'layout_three_button_url', '');
					endif;
					?>
				</div>
			</div>
		</div>
	</section>
	<!--Countries-Three End-->
<?php endif; ?>