<?php if ('layout_two' == $settings['layout_type']) : ?>
    <div class="banner-one">
        <div class="banner-one__shape-1">
            <?php treck_elementor_rendered_image($settings, 'layout_two_shape'); ?>
        </div>
        <div class="banner-one__bg" style="background-image: url(<?php echo esc_url($settings['layout_two_bg_image']['url']); ?>);"></div>
        <div class="banner-one__img">
            <?php treck_elementor_rendered_image($settings, 'layout_two_image'); ?>
        </div>
        <?php
        if (!empty($settings['layout_two_title'])) :
            $this->add_inline_editing_attributes('layout_two_title', 'none');
            treck_elementor_rendered_content($this, 'layout_two_title', 'banner-one__title', $settings['title_tag_layout_two']);
        endif; ?>
        <div class="banner-one__btn-box">
            <?php
            if (!empty($settings['layout_two_button_label'])) :
                treck_basic_rendered_content($this, $settings,  'layout_two_button_label', 'banner-one__btn', 'a', 'layout_two_button_url', '');
            endif;
            ?>
        </div>
    </div>
<?php endif; ?>