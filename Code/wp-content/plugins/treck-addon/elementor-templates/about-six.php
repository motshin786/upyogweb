<?php if ('layout_six' == $settings['layout_type']) : ?>
    <!--Benefits One Start-->
    <section class="benefits-one benefits-two">
        <?php if (!empty($settings['layout_six_shape_one']['url'])) : ?>
            <div class="benefits-two__bg" style="background-image: url(<?php echo esc_url($settings['layout_six_shape_one']['url']); ?>);"></div>
        <?php endif; ?>
        <?php if (!empty($settings['layout_six_shape_two']['url'])) : ?>
            <div class="benefits-two__bg-two" style="background-image: url(<?php echo esc_url($settings['layout_six_shape_two']['url']); ?>);"></div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="benefits-one__left">
                        <div class="benefits-one__img-box">
                            <div class="benefits-one__img-one">
                                <?php treck_elementor_rendered_image($settings, 'layout_six_image_one'); ?>
                            </div>
                            <div class="benefits-one__img-two">
                                <?php treck_elementor_rendered_image($settings, 'layout_six_image_two'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="benefits-one__right">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <?php
                                if (!empty($settings['layout_six_sec_sub_title'])) :
                                    $this->add_inline_editing_attributes('layout_six_sec_sub_title', 'none');
                                    treck_elementor_rendered_content($this, 'layout_six_sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_six']);
                                endif;
                                ?>
                                <div class="section-title__border-box"></div>
                            </div>
                            <?php
                            if (!empty($settings['layout_six_sec_title'])) :
                                $this->add_inline_editing_attributes('layout_six_sec_title', 'none');
                                treck_elementor_rendered_content($this, 'layout_six_sec_title', 'section-title__title', $settings['section_title_tag_layout_six']);
                            endif;
                            ?>
                        </div>
                        <?php
                        if (!empty($settings['layout_six_summary_one'])) :
                            treck_basic_rendered_content($this, $settings,  'layout_six_summary_one', 'benefits-one__text', 'p');
                        endif;
                        ?>
                        <ul class="list-unstyled benefits-one__points ml-0">
                            <?php foreach ($settings['layout_six_features'] as $index => $item) : ?>
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