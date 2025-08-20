<?php if ('layout_one' == $settings['layout_type']) : ?>

	<!--Faq Search Box Start-->
	<section class="faq-search-box">
		<div class="container">
			<div class="faq-search-box__inner">
				<div class="faq-search-box__shape float-bob-x">
					<?php treck_elementor_rendered_image($settings, 'shape'); ?>
				</div>
				<div class="faq-search-box__left">
					<?php
					if (!empty($settings['title'])) :
						$this->add_inline_editing_attributes('title', 'none');
						treck_elementor_rendered_content($this, 'title', 'faq-search-box__title', $settings['title_tag_layout_one']);
					endif;

					if (!empty($settings['summary'])) :
						$this->add_inline_editing_attributes('summary', 'none');
						treck_elementor_rendered_content($this, 'summary', 'faq-search-box__text', 'p');
					endif;
					?>
					<form class="faq-search-box__form" action="<?php echo esc_url(home_url()); ?>">
						<div class="faq-search-box__form-input">
							<input type="search" name="s" placeholder="<?php echo esc_attr($settings['search_placeholder']); ?>">
							<button type="submit"><i class="icon-magnifying-glass"></i></button>
						</div>
						<div class="faq-search-box__form-btn-and-text">
							<?php
							if (!empty($settings['button_label'])) :
								treck_basic_rendered_content($this, $settings,  'button_label', 'thm-btn faq-search-box__form-btn', 'a', 'button_url');
							endif;
							?>
							<?php
							if (!empty($settings['button_info_text'])) :
								$this->add_inline_editing_attributes('button_info_text', 'none');
								treck_elementor_rendered_content($this, 'button_info_text', 'faq-search-box__form-text', 'p');
							endif;
							?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--Faq Search Box End-->

<?php endif; ?>