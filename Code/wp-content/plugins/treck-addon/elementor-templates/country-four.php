<?php if ('layout_four' === $settings['layout_type']) : ?>
	<!--Countries-Four Start-->
	<section class="countries-four">
		<div class="container">
			<div class="countries-three__top">
				<div class="countries-three__main-tab-box tabs-box">
					<ul class="tab-buttons clearfix list-unstyled ml-0">
						<?php $i = 1;
						foreach ($settings['layout_four_country_items'] as $index => $item) : ?>
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
						foreach ($settings['layout_four_country_items'] as $index => $item) : ?>
							<div class="tab <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-tab' : '')); ?>" id="tab_number<?php echo esc_attr($i); ?>">
								<div class="countries-three__main-content-box">
									<div class="countries-three__title-box">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', 'countries-three__title', $item['country_title_tag_layout_four']);
										endif;
										?>
									</div>
									<p class="countries-three__text"><?php echo wp_kses($item['summary'], 'treck_allowed_tags'); ?></p>
									<div class="countries-three__arrow">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($item['url']['url']); ?>"><span class="icon-up-right"></span></a>
									</div>
								</div>
							</div>
						<?php $i++;
						endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Countries-Four End-->
<?php endif; ?>