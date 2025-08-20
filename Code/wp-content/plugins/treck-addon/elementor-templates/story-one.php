<?php if ('layout_one' === $settings['layout_type']) : ?>

    <!--Story Details Start-->
    <section class="story-details">
        <div class="story-details__wrap">
            <div class="container">
                <div class="story-details__inner">
                    <div class="story-details__img-box">
                        <div class="story-details__img">
                            <?php treck_elementor_rendered_image($settings, 'image'); ?>
                        </div>
                        <div class="story-details__badge">
                            <?php treck_elementor_rendered_image($settings, 'shape_one'); ?>
                        </div>
                        <div class="story-details__shape img-bounce">
                            <?php treck_elementor_rendered_image($settings, 'shape_two'); ?>
                        </div>
                        <div class="story-details__flag">
                            <?php treck_elementor_rendered_image($settings, 'shape_three'); ?>
                        </div>
                    </div>
                    <div class="story-details__content">
                        <?php
                        if (!empty($settings['title'])) :
                            treck_basic_rendered_content($this, $settings,  'title', 'story-details__title', $settings['title_tag_layout_one']);
                        endif;
                        ?>
                        <div class="story-details__icon-and-rating">
                            <div class="story-details__icon">
                                <?php treck_elementor_rendered_image($settings, 'shape_four'); ?>
                            </div>
                            <div class="story-details__rating">
                                <?php for ($i = 0; $i < $settings['rating']['size']; $i++) : ?>
                                    <i class="fa fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($settings['summary_one'])) :
                            treck_basic_rendered_content($this, $settings,  'summary_one', 'story-details__text-1', 'p');
                        endif;

                        if (!empty($settings['summary_two'])) :
                            treck_basic_rendered_content($this, $settings,  'summary_two', 'story-details__text-2', 'p');
                        endif;
                        ?>
                        <ul class="list-unstyled story-details__list ml-0">
                            <?php foreach ($settings['infos'] as $item) : ?>
                                <li>
                                    <?php echo esc_html($item['title']); ?> <span><?php echo esc_html($item['info_text']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="story-details__client-name">
                            <h3><?php echo esc_html($settings['client_one']); ?></h3>
                        </div>
                        <div class="story-details__btn-box">
                            <?php
                            if (!empty($settings['layout_one_button_label_one'])) :
                                treck_basic_rendered_content($this, $settings,  'layout_one_button_label_one', 'thm-btn story-details__btn-one', 'a', 'layout_one_button_url_one', '');
                            endif;

                            if (!empty($settings['layout_one_button_label_two'])) :
                                treck_basic_rendered_content($this, $settings,  'layout_one_button_label_two', 'thm-btn story-details__btn-two', 'a', 'layout_one_button_url_two', '');
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Story Details End-->
<?php endif; ?>