<?php if ('layout_six' === $settings['layout_type']) : ?>
	<!--Coaching Four Start-->
	<section class="coaching-four">
		<div class="container">
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_six_service_items'] as $index => $item) : ?>
					<!--Coaching Four Single Start-->
					<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="coaching-three__single">
							<div class="coaching-three__img">
								<?php treck_elementor_rendered_image($item, 'image'); ?>
								<div class="coaching-three__img-content">
									<?php
									if (!empty($item['tag_line'])) :
										treck_basic_rendered_content($this, $item,  'tag_line', '', 'p');
									endif;
									?>
								</div>
								<div class="coaching-three__hover">
									<?php
									if (!empty($item['tag_line'])) :
										treck_basic_rendered_content($this, $item,  'tag_line', '', 'p');
									endif;
									?>
									<div class="coaching-three__arrow">
										<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>">
											<?php \Elementor\Icons_Manager::render_icon($item['read_more_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
										</a>
									</div>
								</div>
							</div>
							<div class="coaching-three__content">
								<div class="coaching-three__title-box">
									<<?php echo esc_attr($item['service_title_tag_layout_six']); ?> class="coaching-three__title">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'a');
										endif;
										?>
									</<?php echo esc_attr($item['service_title_tag_layout_six']); ?>>
								</div>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'coaching-three__text', 'p');
								endif;
								?>
							</div>
						</div>
					</div>
					<!--Coaching Four Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Coaching Four End-->
<?php endif; ?>