<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="coaching-details__services-list">
        <ul class="coaching-details__services list-unstyled ml-0">
            <?php foreach ($settings['sidebar_nav'] as $index => $item) : ?>
                <li class="<?php echo esc_attr(('yes' == $item['active_status'] ? 'active' : '')); ?>">
                    <?php
                    if (!empty($item['name'])) :
                        treck_basic_rendered_content($this, $item,  'name', '', 'a', 'button_url', '');
                    endif;
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>