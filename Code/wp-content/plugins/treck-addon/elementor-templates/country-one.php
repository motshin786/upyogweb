<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Countries One Start-->
	<section class="countries-one">
		<div class="countries-one__bg" style="background-image: url(<?php echo esc_url($settings['bg_image']['url']); ?>);"></div>
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
				foreach ($settings['layout_country_items'] as $index => $item) : ?>
					<!--Countries One Single Start-->
					<div class="col-xl-2 col-lg-4 col-md-6">
						<div class="countries-one__single">
							<div class="countries-one__img-box">
								<div class="countries-one__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
							</div>
							<<?php echo esc_attr($item['country_title_tag_layout_one']); ?> class="countries-one__title">
								<?php
								if (!empty($item['title'])) :
									treck_basic_rendered_content($this, $item,  'title', '', 'a');
								endif;
								?>
							</<?php echo esc_attr($item['country_title_tag_layout_one']); ?>>
							<?php
							if (!empty($item['text'])) :
								treck_basic_rendered_content($this, $item,  'text', 'countries-one__text', 'p');
							endif;
							?>
							<div class="countries-one__arrow-box">
								<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' ') ?> href="<?php echo esc_url($item['url']['url']); ?>" class="countries-one__arrow">
									<?php \Elementor\Icons_Manager::render_icon($item['url_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</a>
							</div>
						</div>
					</div>
					<!--Countries One Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Countries One End-->
<?php endif; ?>