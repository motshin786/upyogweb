<?php if ('layout_one' === $settings['layout_type']) : ?>

    <!--Location One Start-->
    <section class="location-one">
        <div class="container">
            <div class="location-one__top">
                <div class="row">
                    <div class="col-xl-7 col-lg-6">
                        <div class="location-one__top-left">
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
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="location-one__top-right">
                            <?php
                            if (!empty($settings['summary'])) :
                                treck_basic_rendered_content($this, $settings,  'summary', 'ocation-one__top-text', 'p');
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="location-one__bottom">
                <div class="location-one__main-tab-box tabs-box">
                    <ul class="tab-buttons clearfix list-unstyled ml-0">
                        <?php $i = 1;
                        foreach ($settings['tab_items'] as $index => $item) : ?>
                            <li data-tab="#ctry_tab_number<?php echo esc_attr($i); ?>" class="tab-btn <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-btn' : '')); ?>">
                                <span><?php echo esc_html($item['title']); ?></span>
                            </li>
                        <?php $i++;
                        endforeach; ?>
                    </ul>
                    <div class="tabs-content">
                        <?php $i = 1;
                        foreach ($settings['tab_items'] as $index => $item) : ?>
                            <!--tab-->
                            <div class="tab <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-tab' : '')); ?>" id="ctry_tab_number<?php echo esc_attr($i); ?>">
                                <div class="location-one__tab-content-box">
                                    <div class="location-one__tab-content-box-inner">
                                        <div class="location-one__bg" style="background-image: url(<?php echo esc_url($item['bg_image']['url']); ?>);">
                                        </div>
                                        <div class="location-one__tab-content-left">
                                            <div class="location-one__tab-content-img">
                                                <?php treck_elementor_rendered_image($item, 'image'); ?>
                                            </div>
                                            <div class="location-one__tab-content-contact">
                                                <h5 class="location-one__tab-content-contact-title"><?php echo esc_html($item['title']); ?></h5>
                                                <ul class="list-unstyled location-one__tab-content-contact-list ml-0">
                                                    <?php echo wp_kses_post($item['contact_info']); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="location-one__tab-content-right">
                                            <ul class="list-unstyled location-one__tab-content-time ml-0">
                                                <?php echo wp_kses_post($item['office_time']); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Location One End-->
<?php endif; ?>