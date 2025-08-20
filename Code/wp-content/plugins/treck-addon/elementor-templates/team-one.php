<?php if ('layout_one' == $settings['layout_type']) : ?>

	<!--Team One Start-->
	<section class="team-one">
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
				<?php foreach ($settings['team_items'] as $index => $item) : ?>
					<!--Team One Single Start-->
					<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($index + 1); ?>00ms">
						<div class="team-one__single">
							<div class="team-one__img-box">
								<div class="team-one__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
								<div class="team-one__share-btn">
									<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($item['url']['url']); ?>"><i class="fa fa-share-alt"></i></a>
								</div>
								<ul class="list-unstyled team-one__social">
									<?php echo wp_kses($item['social_network'], 'treck_allowed_tags'); ?>
								</ul>
							</div>
							<div class="team-one__content">
								<?php
								if (!empty($item['designation'])) :
									treck_basic_rendered_content($this, $item,  'designation', 'team-one__sub-title', $item['team_designation_tag_layout_one']);
								endif;
								?>
								<<?php echo esc_attr($item['team_name_tag_layout_one']); ?> class="team-one__title">
									<?php
									if (!empty($item['name'])) :
										treck_basic_rendered_content($this, $item,  'name', '', 'a');
									endif;
									?>
								</<?php echo esc_attr($item['team_name_tag_layout_one']); ?>>
								<div class="team-one__arrow-box">
									<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($item['url']['url']); ?>" class="team-one__arrow"><i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!--Team One Single End-->
				<?php endforeach; ?>

			</div>
		</div>
	</section>
	<!--Team One End-->
<?php endif; ?>