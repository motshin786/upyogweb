<?php if ('layout_two' == $settings['layout_type']) : ?>
	<!--About Two Start -->
	<section class="about-two">
		<div class="about-two__shape-2 img-bounce">
			<?php treck_elementor_rendered_image($settings, 'layout_two_shape_one'); ?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="about-two__left">
						<div class="about-two__img-box">
							<div class="about-two__img">
								<?php treck_elementor_rendered_image($settings, 'layout_two_image'); ?>
							</div>
							<div class="about-two__experience">
								<div class="about-two__experience-inner count-box">
									<h3 class="count-text" data-stop="<?php echo esc_attr($settings['layout_two_caption_year']); ?>" data-speed="1500">00</h3>
									<p><?php echo esc_html($settings['layout_two_caption_text']); ?></p>
									<div class="about-two__shape-1">
										<?php treck_elementor_rendered_image($settings, 'layout_two_shape_two'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="about-two__right">
						<div class="section-title text-left">
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
						<?php
						if (!empty($settings['layout_two_summary'])) :
							treck_basic_rendered_content($this, $settings,  'layout_two_summary', 'about-two__text', 'p');
						endif;
						?>
						<ul class="about-two__points list-unstyled ml-0">
							<?php foreach ($settings['layout_two_checklist_list'] as $index => $item) : ?>
								<li>
									<div class="icon icon-svg">
										<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
									<div class="text">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'p');
										endif;
										?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php foreach ($settings['layout_two_progressbar'] as $index => $item) : ?>
							<div class="about-two__progress">
								<h4 class="about-two__progress-title"><?php echo esc_html($item['title']); ?></h4>
								<div class="bar">
									<div class="bar-inner count-bar" data-percent="<?php echo esc_attr($item['count_number']['size']); ?>%">
										<div class="count-text"><?php echo esc_html($item['count_number']['size']); ?>%</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="about-two__btn-and-call-box">
							<div class="about-two__btn-box">
								<?php
								if (!empty($settings['layout_two_button_label'])) :
									treck_basic_rendered_content($this, $settings,  'layout_two_button_label', 'about-two__btn thm-btn', 'a', 'layout_two_button_url', '');
								endif;
								?>
							</div>
							<div class="about-two__call-box">
								<div class="about-two__call-icon">
									<?php \Elementor\Icons_Manager::render_icon($settings['layout_two_call_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
								<div class="about-two__call-content">
									<p><?php echo esc_html($settings['layout_two_call_text']); ?></p>
									<h3><span><?php echo esc_html($settings['layout_two_call_text_two']); ?> </span><a href="<?php echo esc_url($settings['layout_two_call_url']); ?>"><?php echo esc_html($settings['layout_two_call_number']); ?></a></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--About Two Start -->
<?php endif; ?>