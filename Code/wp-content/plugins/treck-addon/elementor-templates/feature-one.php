<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!--feature One Start-->
    <section class="feature-one">
        <div class="container">
            <div class="row">
                <?php
                $i = 1;
                foreach ($settings['feature_list_one'] as $index => $item) :
                    $class = '';
                    if (2 == $i) {
                        $class = 'feature-one__img-two';
                    } elseif (3 == $i) {
                        $class = 'feature-one__img-three';
                    }
                ?>
                    <!--feature One Single Start-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="feature-one__single">
                            <div class="feature-one__inner">
                                <div class="feature-one__shape-1">
                                    <?php treck_elementor_rendered_image($item, 'shape'); ?>
                                </div>
                                <div class="feature-one__img-one <?php echo esc_attr($class); ?>">
                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                </div>
                                <?php
                                if (!empty($item['subtitle'])) :
                                    treck_basic_rendered_content($this, $item,  'subtitle', 'feature-one__sub-title', 'p');
                                endif;
                                ?>
                                <<?php echo esc_attr($item['feature_title_tag_layout_one']); ?> class="feature-one__title">
                                    <?php
                                    if (!empty($item['title'])) :
                                        treck_basic_rendered_content($this, $item,  'title', '', 'a');
                                    endif;
                                    ?>
                                </<?php echo esc_attr($item['feature_title_tag_layout_one']); ?>>
                                <div class="feature-one__btn-box">
                                    <?php
                                    if (!empty($item['btn_label'])) :
                                        treck_basic_rendered_content($this, $item,  'btn_label', 'feature-one__btn', 'a');
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--feature One Single End-->
                <?php $i++;
                endforeach; ?>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="feature-one__bottom">
                        <?php
                        if (!empty($settings['bottom_text'])) :
                            treck_basic_rendered_content($this, $settings,  'bottom_text', 'feature-one__text', 'p');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--feature One End-->
<?php endif; ?>