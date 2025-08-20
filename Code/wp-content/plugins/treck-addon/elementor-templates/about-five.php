<?php if ('layout_five' == $settings['layout_type']) : ?>

	<!--About Four Start-->
	<section class="about-four">
		<div class="about-four__shape-2 img-bounce">
			<?php treck_elementor_rendered_image($settings, 'layout_five_shape_one'); ?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="about-four__left">
						<div class="section-title text-left">
							<div class="section-title__tagline-box">
								<?php
								if (!empty($settings['layout_five_sec_sub_title'])) :
									$this->add_inline_editing_attributes('layout_five_sec_sub_title', 'none');
									treck_elementor_rendered_content($this, 'layout_five_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_five']);
								endif; ?>
								<div class="section-title__border-box"></div>
							</div>
							<?php
							if (!empty($settings['layout_five_sec_title'])) :
								$this->add_inline_editing_attributes('layout_five_sec_title', 'none');
								treck_elementor_rendered_content($this, 'layout_five_sec_title', 'section-title__title', $settings['section_title_tag_layout_five']);
							endif;
							?>
						</div>
						<div class="about-four__top">
							<div class="about-four__icon icon-svg-large">
								<?php \Elementor\Icons_Manager::render_icon($settings['layout_five_highlighted_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
							</div>
							<div class="about-four__content">
								<?php
								if (!empty($settings['layout_five_highlighted_text'])) :
									treck_basic_rendered_content($this, $settings,  'layout_five_highlighted_text', '', 'h4');
								endif;
								?>
							</div>
						</div>
						<?php
						if (!empty($settings['layout_five_summary'])) :
							treck_basic_rendered_content($this, $settings,  'layout_five_summary', 'about-four__text-1', 'p');
						endif;
						?>
						<?php if (is_array($settings['layout_five_check_list']) && !empty($settings['layout_five_check_list'])) : ?>
							<div class="about-four__points-box">
								<ul class="list-unstyled about-four__points ml-0">
									<li>
										<div class="icon icon-svg">
											<span class="<?php echo esc_attr($settings['layout_five_check_list'][0]['icon']['value']); ?>"></span>
										</div>
										<div class="text">
											<p><?php echo esc_html($settings['layout_five_check_list']['0']['title']);
												?></p>
										</div>
									</li>
								</ul>
								<ul class="list-unstyled about-four__points about-four__points--two ml-0">
									<li>
										<div class="icon icon-svg">
											<span class="<?php echo esc_attr($settings['layout_five_check_list'][1]['icon']['value']); ?>"></span>
										</div>
										<div class="text">
											<p><?php echo esc_html($settings['layout_five_check_list']['1']['title']); ?></p>
										</div>
									</li>
								</ul>
							</div>
						<?php endif; ?>
						<div class="about-four__btn-box">
							<?php
							if (!empty($settings['layout_five_button_label'])) :
								treck_basic_rendered_content($this, $settings,  'layout_five_button_label', 'thm-btn about-four__btn', 'a', 'layout_five_button_url', '');
							endif;
							?>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="about-four__right">
						<div class="about-four__img-box">
							<?php if (!empty($settings['layout_five_image_one']['url'])) : ?>
								<div class="about-four__img-one">
									<?php treck_elementor_rendered_image($settings, 'layout_five_image_one'); ?>
								</div>
							<?php endif; ?>
							<?php if (!empty($settings['layout_five_image_two']['url'])) : ?>
								<div class="about-four__img-two">
									<?php treck_elementor_rendered_image($settings, 'layout_five_image_two'); ?>
								</div>
							<?php endif; ?>
							<div class="about-four__experience">
								<div class="about-four__experience-inner count-box">
									<h3 class="count-text" data-stop="<?php echo esc_attr($settings['layout_five_image_count_text']); ?>" data-speed="1500">00</h3>
									<p><?php echo esc_html($settings['layout_five_image_text']); ?></p>
									<div class="about-four__shape-1">
										<?php treck_elementor_rendered_image($settings, 'layout_five_shape_two'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--About Four End-->
<?php endif; ?>