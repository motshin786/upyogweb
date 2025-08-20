<?php if ('layout_two' == $settings['layout_type']) : ?>
    <div class="coaching-details__importance">
        <div class="coaching-details__importance-bg" style="background-image: url(<?php echo esc_url($settings['layout_two_bg_image']['url']); ?>);">
        </div>
        <div class="coaching-details__importance-title-box">
            <?php
            if (!empty($settings['layout_two_title'])) :
                $this->add_inline_editing_attributes('layout_two_title', 'none');
                treck_elementor_rendered_content($this, 'layout_two_title', 'coaching-details__importance-title', $settings['title_tag_layout_two']);
            endif; ?>
            <div class="coaching-details__importance-btn-box">
                <?php
                if (!empty($settings['layout_two_button_label'])) :
                    treck_basic_rendered_content($this, $settings,  'layout_two_button_label', 'coaching-details__importance-btn', 'a', 'layout_two_button_url', '');
                endif;
                ?>
            </div>
        </div>
        <?php if (is_array($settings['layout_two_checklist_list'])) : ?>
            <ul class="coaching-details__importance-points-list list-unstyled ml-0">
                <?php foreach ($settings['layout_two_checklist_list'] as $index => $item) : ?>
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
        <?php endif; ?>
    </div>
<?php endif; ?>