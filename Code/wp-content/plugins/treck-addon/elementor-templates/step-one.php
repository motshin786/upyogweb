<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Process One Start-->
	<section class="process-one">
		<?php if (!empty($settings['layout_one_bg_image']['url'])) : ?>
			<div class="process-one__bg" style="background-image: url(<?php echo esc_url($settings['layout_one_bg_image']['url']); ?>);"></div>
		<?php endif; ?>
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
				foreach ($settings['layout_one_step_items'] as $index => $item) : ?>
					<!--Process One Single Start-->
					<div class="col-xl-4 col-lg-4">
						<div class="process-one__single">
							<div class="process-one__icon-box">
								<div class="process-one__shape-1">
									<?php treck_elementor_rendered_image($item, 'shape_one'); ?>
									<div class="process-one__shape-3">
										<?php treck_elementor_rendered_image($item, 'shape_two'); ?>
									</div>
								</div>
								<div class="process-one__shape-2">
									<?php treck_elementor_rendered_image($item, 'shape_three'); ?>
								</div>
								<div class="process-one__icon icon-svg-large">
									<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
							</div>
							<div class="process-one__content">
								<div class="process-one__step">
									<p><?php echo esc_html($item['tag_line']); ?></p>
									<div class="process-one__count"></div>
								</div>
								<<?php echo esc_attr($item['step_title_tag_layout_one']); ?> class="process-one__title">
									<?php
									if (!empty($item['title'])) :
										treck_basic_rendered_content($this, $item,  'title', '', 'a');
									endif;
									?>
								</<?php echo esc_attr($item['step_title_tag_layout_one']); ?>>
								<?php
								if (!empty($item['text'])) :
									treck_basic_rendered_content($this, $item,  'text', 'process-one__text', 'p');
								endif;
								?>
							</div>
						</div>
					</div>
					<!--Process One Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Process One End-->
<?php endif; ?>