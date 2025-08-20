<?php if ('layout_three' === $settings['layout_type']) : ?>

	<!--coaching Two Start -->
	<section class="coaching-two">
		<?php if (!empty($settings['layout_three_bg_one']['url'])) : ?>
			<div class="coaching-two__bg" style="background-image: url(<?php echo esc_url($settings['layout_three_bg_one']['url']); ?>);"></div>
		<?php endif; ?>
		<?php if (!empty($settings['layout_three_bg_two']['url'])) : ?>
			<div class="coaching-two__bg-2" style="background-image: url(<?php echo esc_url($settings['layout_three_bg_two']['url']); ?>);"></div>
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
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_three_service_items'] as $index => $item) : ?>
					<!--Coaching Two Single Start-->
					<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="coaching-two__single">
							<div class="coaching-two__arrow-box">
								<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>" class="coaching-two__arrow">
									<?php \Elementor\Icons_Manager::render_icon($item['read_more_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</a>
							</div>
							<div class="coaching-two__img-box">
								<div class="coaching-two__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
							</div>
							<div class="coaching-two__content">
								<<?php echo esc_attr($item['service_title_tag_layout_three']); ?> class="coaching-two__title">
									<?php
									if (!empty($item['title'])) :
										treck_basic_rendered_content($this, $item,  'title', '', 'a');
									endif;
									?>
								</<?php echo esc_attr($item['service_title_tag_layout_three']); ?>>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'coaching-two__text', 'p');
								endif;
								?>
							</div>
						</div>
					</div>
					<!--Coaching Two Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--coaching Two End -->
<?php endif; ?>