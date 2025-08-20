<?php if ('layout_three' == $settings['layout_type']) : ?>
    <!--Gallery Two Start-->
    <section class="gallery-two ">
        <div class="container-fluid">
            <div class="gallery-one__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
                <?php foreach ($settings['gallery_list_three'] as $index => $item) :  ?>
                    <!--Gallery One Single Start-->
                    <div class="item">
                        <div class="gallery-one__single">
                            <div class="gallery-one__img">
                                <?php treck_elementor_rendered_image($item, 'image'); ?>
                                <div class="gallery-one__icon">
                                    <a href="<?php echo esc_url($item['image']['url']); ?>" class="img-popup"><i class="icon-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Gallery one Single End-->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--Gallery Two End-->
<?php endif; ?>