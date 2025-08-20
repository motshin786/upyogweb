<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="site-footer__top">
        <div class="site-footer__map float-bob-x">
            <?php treck_elementor_rendered_image($settings, 'bg_shape'); ?>
        </div>
        <div class="site-footer__top-left">
            <div class="site-footer__visa-box">
                <ul class="list-unstyled site-footer__visa-list ml-0">
                    <?php foreach ($settings['images'] as $item) : ?>
                        <li>
                            <div class="site-footer__visa-img">
                                <?php treck_elementor_rendered_image($item, 'image'); ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (!empty($settings['content'])) : ?>
                    <div class="site-footer__visa-content">
                        <p class="site-footer__visa-text"><?php echo wp_kses($settings['content'], 'treck_allowed_tags'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="site-footer__call">
            <div class="site-footer__call-icon">
                <?php treck_elementor_rendered_image($settings, 'call_icon_image'); ?>
            </div>
            <div class="site-footer__call-content">
                <?php if (!empty($settings['call_text'])) : ?>
                    <p class="site-footer__call-sub-title"><?php echo esc_html($settings['call_text']); ?></p>
                <?php endif; ?>

                <h5 class="site-footer__call-number">
                    <a href="<?php echo esc_url($settings['call_url']); ?>"><?php echo wp_kses($settings['call_number'], 'treck_allowed_tags'); ?></a>
                </h5>

            </div>
        </div>
    </div>
<?php endif; ?>