<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="footer-widget__column footer-widget__link">
        <div class="footer-widget__title-box">
            <?php
            if (!empty($settings['title'])) :
                $this->add_inline_editing_attributes('title', 'none');
                treck_elementor_rendered_content($this, 'title', 'footer-widget__title', $settings['section_title_tag_layout_one']);
            endif;
            ?>
        </div>
        <?php
        foreach ($settings['nav_menus'] as $nav_menu) : ?>
            <?php wp_nav_menu(array(
                'menu' => $nav_menu['nav_menu'],
                'menu_class' => 'footer-widget__link-list list-unstyled ml-0'
            ));
            ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>