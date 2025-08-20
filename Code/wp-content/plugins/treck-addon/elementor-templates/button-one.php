<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="visa-details__btn-box">
        <?php
        if (!empty($settings['button_label'])) :
            treck_basic_rendered_content($this, $settings,  'button_label', 'visa-details__btn thm-btn', 'a', 'button_url');
        endif;
        ?>
    </div>
<?php endif; ?>