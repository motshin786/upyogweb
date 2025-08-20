<?php if ('layout_three' == $settings['layout_type']) : ?>
    <!--Brand One Start-->
    <section class="brand-one countries-page-brand">
        <div class="container">
            <div class="brand-one__inner">
                <div class="thm-swiper__slider swiper-container" data-swiper-options='<?php echo esc_attr(treck_get_swiper_options($settings)); ?>'>
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['sponsor_images'] as $image) : ?>
                            <div class="swiper-slide">
                                <?php treck_elementor_rendered_image($image, 'image') ?>
                            </div><!-- /.swiper-slide -->
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Brand One End-->
<?php endif; ?>