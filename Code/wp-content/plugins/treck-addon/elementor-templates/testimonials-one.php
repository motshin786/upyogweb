<?php if ('layout_one' === $settings['layout_type']) : ?>

    <!--Testimonial One Start-->
    <section class="testimonial-one">
        <div class="container">
            <div class="testimonial-one__wrap">
                <div class="testimonial-one__bg" style="background-image: url(<?php echo esc_url($settings['bg_image']['url']); ?>);"></div>
                <div class="testimonial-one__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
                    <?php foreach ($settings['testimonials'] as $index => $item) :  ?>
                        <!--Testimonial one Single Start-->
                        <div class="item">
                            <div class="testimonial-one__single">
                                <div class="testimonial-one__img-1">
                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                    <div class="testimonial-one__shape-1">
                                        <?php treck_elementor_rendered_image($item, 'shape_one'); ?>
                                    </div>
                                </div>
                                <div class="testimonial-one__inner">
                                    <div class="testimonial-one__icon-and-ratting">
                                        <div class="testimonial-one__icon">
                                            <?php treck_elementor_rendered_image($item, 'shape_two'); ?>
                                        </div>
                                        <div class="testimonial-one__ratting">
                                            <?php for ($i = 0; $i < $item['rating']['size']; $i++) : ?>
                                                <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <?php
                                    if (!empty($item['testimonial'])) :
                                        treck_basic_rendered_content($this, $item,  'testimonial', 'testimonial-one__text', 'p');
                                    endif;
                                    ?>
                                    <div class="testimonial-one__client-name-box">
                                        <?php
                                        if (!empty($item['name'])) :
                                            treck_basic_rendered_content($this, $item,  'name', 'testimonial-one__client-name', 'h4');
                                        endif;

                                        if (!empty($item['designation'])) :
                                            treck_basic_rendered_content($this, $item,  'designation', 'testimonial-one__client-sub-title', 'p');
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Testimonial one Single End-->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonial One End-->
<?php endif; ?>