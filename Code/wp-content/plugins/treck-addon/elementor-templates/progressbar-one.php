<?php if ('layout_one' == $settings['layout_type']) : ?>
	<div class="team-details-experience-right">
		<div class="team-details__progress">
			<?php foreach ($settings['progress_bar_items'] as $index => $item) : ?>
				<div class="team-details__progress-single">
					<h4 class="team-details__progress-title"><?php echo esc_html($item['title']); ?></h4>
					<div class="bar">
						<div class="bar-inner count-bar" data-percent="<?php echo esc_attr($item['post_count']['size']); ?>%">
							<div class="count-text"><?php echo esc_html($item['post_count']['size']); ?>%</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>