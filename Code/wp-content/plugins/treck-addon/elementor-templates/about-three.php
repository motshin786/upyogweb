<?php if ('layout_three' == $settings['layout_type']) : ?>
    <!--About Three Start-->
    <section class="about-three">
        <div class="about-thre__shape-1 img-bounce">
            <?php treck_elementor_rendered_image($settings, 'layout_three_shape'); ?>
        </div>
        <div class="container">
            <div class="section-title text-center">
                <div class="section-title__tagline-box">
                    <?php
                    if (!empty($settings['layout_three_sec_sub_title'])) :
                        $this->add_inline_editing_attributes('layout_three_sec_sub_title', 'none');
                        treck_elementor_rendered_content($this, 'layout_three_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_three']);
                    endif;
                    ?>
                    <div class="section-title__border-box"></div>
                </div>

                <?php
                if (!empty($settings['layout_three_sec_title'])) :
                    $this->add_inline_editing_attributes('layout_three_sec_title', 'none');
                    treck_elementor_rendered_content($this, 'layout_three_sec_title', 'section-title__title', $settings['section_title_tag_layout_three']);
                endif;
                ?>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-three__left">
                        <div class="about-three__img-box">
                            <div class="about-three__img">
                                <?php treck_elementor_rendered_image($settings, 'layout_three_image_one'); ?>
                            </div>
                            <div class="about-three__img-two">
                                <?php treck_elementor_rendered_image($settings, 'layout_three_image_two'); ?>
                            </div>
                            <div class="about-three__img-three">
                                <?php treck_elementor_rendered_image($settings, 'layout_three_image_three'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-three__right">
                        <div class="about-three__top">
                            <div class="about-three__icon icon-svg-large">
                                <?php \Elementor\Icons_Manager::render_icon($settings['layout_three_highlighted_text_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                            </div>
                            <div class="about-three__content">
                                <?php
                                if (!empty($settings['layout_three_highlighted_text'])) :
                                    treck_basic_rendered_content($this, $settings,  'layout_three_highlighted_text', '', 'h4');
                                endif;
                                ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($settings['layout_three_summary_one'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_three_summary_one', 'about-three__text-1', 'p');
                        endif;

                        if (!empty($settings['layout_three_summary_two'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_three_summary_two', 'about-three__text-2', 'p');
                        endif;
                        ?>

                        <ul class="list-unstyled about-three__points ml-0">
                            <?php foreach ($settings['layout_three_check_list'] as $item) : ?>
                                <li>
                                    <div class="icon icon-svg">
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                    </div>
                                    <div class="text">
                                        <?php
                                        if (!empty($item['title'])) :
                                            treck_basic_rendered_content($this, $item,  'title', '', 'p');
                                        endif;
                                        ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php
                        if (!empty($settings['layout_three_button_label'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_three_button_label', 'about-three__btn thm-btn', 'a', 'layout_three_button_url', '');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About Three End-->

<?php endif; ?>