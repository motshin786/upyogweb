<?php if ('layout_one' === $settings['layout_type']) : ?>

    <!-- Main Sllider Start -->
    <section class="main-slider">
        <div class="main-slider__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{"loop": <?php echo esc_attr(('yes' == $settings['loop']) ? 'true' : 'false'); ?>,
             "items": <?php echo esc_attr($settings['items']['size']); ?>,
             "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
             "margin": 0,
             "dots": <?php echo esc_attr(('yes' == $settings['enable_dots']) ? 'true' : 'false'); ?>, 
             "nav": <?php echo esc_attr(('yes' == $settings['enable_nav']) ? 'true' : 'false'); ?>, 
             "animateOut": "slideOutDown",
             "animateIn": "fadeIn",
             "active": true,
             "smartSpeed": 1000,
             "autoplay": true,
             "autoplayTimeout": 7000,
            "autoplayHoverPause": false}'>
            <?php
            foreach ($settings['sliders'] as $index => $slider) :
            ?>
                <div class="item main-slider__slide-1">
                    <div class="main-slider__bg" style="background-image: url(<?php echo esc_url($slider['background_image']['url']); ?>);">
                    </div><!-- /.slider-one__bg -->
                    <div class="container">
                        <div class="main-slider__content">
                            <?php
                            if (!empty($slider['title'])) :
                                treck_basic_rendered_content($this, $slider,  'title', 'main-slider__title', $slider['title_tag_layout_one']);
                            endif;
                            ?>
                            <div class="main-slider__btn-box">
                                <?php
                                if (!empty($slider['button_label'])) :
                                    treck_basic_rendered_content($this, $slider,  'button_label', 'main-slider__btn thm-btn', 'a', 'button_url');
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!--Main Sllider Start -->
<?php endif; ?>