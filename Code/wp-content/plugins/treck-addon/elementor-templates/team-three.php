<?php if ('layout_three' == $settings['layout_type']) : ?>

	<!--Team Details Start-->
	<section class="team-details">
		<div class="team-details__shape-1 img-bounce">
			<?php treck_elementor_rendered_image($settings, 'layout_three_shape'); ?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-6">
					<div class="team-details__left">
						<div class="team-details__img">
							<?php treck_elementor_rendered_image($settings, 'layout_three_image'); ?>
							<div class="team-details__guarantee">
								<div class="team-details__guarantee-inner">
									<div class="team-details__guarantee-icon icon-svg-large">
										<?php \Elementor\Icons_Manager::render_icon($settings['layout_three_image_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
									</div>
									<?php
									if (!empty($settings['layout_three_image_caption'])) :
										treck_basic_rendered_content($this, $settings,  'layout_three_image_caption', 'team-details__guarantee-title', $settings['team_name_tag_layout_three']);
									endif;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6">
					<div class="team-details__right">
						<?php
						if (!empty($settings['layout_three_name'])) :
							treck_basic_rendered_content($this, $settings,  'layout_three_name', 'team-details__name', $settings['team_name_tag_layout_three']);
						endif;
						?>
						<?php
						if (!empty($settings['layout_three_designation'])) :
							treck_basic_rendered_content($this, $settings,  'layout_three_designation', 'team-details__sub-title', 'p');
						endif;
						?>
						<div class="team-details__social">
							<?php foreach ($settings['layout_three_social_icons'] as $social_icon) : ?>
								<a <?php echo esc_attr(!empty($social_icon['social_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
									<?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
								</a>
							<?php endforeach; ?>
						</div>
						<?php
						if (!empty($settings['layout_three_summary'])) :
							treck_basic_rendered_content($this, $settings,  'layout_three_summary', 'team-details__text-1', 'p');
						endif;
						?>
						<div class="team-details__points-box">
							<?php
							if (!empty($settings['layout_three_highlighted_text'])) :
								treck_basic_rendered_content($this, $settings,  'layout_three_highlighted_text', 'team-details__points-title', 'h3');
							endif;
							?>
							<ul class="list-unstyled team-details__points ml-0">
								<?php foreach ($settings['layout_three_checklist_list'] as $index => $item) : ?>
									<li>
										<div class="icon icon-svg">
											<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Team Details End-->

<?php endif; ?>