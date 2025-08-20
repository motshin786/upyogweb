<?php if ('layout_five' == $settings['layout_type']) : ?>
	<!--Contact Five Start-->
	<section class="contact-five">
		<?php if (!empty($settings['layout_five_shape']['url'])) : ?>
			<div class="contact-five__bg" style="background-image: url(<?php echo esc_url($settings['layout_five_shape']['url']); ?>);"></div>
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
			<div class="contact-five__form-box">
				<?php echo str_replace("<br />", "", trim(do_shortcode('[contact-form-7 id="' . $settings['layout_five_select_wpcf7_form'] . '" ]'))); ?>
			</div>
		</div>
	</section>
	<!--Contact Five End-->
<?php endif; ?>