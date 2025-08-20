<?php if ('layout_seven' == $settings['layout_type']) : ?>
    <!--Travel One Start-->
    <section class="travel-one">
        <?php if (!empty($settings['layout_seven_shape_one']['url'])) : ?>
            <div class="travel-one__bg" style="background-image: url(<?php echo esc_url($settings['layout_seven_shape_one']['url']); ?>);"></div>
        <?php endif; ?>
        <?php if (!empty($settings['layout_seven_shape_two']['url'])) : ?>
            <div class="travel-one__bg-two" style="background-image: url(<?php echo esc_url($settings['layout_seven_shape_two']['url']); ?>);"></div>
        <?php endif; ?>
        <div class="container">
            <div class="section-title text-center">
                <div class="section-title__tagline-box">
                    <?php
                    if (!empty($settings['layout_seven_sec_sub_title'])) :
                        $this->add_inline_editing_attributes('layout_seven_sec_sub_title', 'none');
                        treck_elementor_rendered_content($this, 'layout_seven_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_seven']);
                    endif;
                    ?>
                    <div class="section-title__border-box"></div>
                </div>
                <?php
                if (!empty($settings['layout_seven_sec_title'])) :
                    $this->add_inline_editing_attributes('layout_seven_sec_title', 'none');
                    treck_elementor_rendered_content($this, 'layout_seven_sec_title', 'section-title__title', $settings['section_title_tag_layout_seven']);
                endif;
                ?>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="travel-one__left">
                        <div class="travel-one__img">
                            <?php treck_elementor_rendered_image($settings, 'layout_seven_image'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="travel-one__right">
                        <?php
                        if (!empty($settings['layout_seven_summary_one'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_seven_summary_one', 'travel-one__text-1', 'p');
                        endif;

                        if (!empty($settings['layout_seven_summary_two'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_seven_summary_two', 'travel-one__text-2', 'p');
                        endif;
                        ?>
                        <ul class="travel-one__points list-unstyled ml-0">
                            <?php foreach ($settings['layout_seven_check_list'] as $index => $item) : ?>
                                <li>
                                    <div class="icon icon-svg">
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                    </div>
                                    <div class="text">
                                        <p><?php echo esc_html($item['title']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="travel-one__btn-box">
                            <?php
                            if (!empty($settings['layout_seven_button_label'])) :
                                treck_basic_rendered_content($this, $settings,  'layout_seven_button_label', 'travel-one__btn thm-btn', 'a', 'layout_seven_button_url', '');
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Travel One End-->
<?php endif; ?>