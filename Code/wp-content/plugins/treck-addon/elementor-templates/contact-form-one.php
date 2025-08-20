<?php
if ('layout_one' == $settings['layout_type']) :

	if (0 === absint($settings['zoom']['size'])) {
		$settings['zoom']['size'] = 10;
	}

	$api_key = esc_html(get_option('elementor_google_maps_api_key'));

	$params = [
		rawurlencode($settings['address']),
		absint($settings['zoom']['size']),
	];

	if ($api_key) {
		$params[] = $api_key;

		$url = 'https://www.google.com/maps/embed/v1/place?key=%3$s&q=%1$s&amp;zoom=%2$d';
	} else {
		$url = 'https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near';
	}
?>

	<!--Contact One Start-->
	<section class="contact-one">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-6">
					<div class="contact-one__left">
						<?php if (!empty($settings['bg_image']['url'])) : ?>
							<div class="contact-one__bg" style="background-image: url(<?php echo esc_url($settings['bg_image']['url']); ?>);"></div>
						<?php endif; ?>
						<?php if (!empty($settings['bg_shape']['url'])) : ?>
							<div class="contact-one__shape-1" style="background-image: url(<?php echo esc_url($settings['bg_shape']['url']); ?>);"></div>
						<?php endif; ?>
						<div class="section-title text-left">
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
						<div class="contact-one__form-box">
							<?php echo str_replace("<br />", "", trim(do_shortcode('[contact-form-7 id="' . $settings['select_wpcf7_form'] . '" ]'))); ?>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6">
					<div class="contact-one__right">
						<div class="contact-one__google-map-box">
							<iframe src="<?php echo esc_url(vsprintf($url, $params)); ?>" title="<?php echo esc_attr($settings['address']); ?>" class="google-map__one" aria-label="<?php echo esc_attr($settings['address']); ?>" allowfullscreen></iframe>
						</div>
						<div class="contact-one__address-box">
							<div class="contact-one__address-top">
								<div class="contact-one__address-top-title">
									<?php if (!empty($settings['faq_title'])) :
										$this->add_inline_editing_attributes('faq_title', 'none');
										treck_elementor_rendered_content($this, 'faq_title', 'section-title__title', $settings['faq_title_tag_layout_one']);
									endif; ?>
								</div>
								<div class="contact-one__address-top-icon icon-svg-large">
									<?php \Elementor\Icons_Manager::render_icon($settings['faq_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
							</div>
							<div class="contact-one__address-faq">
								<div class="accrodion-grp" data-grp-name="faq-one-accrodion">
									<?php
									foreach ($settings['faq_lists'] as $index => $item) :
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
	</section>
	<!--Contact One End-->

<?php endif; ?>