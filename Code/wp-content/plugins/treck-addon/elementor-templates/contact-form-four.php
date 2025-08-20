<?php if ('layout_four' == $settings['layout_type']) : ?>
	<!--Contact Four Start-->
	<section class="contact-four">
		<?php if (!empty($settings['layout_four_shape_one']['url'])) : ?>
			<div class="contact-four__bg-1" style="background-image: url(<?php echo esc_url($settings['layout_four_shape_one']['url']); ?>);"></div>
		<?php endif; ?>
		<?php if (!empty($settings['layout_four_shape_two']['url'])) : ?>
			<div class="contact-four__bg-2" style="background-image: url(<?php echo esc_url($settings['layout_four_shape_two']['url']); ?>);"></div>
		<?php endif; ?>
		<div class="container">
			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['layout_four_sec_sub_title'])) :
						$this->add_inline_editing_attributes('layout_four_sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'layout_four_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_four']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['layout_four_sec_title'])) :
					$this->add_inline_editing_attributes('layout_four_sec_title', 'none');
					treck_elementor_rendered_content($this, 'layout_four_sec_title', 'section-title__title', $settings['section_title_tag_layout_four']);
				endif;
				?>
			</div>
			<div class="contact-four__form-box">
				<?php echo str_replace("<br />", "", trim(do_shortcode('[contact-form-7 id="' . $settings['layout_four_select_wpcf7_form'] . '" ]'))); ?>
			</div>
		</div>
	</section>
	<!--Contact Four End-->
<?php endif; ?>