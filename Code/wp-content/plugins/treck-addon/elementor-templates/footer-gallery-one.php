<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="footer-widget__column footer-widget__gallery">
        <div class="footer-widget__title-box">
            <?php
            if (!empty($settings['title'])) :
                $this->add_inline_editing_attributes('title', 'none');
                treck_elementor_rendered_content($this, 'title', 'footer-widget__title', $settings['section_title_tag_layout_one']);
            endif;
            ?>
        </div>
        <ul class="footer-widget__gallery-list list-unstyled clearfix ml-0">
            <?php foreach ($settings['images'] as $index => $item) :  ?>
                <li>
                    <div class="footer-widget__gallery-img">
                        <?php treck_elementor_rendered_image($item, 'image'); ?>
                        <a href="<?php echo esc_url($item['image']['url']); ?>">
                            <span class="icon-plus"></span>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>