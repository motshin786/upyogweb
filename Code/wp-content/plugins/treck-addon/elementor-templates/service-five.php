<?php if ('layout_five' === $settings['layout_type']) : ?>
	<!--Coaching Three Start-->
	<section class="coaching-three">
		<?php if (!empty($settings['layout_five_bg_image']['url'])) : ?>
			<div class="coaching-three__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url(<?php echo esc_url($settings['layout_five_bg_image']['url']); ?>);"></div>
		<?php endif; ?>
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_five_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_five_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_five_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_five']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['layout_five_sec_title'])) :
					$this->add_inline_editing_attributes('layout_five_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_five_sec_title', 'section-title__title', $settings['section_title_tag_layout_five']);
				endif;
				?>
			</div>
			<div class="coaching-three__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
				<?php $i = 1;
				foreach ($settings['layout_five_service_items'] as $index => $item) : ?>
					<!--Coaching Three Single Start-->
					<div class="item">
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
									<<?php echo esc_attr($item['service_title_tag_layout_five']); ?> class="coaching-three__title">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'a');
										endif;
										?>
									</<?php echo esc_attr($item['service_title_tag_layout_five']); ?>>
								</div>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'coaching-three__text', 'p');
								endif;
								?>
							</div>
						</div>
					</div>
					<!--Coaching Three Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Coaching Three End-->
<?php endif; ?>