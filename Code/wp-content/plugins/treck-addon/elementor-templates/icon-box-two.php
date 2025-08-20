<?php if ('layout_two' == $settings['layout_type']) : ?>
    <ul class="visa-details__visa-process-list list-unstyled ml-0">
        <?php foreach ($settings['layout_two_info_box'] as $item) : ?>
            <li>
                <div class="icon-box">
                    <div class="icon icon-svg">
                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                    </div>
                </div>
                <div class="title">
                    <p><?php echo wp_kses($item['title'], 'treck_allowed_tags'); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>