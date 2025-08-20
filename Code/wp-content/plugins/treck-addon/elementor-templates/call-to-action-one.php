<?php if ('layout_one' == $settings['layout_type']) : ?>

	<!--Excellence One Start -->
	<section class="excellence-one">
		<div class="container">
			<div class="excellence-one__inner">
				<div class="excellence-one__bg" style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>);"></div>
				<div class="excellence-one__shape-1 img-bounce">
					<?php treck_elementor_rendered_image($settings, 'shape_one'); ?>
				</div>
				<div class="excellence-one__shape-2 float-bob-x">
					<?php treck_elementor_rendered_image($settings, 'shape_two'); ?>
				</div>
				<?php
				if (!empty($settings['title'])) :
					$this->add_inline_editing_attributes('title', 'none');
					treck_elementor_rendered_content($this, 'title', 'excellence-one__title', $settings['title_tag_layout_one']);
				endif;
				?>
				<div class="excellence-one__btn-box">
					<?php
					if (!empty($settings['button_label'])) :
						treck_basic_rendered_content($this, $settings,  'button_label', 'excellence-one__btn thm-btn', 'a', 'button_url', '');
					endif;
					?>
				</div>
			</div>
		</div>
	</section>
	<!--Excellence One End -->

<?php endif; ?>