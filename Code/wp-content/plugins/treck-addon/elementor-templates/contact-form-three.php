<?php if ('layout_three' == $settings['layout_type']) : ?>
    <!--Contact Three Start-->
    <section class="contact-three">
        <?php if (!empty($settings['layout_three_shape_one']['url'])) : ?>
            <div class="contact-three__bg" style="background-image: url(<?php echo esc_url($settings['layout_three_shape_one']['url']); ?>);"></div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="contact-three__left">
                        <div class="section-title text-left">
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
                        <div class="contact-three__main-tab-box tabs-box">
                            <ul class="tab-buttons clearfix list-unstyled ml-0">
                                <?php $i = 1;
                                foreach ($settings['layout_three_tab_items'] as $index => $item) : ?>
                                    <li data-tab="#tab_id_number<?php echo esc_attr($i); ?>" class="tab-btn <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-btn' : '')); ?>"><span><?php echo esc_html($item['title']); ?></span></li>
                                <?php $i++;
                                endforeach; ?>
                            </ul>
                            <div class="tabs-content">
                                <?php
                                $i = 1;
                                foreach ($settings['layout_three_tab_items'] as $index => $item) : ?>
                                    <!--tab-->
                                    <div class="tab <?php echo esc_attr(('yes' == $item['active_status'] ? 'active-tab' : '')); ?>" id="tab_id_number<?php echo esc_attr($i); ?>">
                                        <div class="contact-three__tab-content-inner">
                                            <p class="contact-three__tab-content-text"><?php echo esc_html($item['text']); ?></p>
                                            <div class="contact-three__contact-details">
                                                <div class="contact-three__contact-details-img">
                                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                                </div>
                                                <ul class="list-unstyled contact-three__contact-list ml-0">
                                                    <?php echo wp_kses_post($item['info']); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="contact-three__right">
                        <div class="contact-three__form-box">
                            <div class="contact-three__form-top">
                                <p><?php echo esc_html($settings['layout_three_contact_form_title']); ?></p>
                            </div>
                            <?php echo str_replace("<br />", "", trim(do_shortcode('[contact-form-7 id="' . $settings['layout_three_select_wpcf7_form'] . '" ]'))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Three End-->

<?php endif; ?>