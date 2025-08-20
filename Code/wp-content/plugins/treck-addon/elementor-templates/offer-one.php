<?php if ('layout_one' == $settings['layout_type']) : ?>
	<!--Banners Start-->
	<section class="banners">
		<div class="container">
			<div class="row">
				<?php
				$i = 1;
				foreach ($settings['offers'] as $key => $item) :
					$main_class = $key % 2 == 0 ? 'banners__left slideInLeft' : 'banners__right slideInRight';
					$sub_title_class = $key % 2 == 0 ? 'banners__left-sub-title' : 'banners__right-sub-title';
					$btn_class = $key % 2 == 0 ? 'thm-btn banners__left-btn' : 'thm-btn banners__right-btn';
				?>
					<div class="col-xl-6 col-lg-6">
						<div class="wow <?php echo esc_attr($main_class); ?>" data-wow-delay="100ms" data-wow-duration="2500ms">
							<div class="banners__left-img">
								<?php treck_elementor_rendered_image($item, 'image'); ?>
							</div>
							<div class="banners__left-shape-one" style="background-image: url(<?php echo esc_url($item['shape']['url']); ?>);"></div>
							<div class="banners__content">
								<?php
								if (!empty($item['title'])) :
									treck_basic_rendered_content($this, $item,  'title', 'banners__left-title', $item['title_tag_layout_one']);
								endif;

								if (!empty($item['sub_title'])) :
									treck_basic_rendered_content($this, $item,  'sub_title', $sub_title_class, 'p');
								endif;

								if (!empty($item['button_label'])) :
									treck_basic_rendered_content($this, $item,  'button_label', $btn_class, 'a', 'button_url');
								endif;
								?>
							</div>
						</div>
					</div>
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Banners End-->
<?php endif; ?>