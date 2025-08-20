<?php if ('layout_two' == $settings['layout_type']) : ?>

    <!--Feature Two Start-->
    <section class="feature-two">
        <?php if (!empty($settings['layout_two_bg_image'])) : ?>
            <div class="feature-two__shape-3 float-bob-y">
                <?php treck_elementor_rendered_image($settings, 'layout_two_bg_image'); ?>
            </div>
        <?php endif; ?>
        <div class="feature-two__wrap">
            <div class="container">
                <div class="row">
                    <?php
                    $i = 1;
                    foreach ($settings['layout_two_feature_list_two'] as $index => $item) :
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
                                        <<?php echo esc_attr($item['feature_title_tag_layout_two']); ?> class="feature-two__title">
                                            <?php
                                            if (!empty($item['title'])) :
                                                treck_basic_rendered_content($this, $item,  'title', '', 'a');
                                            endif;
                                            ?>
                                        </<?php echo esc_attr($item['feature_title_tag_layout_two']); ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Feature Two Single End-->
                    <?php $i++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!--Feature Two Start -->
<?php endif; ?>