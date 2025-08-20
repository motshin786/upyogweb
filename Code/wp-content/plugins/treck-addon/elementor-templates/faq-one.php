<?php if ('layout_one' == $settings['layout_type']) : ?>
	<!--FAQ One Start -->
	<section class="faq-one">
		<?php if (!empty($settings['right_bg_shape']['url'])) : ?>
			<div class="faq-one__shape-1 float-bob-y">
				<?php treck_elementor_rendered_image($settings, 'right_bg_shape'); ?>
			</div>
		<?php endif; ?>
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="faq-one__left">
						<div class="faq-one__bg" style="background-image: url(<?php echo esc_url($settings['left_bg_image']['url']); ?>);"></div>
						<div class="faq-one__inner">
							<div class="faq-one__icon icon-svg-large">
								<?php \Elementor\Icons_Manager::render_icon($settings['left_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
							</div>
							<?php
							if (!empty($settings['left_sec_title'])) :
								$this->add_inline_editing_attributes('left_sec_title', 'none');
								treck_elementor_rendered_content($this, 'left_sec_title', 'faq-one__title', $settings['title_tag_layout_one']);
							endif;
							?>
							<div class="faq-one__btn-box">
								<?php
								if (!empty($settings['button_label'])) :
									treck_basic_rendered_content($this, $settings,  'button_label', 'faq-one__btn thm-btn', 'a', 'button_url', '');
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="faq-one__right">
						<div class="section-title text-left">
							<div class="section-title__tagline-box">
								<?php
								if (!empty($settings['right_sec_sub_title'])) :
									$this->add_inline_editing_attributes('right_sec_sub_title', 'none');
									treck_elementor_rendered_content($this, 'right_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_one']);
								endif;
								?>
								<div class="section-title__border-box"></div>
							</div>
							<?php
							if (!empty($settings['right_sec_title'])) :
								$this->add_inline_editing_attributes('right_sec_title', 'none');
								treck_elementor_rendered_content($this, 'right_sec_title', 'section-title__title', $settings['section_title_tag_layout_one']);
							endif;
							?>
						</div>
						<div class="faq-one__faq-box">
							<div class="accrodion-grp" data-grp-name="faq-one-accrodion">
								<?php
								foreach ($settings['faq_lists'] as $index => $item) :
								?>
									<div class="accrodion <?php echo esc_attr(('yes' == $item['active_status'] ? 'active' : '')); ?>">
										<div class="accrodion-title">
											<<?php echo esc_attr($item['faq_one_question_tag_layout_one']); ?>>
												<?php echo esc_html($item['question']); ?>
											</<?php echo esc_attr($item['faq_one_question_tag_layout_one']); ?>>
										</div>
										<div class="accrodion-content">
											<div class="inner">
												<?php
												if (!empty($item['answer'])) :
													treck_basic_rendered_content($this, $item,  'answer', '', 'p');
												endif;
												?>
											</div><!-- /.inner -->
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--FAQ One End-->

<?php endif; ?>