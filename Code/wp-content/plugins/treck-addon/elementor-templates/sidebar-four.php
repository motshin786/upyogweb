<?php if ('layout_four' == $settings['layout_type']) : ?>
    <div class="countries-details__services-list">
        <ul class="countries-details__services list-unstyled ml-0">
            <?php foreach ($settings['layout_four_sidebar_nav'] as $index => $item) : ?>
                <li class="<?php echo esc_attr(('yes' == $item['active_status'] ? 'active' : '')); ?>">
                    <?php
                    if (!empty($item['name'])) :
                        treck_basic_rendered_content($this, $item,  'name', '', 'a', 'button_url', '');
                    endif;
                    ?>
                    <div class="countries-details__countries-flag">
                        <?php treck_elementor_rendered_image($item, 'image'); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>