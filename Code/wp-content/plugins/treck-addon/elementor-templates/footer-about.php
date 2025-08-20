<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="footer-widget__column footer-widget__about">
        <div class="footer-widget__logo logo-retina">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($settings['logo']['url']); ?>" width="<?php echo esc_attr($settings['logo_dimension']['width']); ?>" height="<?php echo esc_attr($settings['logo_dimension']['height']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            </a>
        </div>
        <?php
        if (!empty($settings['text'])) :
            treck_basic_rendered_content($this, $settings,  'text', 'footer-widget__about-text', 'p');
        endif;
        ?>
        <div class="site-footer__social">
            <?php foreach ($settings['social_icons'] as $social_icon) : ?>
                <a <?php echo esc_attr(!empty($social_icon['social_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
                    <?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>