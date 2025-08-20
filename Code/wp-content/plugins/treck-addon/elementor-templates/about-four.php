<?php if ('layout_four' == $settings['layout_type']) : ?>

    <!--Benefits One Start-->
    <section class="benefits-one">
        <div class="benefits-one__shape-1 float-bob-y">
            <?php treck_elementor_rendered_image($settings, 'layout_four_shape'); ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="benefits-one__left">
                        <div class="benefits-one__img-box">
                            <div class="benefits-one__img-one">
                                <?php treck_elementor_rendered_image($settings, 'layout_four_image_one'); ?>
                            </div>
                            <div class="benefits-one__img-two">
                                <?php treck_elementor_rendered_image($settings, 'layout_four_image_two'); ?>
                            </div>
                            <div class="benefits-one__solution">
                                <div class="benefits-one__solution-icon icon-svg">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['layout_four_image_caption_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                </div>
                                <h4 class="benefits-one__solution-title"><?php echo wp_kses($settings['layout_four_image_caption'], 'treck_allowed_tags'); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="benefits-one__right">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <?php
                                if (!empty($settings['layout_four_sec_sub_title'])) :
                                    $this->add_inline_editing_attributes('layout_four_sec_sub_title', 'none');
                                    treck_elementor_rendered_content($this, 'layout_four_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_four']);
                                endif;
                                ?>
                                <div class="section-title__border-box"></div>
                            </div>
                            <?php
                            if (!empty($settings['layout_four_sec_title'])) :
                                $this->add_inline_editing_attributes('layout_four_sec_title', 'none');
                                treck_elementor_rendered_content($this, 'layout_four_sec_title', 'section-title__title', $settings['section_title_tag_layout_four']);
                            endif;
                            ?>
                        </div>
                        <?php
                        if (!empty($settings['layout_four_summary_one'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_four_summary_one', 'benefits-one__text', 'p');
                        endif;
                        ?>
                        <ul class="list-unstyled benefits-one__points ml-0">
                            <?php foreach ($settings['layout_four_features'] as $index => $item) : ?>
                                <li>
                                    <div class="icon icon-svg">
                                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                                    </div>
                                    <div class="content">
                                        <p><?php echo esc_html($item['tag_line']); ?></p>
                                        <h4><?php echo esc_html($item['title']); ?></h4>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Benefits One End-->
<?php endif; ?>