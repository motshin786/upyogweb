<?php if ('layout_one' == $settings['layout_type']) : ?>
	<div class="coaching-details__benefit">
		<div class="row">
			<div class="col-xl-6">
				<div class="coaching-details__benefit-img">
					<?php treck_elementor_rendered_image($settings, 'image'); ?>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="coaching-details__benefit-content">
					<?php
					if (!empty($settings['title'])) :
						$this->add_inline_editing_attributes('title', 'none');
						treck_elementor_rendered_content($this, 'title', 'coaching-details__benefit-title', $settings['title_tag_layout_one']);
					endif;
					?>
					<?php
					if (!empty($settings['highlighted_text'])) :
						treck_basic_rendered_content($this, $settings,  'highlighted_text', 'coaching-details__benefit-text', 'p');
					endif;
					?>
					<ul class="coaching-details__benefit-points list-unstyled ml-0">
						<?php foreach ($settings['layout_one_checklist_list'] as $index => $item) : ?>
							<li>
								<div class="icon icon-svg">
									<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
								</div>
								<div class="text">
									<?php
									if (!empty($item['title'])) :
										treck_basic_rendered_content($this, $item,  'title', 'default', 'p');
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
<?php endif; ?>