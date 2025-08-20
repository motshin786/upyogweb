<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="coaching-details__why-single">
        <div class="coaching-details__why-icon">
            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true', 'class' => ''], 'span'); ?>
            <div class="coaching-details__why-shape-1"></div>
        </div>
        <div class="coaching-details__why-title">
            <h3><?php echo esc_html($settings['title']); ?></h3>
        </div>
        <div class="coaching-details__hover-single">
            <div class="coaching-details__hover-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true', 'class' => ''], 'span'); ?>
            </div>
            <div class="coaching-details__hover-title">
                <h3><?php echo esc_html($settings['title']); ?></h3>
            </div>
        </div>
    </div>
<?php endif; ?>