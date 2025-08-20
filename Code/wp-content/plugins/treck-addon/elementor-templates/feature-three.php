<?php if ('layout_three' == $settings['layout_type']) : ?>

    <!--Feature Three Start-->
    <section class="feature-three">
        <div class="feature-three__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url(<?php echo esc_url($settings['layout_three_bg_image']['url']); ?>);"></div>
        <div class="container">
            <div class="row">
                <?php
                $i = 1;
                foreach ($settings['layout_three_feature_list'] as $index => $item) :
                ?>
                    <!--Feature Two Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
                        <div class="feature-two__single">
                            <div class="feature-two__single-inner">
                                <div class="feature-two__shape-1">
                                    <div class="feature-two__shape-2">
                                        <div class="feature-two__icon icon-svg-large">
                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-two__content-box">
                                    <?php
                                    if (!empty($item['subtitle'])) :
                                        treck_basic_rendered_content($this, $item,  'subtitle', 'feature-two__sub-title', 'p');
                                    endif;
                                    ?>
                                    <<?php echo esc_attr($item['feature_title_tag_layout_three']); ?> class="feature-two__title">
                                        <?php
                                        if (!empty($item['title'])) :
                                            treck_basic_rendered_content($this, $item,  'title', '', 'a');
                                        endif;
                                        ?>
                                    </<?php echo esc_attr($item['feature_title_tag_layout_three']); ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Feature Two Single End-->
                <?php $i++;
                endforeach; ?>
            </div>
        </div>
    </section>
    <!--Feature Three End-->
<?php endif; ?>