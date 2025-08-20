<?php if ('layout_three' === $settings['layout_type']) : ?>

    <!--Testimonial Three Start-->
    <section class="testimonial-three">
        <?php if (!empty($settings['layout_three_shape_one']['url'])) : ?>
            <div class="testimonial-three__map float-bob-y">
                <?php treck_elementor_rendered_image($settings, 'layout_three_shape_one'); ?>
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7">
                    <div class="testimonial-three__left">
                        <?php if (!empty($settings['layout_three_shape_two']['url'])) : ?>
                            <div class="testimonial-three__shape-2 img-bounce">
                                <?php treck_elementor_rendered_image($settings, 'layout_three_shape_two'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="testimonial-three__slider">

                            <div class="testimonial-three__thumb-outer-box">
                                <div class="testimonial-three__thumb-carousel owl-carousel owl-theme">
                                    <?php foreach ($settings['layout_three_testimonials'] as $index => $item) :  ?>
                                        <div class="testimonial-three__thumb-item">
                                            <div class="testimonial-three__img-holder-box">
                                                <div class="testimonial-three__img-holder">
                                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                                </div>
                                                <div class="testimonial-three__quote">
                                                    <?php treck_elementor_rendered_image($item, 'quote_image'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="testimonial-three__main-content">
                                <div class="testimonial-three__carousel owl-carousel owl-theme">
                                    <?php foreach ($settings['layout_three_testimonials'] as $index => $item) :  ?>
                                        <div class="testimonial-three__item">
                                            <div class="testimonial-three__inner-content">
                                                <div class="testimonial-three__rating">
                                                    <?php for ($i = 0; $i < $item['rating']['size']; $i++) : ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <?php
                                                if (!empty($item['testimonial'])) :
                                                    treck_basic_rendered_content($this, $item,  'testimonial', 'testimonial-three__text', 'p');
                                                endif;
                                                ?>
                                                <div class="testimonial-three__client-info">
                                                    <?php
                                                    if (!empty($item['name'])) :
                                                        treck_basic_rendered_content($this, $item,  'name', 'testimonial-three__client-name', 'h4');
                                                    endif;

                                                    if (!empty($item['designation'])) :
                                                        treck_basic_rendered_content($this, $item,  'designation', 'testimonial-three__client-sub-title', 'p');
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="testimonial-three__right">
                        <?php if (!empty($settings['layout_three_features_shape']['url'])) : ?>
                            <div class="testimonial-three__shape-1">
                                <?php treck_elementor_rendered_image($settings, 'layout_three_features_shape'); ?>
                            </div>
                        <?php endif; ?>
                        <ul class="list-unstyled testimonial-three__counter-box ml-0">
                            <?php foreach ($settings['layout_three_features'] as $index => $item) : ?>
                                <li>
                                    <div class="testimonial-three__counter-single">
                                        <div class="testimonial-three__counter-icon icon-svg-large">
                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                        </div>
                                        <div class="testimonial-three__counter-content-box">
                                            <div class="testimonial-three__counter-count-box count-box">
                                                <h3 class="count-text" data-stop="<?php echo esc_attr($item['count_number']); ?>" data-speed="1500">00</h3>
                                                <span class="testimonial-three__counter-plus"><?php echo esc_attr($item['count_sign']); ?></span>
                                            </div>
                                            <p><?php echo esc_html($item['title']); ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonial Three End-->
<?php endif; ?>