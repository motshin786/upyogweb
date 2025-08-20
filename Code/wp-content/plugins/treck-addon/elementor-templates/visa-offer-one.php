<?php if ('layout_one' === $settings['layout_type']) : ?>
	<!--Visa Offers Start-->
	<section class="visa-offers">
		<div class="container">
			<div class="row">
				<?php $i = 1;
				foreach ($settings['layout_one_visa_offer_items'] as $index => $item) : ?>
					<!--Visa Offers Single Start-->
					<div class="col-xl-6 col-lg-6">
						<div class="visa-offers__single visa-offers__single--<?php echo esc_attr($i); ?>">
							<div class="visa-offers__shape-1" style="background-image: url(<?php echo esc_url($item['shape_one']['url']); ?>);"></div>
							<div class="visa-offers__shape-2" style="background-image: url(<?php echo esc_url($item['shape_two']['url']); ?>);">
							</div>
							<div class="visa-offers__img">
								<?php treck_elementor_rendered_image($item, 'image'); ?>
							</div>
							<div class="visa-offers__dot float-bob-x">
								<?php treck_elementor_rendered_image($item, 'shape_three'); ?>
							</div>
							<div class="visa-offers__plane float-bob-y">
								<?php treck_elementor_rendered_image($item, 'shape_four'); ?>
							</div>
							<div class="visa-offers__flag">
								<?php treck_elementor_rendered_image($item, 'flag_image'); ?>
							</div>
							<div class="visa-offers__time">
								<p><?php echo esc_html($item['time']); ?></p>
							</div>
							<div class="visa-offers__sub-title-box">
								<?php
								if (!empty($item['tag_line'])) :
									treck_basic_rendered_content($this, $item,  'tag_line', 'visa-offers__sub-title', $item['tag_line_tag_layout_one']);
								endif;
								?>
							</div>
							<<?php echo esc_attr($item['title_tag_layout_one']); ?> class="visa-offers__title">
								<?php
								if (!empty($item['title'])) :
									treck_basic_rendered_content($this, $item,  'title', '', 'a');
								endif;
								?>
							</<?php echo esc_attr($item['title_tag_layout_one']); ?>>
							<ul class="list-unstyled visa-offers__points ml-0">
								<?php echo wp_kses_post($item['content']); ?>
							</ul>
							<div class="visa-offers__price-box">
								<p class="visa-offers__price-start"><?php echo esc_html($item['price_text']); ?></p>
								<div class="visa-offers__price">
									<p><?php echo esc_html($item['price']); ?></p>
								</div>
							</div>
						</div>
					</div>
					<!--Visa Offers Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Visa Offers End-->
<?php endif; ?>