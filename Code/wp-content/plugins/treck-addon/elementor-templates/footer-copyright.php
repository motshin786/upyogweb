<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <p class="site-footer__bottom-text"> <?php echo wp_kses($settings['title'], 'treck_allowed_tags'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>