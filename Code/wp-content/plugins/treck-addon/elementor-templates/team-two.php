<?php if ('layout_two' == $settings['layout_type']) : ?>

	<!--Team Page Start-->
	<section class="team-page">
		<div class="container">
			<div class="row">
				<?php
				$i = 1;
				foreach ($settings['layout_two_team_item'] as $index => $item) : ?>
					<!--Team One Single Start-->
					<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="team-one__single">
							<div class="team-one__img-box">
								<div class="team-one__img">
									<?php treck_elementor_rendered_image($item, 'image'); ?>
								</div>
								<div class="team-one__share-btn">
									<a href="team-details.html"><i class="fa fa-share-alt"></i></a>
								</div>
								<ul class="list-unstyled team-one__social">
									<?php echo wp_kses($item['social_network'], 'treck_allowed_tags'); ?>
								</ul>
							</div>
							<div class="team-one__content">
								<?php
								if (!empty($item['designation'])) :
									treck_basic_rendered_content($this, $item,  'designation', 'team-one__sub-title', 'p');
								endif;
								?>
								<<?php echo esc_attr($item['team_name_tag_layout_two']); ?> class="team-one__title">
									<?php
									if (!empty($item['name'])) :
										treck_basic_rendered_content($this, $item,  'name', '', 'a');
									endif;
									?>
								</<?php echo esc_attr($item['team_name_tag_layout_two']); ?>>
								<div class="team-one__arrow-box">
									<a <?php esc_attr(!empty($item['url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($item['url']['url']); ?>" class="team-one__arrow"><i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!--Team One Single End-->
				<?php $i++;
				endforeach; ?>
			</div>
		</div>
	</section>
	<!--Team Page End-->

<?php endif; ?>