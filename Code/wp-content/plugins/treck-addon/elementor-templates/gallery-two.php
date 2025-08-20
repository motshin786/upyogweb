<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!--Gallery Page Start-->
    <section class="gallery-page">
        <div class="container">
            <div class="row masonary-layout">
                <?php
                $i = 1;
                foreach ($settings['gallery_list_two'] as $item) :
                    if ($i == 8) {
                        $col = '6';
                    } else {
                        $col = '3';
                    }
                ?>
                    <!--Gallery Page Single Start-->
                    <div class="col-xl-<?php echo esc_attr($col); ?> col-lg-6 col-md-6">
                        <div class="gallery-page__single">
                            <div class="gallery-page__img">
                                <?php treck_elementor_rendered_image($item, 'image'); ?>
                                <div class="gallery-page__icon">
                                    <a class="img-popup" href="<?php esc_url($item['image']['url']); ?>"><span class="icon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Gallery Page Single End-->
                <?php $i++;
                endforeach; ?>
            </div>
        </div>
    </section>
    <!--Gallery Page End-->
<?php endif; ?>