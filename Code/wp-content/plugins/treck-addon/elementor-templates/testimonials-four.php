<?php if ('layout_four' === $settings['layout_type']) : ?>

    <!--Success Stories Start-->
    <section class="success-stories">
        <div class="container">
            <div class="row">
                <?php foreach ($settings['layout_four_testimonials'] as $index => $item) :  ?>
                    <!--Testimonial Two Single Start-->
                    <div class="col-xl-6 col-md-6">
                        <div class="testimonial-two__single">
                            <div class="testimonial-two__inner">
                                <div class="testimonial-two__img">
                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                    <div class="testimonial-two__shape-1">
                                        <?php treck_elementor_rendered_image($item, 'shape'); ?>
                                    </div>
                                </div>
                                <div class="testimonial-two__client-details-and-quote">
                                    <div class="testimonial-two__client-details">
                                        <div class="testimonial-two__client-rate">
                                            <?php for ($i = 0; $i < $item['rating']['size']; $i++) : ?>
                                                <span class="fa fa-star"></span>
                                            <?php endfor; ?>
                                        </div>
                                        <h4 class="testimonial-two__client-name">
                                            <?php
                                            if (!empty($item['name'])) :
                                                treck_basic_rendered_content($this, $item,  'name', '', 'a');
                                            endif;
                                            ?>
                                        </h4>
                                        <?php
                                        if (!empty($item['designation'])) :
                                            treck_basic_rendered_content($this, $item,  'designation', 'testimonial-two__client-sub-title', 'p');
                                        endif;
                                        ?>
                                    </div>
                                    <div class="testimonial-two__quote icon-svg">
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ''], 'span'); ?>
                                    </div>
                                </div>
                                <?php
                                if (!empty($item['testimonial'])) :
                                    treck_basic_rendered_content($this, $item,  'testimonial', 'testimonial-two__text', 'p');
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--Testimonial Two Single End-->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--Success Stories End-->
<?php endif; ?>