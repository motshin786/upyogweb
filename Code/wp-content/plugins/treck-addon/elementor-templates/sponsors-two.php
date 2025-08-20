<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!--Brand Two Start-->
    <section class="brand-two">
        <div class="container">
            <?php if (!empty($settings['layout_two_sec_title'])) : ?>
                <h4 class="brand-two__title"><?php echo esc_html($settings['layout_two_sec_title']); ?></h4>
            <?php endif; ?>
            <div class="thm-swiper__slider swiper-container" data-swiper-options='<?php echo esc_attr(treck_get_swiper_options($settings)); ?>'>
                <div class="swiper-wrapper">
                    <?php foreach ($settings['sponsor_images'] as $image) : ?>
                        <div class="swiper-slide">
                            <?php echo wp_get_attachment_image($image['image']['id'], 'treck_brand_logo_112X24'); ?>
                        </div><!-- /.swiper-slide -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!--Brand Two End-->
<?php endif; ?>