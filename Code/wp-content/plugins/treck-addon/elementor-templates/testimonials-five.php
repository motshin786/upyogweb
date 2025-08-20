<?php if ('layout_five' === $settings['layout_type']) : ?>
    <!--Testimonial Two Start-->
    <section class="testimonial-two about-page-testimonial">
        <?php if (!empty($settings['layout_five_bg_shape_one']['url'])) : ?>
            <div class="about-page-testimonial__bg-1" style="background-image: url(<?php echo esc_url($settings['layout_five_bg_shape_one']['url']); ?>);"></div>
        <?php endif; ?>
        <?php if (!empty($settings['layout_five_bg_shape_two']['url'])) : ?>
            <div class="about-page-testimonial__bg-2" style="background-image: url(<?php echo esc_url($settings['layout_five_bg_shape_two']['url']); ?>);"></div>
        <?php endif; ?>
        <div class="container">
            <div class="section-title text-center">
                <div class="section-title__tagline-box">
                    <?php
                    if (!empty($settings['layout_five_sec_sub_title'])) :
                        $this->add_inline_editing_attributes('layout_five_sec_sub_title', 'none');
                        treck_elementor_rendered_content($this, 'layout_five_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_five']);
                    endif;
                    ?>
                    <div class="section-title__border-box"></div>
                </div>
                <?php
                if (!empty($settings['layout_five_sec_title'])) :
                    $this->add_inline_editing_attributes('layout_five_sec_title', 'none');
                    treck_elementor_rendered_content($this, 'layout_five_sec_title', 'section-title__title', $settings['section_title_tag_layout_five']);
                endif;
                ?>
            </div>
            <div class="testimonial-two__bottom">
                <div class="testimonial-two__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='<?php echo esc_attr(treck_get_owl_options($settings)); ?>'>
                    <?php foreach ($settings['layout_five_testimonials'] as $index => $item) :  ?>
                        <!--Testimonial Two Single Start-->
                        <div class="item">
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
                                            <?php
                                            if (!empty($item['name'])) :
                                                treck_basic_rendered_content($this, $item,  'name', 'testimonial-two__client-name', 'h4');
                                            endif;
                                            ?>
                                            <?php
                                            if (!empty($item['designation'])) :
                                                treck_basic_rendered_content($this, $item,  'designation', 'testimonial-two__client-sub-title', 'p');
                                            endif;
                                            ?>
                                        </div>
                                        <div class="testimonial-two__quote icon-svg">
                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
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
        </div>
    </section>
    <!--Testimonial Two End-->
<?php endif; ?>