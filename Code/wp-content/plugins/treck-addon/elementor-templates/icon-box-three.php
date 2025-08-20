<?php if ('layout_three' == $settings['layout_type']) : ?>
    <ul class="countries-details__points list-unstyled ml-0">
        <?php foreach ($settings['layout_three_info_box'] as $item) : ?>
            <li>
                <div class="icon icon-svg">
                    <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                </div>
                <div class="text">
                    <p>
                        <?php
                        if (!empty($item['title'])) :
                            treck_basic_rendered_content($this, $item,  'title', '', 'a');
                        endif;
                        ?>
                    </p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>