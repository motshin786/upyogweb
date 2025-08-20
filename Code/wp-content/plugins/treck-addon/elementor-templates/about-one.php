<?php if ('layout_one' == $settings['layout_type']) : ?>
	<!--About One Start-->
	<section class="about-one">
		<div class="about-one__shape-3 float-bob-y">
			<?php treck_elementor_rendered_image($settings, 'shape_one'); ?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="about-one__left">
						<div class="about-one__shape-2 img-bounce">
							<?php treck_elementor_rendered_image($settings, 'shape_two'); ?>
						</div>
						<div class="about-one__img-box">
							<div class="about-one__img">
								<?php treck_elementor_rendered_image($settings, 'image_one'); ?>
								<div class="about-one__shape-1 float-bob-y">
									<?php treck_elementor_rendered_image($settings, 'shape_three'); ?>
								</div>
							</div>
							<div class="about-one__img-2">
								<?php treck_elementor_rendered_image($settings, 'image_two'); ?>
							</div>
							<div class="about-one__experience count-box">
								<h3 class="count-text" data-stop="<?php echo esc_attr($settings['image_year']); ?>" data-speed="1500">00</h3>
								<p><?php echo esc_html($settings['image_caption_text']); ?></p>
							</div>
							<div class="about-one__badge">
								<?php treck_elementor_rendered_image($settings, 'badge_image'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="about-one__right">
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
						<?php
						if (!empty($settings['summary'])) :
							treck_basic_rendered_content($this, $settings,  'summary', 'about-one__text', 'p');
						endif;
						?>
						<ul class="about-one__points list-unstyled ml-0">
							<?php foreach ($settings['features'] as $index => $item) : ?>
								<li>
									<div class="icon icon-svg">
										<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
									<div class="content">
										<?php
										if (!empty($item['title'])) :
											treck_basic_rendered_content($this, $item,  'title', '', 'h3');
										endif;
										?>
										<?php
										if (!empty($item['content'])) :
											treck_basic_rendered_content($this, $item,  'content', '', 'p');
										endif;
										?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
						<div class="about-one__btn-box">
							<?php
							if (!empty($settings['button_label'])) :
								treck_basic_rendered_content($this, $settings,  'button_label', 'about-one__btn thm-btn', 'a', 'button_url', '');
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--About One End-->

<?php endif; ?>