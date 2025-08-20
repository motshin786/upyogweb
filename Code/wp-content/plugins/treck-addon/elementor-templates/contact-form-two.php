<?php if ('layout_two' == $settings['layout_type']) : ?>
	<!--Contact Two Start-->
	<section class="contact-two">
		<?php if (!empty($settings['layout_two_bg_image']['url'])) : ?>
			<div class="contact-two__bg" style="background-image: url(<?php echo esc_url($settings['layout_two_bg_image']['url']); ?>);">
			</div>
		<?php endif; ?>
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_two_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_two_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_two_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_two']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['layout_two_sec_title'])) :
					$this->add_inline_editing_attributes('layout_two_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_two_sec_title', 'section-title__title', $settings['section_title_tag_layout_two']);
				endif;
				?>
			</div>
			<div class="contact-two__inner">
				<div class="row">
					<div class="col-xl-8 col-lg-7">
						<div class="contact-two__left">
							<div class="contact-two__form-box">
								<?php echo str_replace("<br />", "", trim(do_shortcode('[contact-form-7 id="' . $settings['layout_two_select_wpcf7_form'] . '" ]'))); ?>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="contact-two__right">
							<div class="contact-two__address-box">
								<div class="contact-two__address-top">
									<div class="contact-two__address-top-title">
										<?php if (!empty($settings['layout_two_faq_title'])) :
											$this->add_inline_editing_attributes('layout_two_faq_title', 'none');
											treck_elementor_rendered_content($this, 'layout_two_faq_title', 'contact-two__address-top-title', $settings['faq_title_tag_layout_two']);
										endif; ?>
									</div>
									<div class="contact-two__address-top-icon icon-svg-large">
										<?php \Elementor\Icons_Manager::render_icon($settings['layout_two_faq_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
								</div>
								<div class="contact-two__address-faq">
									<div class="accrodion-grp" data-grp-name="faq-one-accrodion">
										<?php
										foreach ($settings['layout_two_faq_lists'] as $index => $item) :
										?>
											<div class="accrodion <?php echo esc_attr(('yes' == $item['active_status'] ? 'active' : '')); ?>">
												<div class="accrodion-title">
													<h4><?php echo esc_html($item['question']); ?></h4>
												</div>
												<div class="accrodion-content">
													<div class="inner">
														<?php echo wp_kses_post($item['content']); ?>
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
			</div>
		</div>
	</section>
	<!--Contact Two End-->
<?php endif; ?>