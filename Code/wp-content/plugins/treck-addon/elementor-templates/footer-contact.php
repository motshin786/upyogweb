<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="footer-widget__column footer-widget__Contact">

        <div class="footer-widget__title-box">
            <?php
            if (!empty($settings['title'])) :
                $this->add_inline_editing_attributes('title', 'none');
                treck_elementor_rendered_content($this, 'title', 'footer-widget__title', $settings['section_title_tag_layout_one']);
            endif;
            ?>
        </div>

        <ul class="footer-widget__Contact-list list-unstyled ml-0">
            <?php
            foreach ($settings['footer_contact_list'] as $index => $item) :
            ?>
                <li>
                    <div class="icon icon-svg">
                        <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ''], 'span'); ?>
                    </div>
                    <div class="text">
                        <p><?php echo wp_kses($item['content'], 'treck_allowed_tags'); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>