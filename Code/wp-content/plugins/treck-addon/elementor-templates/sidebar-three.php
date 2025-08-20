<?php if ('layout_three' == $settings['layout_type']) : ?>
    <div class="countries-details__documents">
        <div class="icon icon-svg">
            <?php \Elementor\Icons_Manager::render_icon($settings['layout_three_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
        </div>
        <div class="content">
            <<?php echo esc_attr($settings['title_tag_layout_three']); ?>>
                <a href="<?php echo esc_url($settings['layout_three_file_url']); ?>">
                    <?php echo esc_html($settings['layout_three_title']); ?>
                </a>
            </<?php echo esc_attr($settings['title_tag_layout_three']); ?>>
            <p><?php echo esc_html($settings['layout_three_file_size']); ?></p>
        </div>
    </div>
<?php endif; ?>