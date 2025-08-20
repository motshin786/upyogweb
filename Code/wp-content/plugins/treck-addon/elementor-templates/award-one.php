<?php if ('layout_one' === $settings['layout_type']) : ?>

    <!--Awards One Start-->
    <section class="awards-one">
        <?php if (!empty($settings['shapes'][0]['url'])) : ?>
            <div class="awards-one__shape-2">
                <img src="<?php echo esc_url($settings['shapes'][0]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][0]['id'])); ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['shapes'][1]['url'])) : ?>
            <div class="awards-one__shape-3">
                <img src="<?php echo esc_url($settings['shapes'][1]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][1]['id'])); ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['shapes'][2]['url'])) : ?>
            <div class="awards-one__shape-4">
                <img src="<?php echo esc_url($settings['shapes'][2]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][2]['id'])); ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['shapes'][3]['url'])) : ?>
            <div class="awards-one__shape-5 img-bounce">
                <img src="<?php echo esc_url($settings['shapes'][3]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][3]['id'])); ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['shapes'][4]['url'])) : ?>
            <div class="awards-one__shape-6 float-bob-y">
                <img src="<?php echo esc_url($settings['shapes'][4]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][4]['id'])); ?>">
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="awards-one__left">
                        <div class="section-title text-left">
                            <div class="section-title__tagline-box">
                                <?php
                                if (!empty($settings['sec_sub_title'])) :
                                    $this->add_inline_editing_attributes('sec_sub_title', 'none');
                                    treck_elementor_rendered_content($this, 'sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_one']);
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
                        <div class="awards-one__text-and-points-box">
                            <p class="awards-one__text count-box"><?php echo wp_kses_post($settings['summary']); ?></p>
                            <ul class="awards-one__points list-unstyled ml-0">
                                <?php foreach ($settings['checklist_list'] as $index => $item) : ?>
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
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="awards-one__right">
                        <?php if (!empty($settings['shapes'][5]['url'])) : ?>
                            <div class="awards-one__shape-7">
                                <img src="<?php echo esc_url($settings['shapes'][5]['url']); ?>" alt="<?php echo esc_attr(treck_get_thumbnail_alt($settings['shapes'][5]['id'])); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php foreach ($settings['awards'] as $index => $item) :  ?>
                                <!--Awards One Single Start-->
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="awards-one__single">
                                        <div class="awards-one__shape-1">
                                            <?php treck_elementor_rendered_image($item, 'shape'); ?>
                                        </div>
                                        <?php
                                        if (!empty($item['year'])) :
                                            treck_basic_rendered_content($this, $item,  'year', 'awards-one__year', 'p');
                                        endif;
                                        ?>
                                        <div class="awards-one__img">
                                            <?php treck_elementor_rendered_image($item, 'image'); ?>
                                        </div>
                                        <<?php echo esc_attr($item['award_title_tag_layout_one']); ?> class="awards-one__title">
                                            <?php
                                            if (!empty($item['title'])) :
                                                treck_basic_rendered_content($this, $item,  'title', '', 'a');
                                            endif;
                                            ?>
                                        </<?php echo esc_attr($item['award_title_tag_layout_one']); ?>>
                                    </div>
                                </div>
                                <!--Awards One Single End-->
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Awards One End-->
<?php endif; ?>