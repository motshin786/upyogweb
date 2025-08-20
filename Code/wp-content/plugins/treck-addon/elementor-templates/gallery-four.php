<?php if ('layout_four' == $settings['layout_type']) : ?>

    <!--Gallery Four Page Start-->
    <section class="gallery-page">
        <div class="container">
            <div class="row masonary-layout">
                <?php foreach ($settings['gallery_list_four'] as $index => $item) :
                    $image_name = $item['image']['url'];
                    list($width, $height) = getimagesize($image_name);
                ?>
                    <!--Gallery Page Single Start-->
                    <div class="col-xl-<?php if ($width >= '750') : echo esc_attr("6");
                                        else : echo ("3");
                                        endif; ?> col-lg-6 col-md-6">
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
    <!--Gallery Four Page End-->
<?php endif; ?>