<?php if ('layout_one' == $settings['layout_type']) : ?>
	<div class="container"></div>
	<div class="row">
		<div class="col-xl-12">
			<div class="project-details__pagination-box">
				<ul class="project-details__pagination list-unstyled clearfix">
					<li class="next">
						<div class="icon">
							<a <?php echo esc_attr(!empty($settings['prev_url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($settings['prev_url']['url']); ?>" aria-label="Previous">
								<?php \Elementor\Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
							</a>
						</div>
						<div class="content">
							<?php
							if (!empty($settings['prev_text'])) :
								treck_basic_rendered_content($this, $settings,  'prev_text', '', 'p');
							endif;
							?>
						</div>
					</li>
					<li class="count"><a href="#"></a></li>
					<li class="count"><a href="#"></a></li>
					<li class="count"><a href="#"></a></li>
					<li class="count"><a href="#"></a></li>
					<li class="previous">
						<div class="content">
							<?php
							if (!empty($settings['next_text'])) :
								treck_basic_rendered_content($this, $settings,  'next_text', '', 'p');
							endif;
							?>
						</div>
						<div class="icon">
							<a <?php echo esc_attr(!empty($settings['next_url']['is_external']) ? "target=_blank" : ' '); ?> href="<?php echo esc_url($settings['next_url']['url']); ?>" aria-label="Previous">
								<?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php endif; ?>