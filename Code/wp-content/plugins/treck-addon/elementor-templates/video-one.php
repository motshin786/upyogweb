<?php if ('layout_one' == $settings['layout_type']) : ?>

    <!--Video One Start-->
    <section class="video-one">
        <div class="video-one__bg" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url(<?php echo esc_url($settings['layout_one_bg_image']['url']); ?>);"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="video-one__left">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <?php
                                if (!empty($settings['sec_sub_title'])) :
                                    treck_basic_rendered_content($this, $settings,  'sec_sub_title', 'section-title__tagline', 'span');
                                endif;
                                ?>
                                <div class="section-title__border-box"></div>
                            </div>
                            <?php
                            if (!empty($settings['sec_title'])) :
                                $this->add_inline_editing_attributes('sec_title', 'none');
                                treck_elementor_rendered_content($this, 'sec_title', 'section-title__title', $settings['section_title_tag_layout_one']);
                            endif;
                            ?>
                        </div>
                        <ul class="video-one__points list-unstyled ml-0">
                            <?php foreach ($settings['check_list'] as $index => $item) : ?>
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
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="video-one__right">
                        <div class="video-one__video-link">
                            <a href="<?php echo esc_url($settings['layout_one_video_url']); ?>" class="video-popup">
                                <div class="video-one__video-icon">
                                    <span class="fa fa-play"></span>
                                    <i class="ripple"></i>
                                </div>
                            </a>
                            <div class="video-one__shape-1 float-bob-x">
                                <?php treck_elementor_rendered_image($settings, 'layout_one_shape'); ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($settings['video_text'])) :
                            treck_basic_rendered_content($this, $settings,  'video_text', 'video-one__text', 'p');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Video One End-->

<?php endif; ?>