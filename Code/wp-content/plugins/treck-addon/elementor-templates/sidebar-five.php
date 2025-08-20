<?php if ('layout_five' == $settings['layout_type']) : ?>
    <div class="faq-page__content">
        <?php
        if (!empty($settings['layout_five_title'])) :
            $this->add_inline_editing_attributes('layout_five_title', 'none');
            treck_elementor_rendered_content($this, 'layout_five_title', 'faq-page__content-title', $settings['title_tag_layout_five']);
        endif; ?>
        <div class="faq-page__call">
            <div class="faq-page__call-icon icon-svg-large">
                <?php \Elementor\Icons_Manager::render_icon($settings['layout_five_call_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
            </div>
            <div class="faq-page__call-content">
                <p class="faq-page__call-sub-title"><?php echo esc_html($settings['layout_five_call_title']); ?></p>
                <h4 class="faq-page__call-number"> <span><?php echo esc_html($settings['layout_five_call_text']); ?></span>
                    <a href="<?php echo esc_url($settings['layout_five_call_url']); ?>"><?php echo esc_html($settings['layout_five_call_number']); ?></a>
                </h4>
            </div>
        </div>
    </div>
<?php endif; ?>