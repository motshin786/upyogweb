<?php if ('layout_five' == $settings['layout_type']) : ?>
    <!--Gallery Page Start-->
    <section class="gallery-carousel-page">
        <div class="container">
            <div class="gallery-carousel thm-owl__carousel owl-theme owl-carousel carousel-dot-style" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>

                <?php foreach ($settings['gallery_list_five'] as $index => $item) :  ?>
                    <!--Gallery Page Single Start-->
                    <div class="item">
                        <div class="gallery-page__single">
                            <div class="gallery-page__img">
                                <?php treck_elementor_rendered_image($item, 'image'); ?>
                                <div class="gallery-page__icon">
                                    <a class="img-popup" href="<?php echo esc_url($item['image']['url']); ?>"><span class="fa fa-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Gallery Page Single End-->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--Gallery Page End-->
<?php endif; ?>