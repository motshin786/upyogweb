<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!--Counter One Start-->
    <section class="counter-one">
        <?php if (!empty($settings['bg_image']['url'])) : ?>
            <div class="counter-one__bg" style="background-image: url(<?php echo esc_url($settings['bg_image']['url']); ?>);">
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <?php
                foreach ($settings['counter_list'] as $index => $item) :
                ?>
                    <!--Counter One Single Start-->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="counter-one__single">
                            <div class="counter-one__icon icon-svg-large">
                                <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
                            </div>
                            <div class="counter-one__content">
                                <div class="counter-one__count-box count-box">
                                    <h3 class="count-text" data-stop="<?php echo esc_attr($item['number']); ?>" data-speed="1500">00</h3>
                                    <span class="counter-two__plus"><?php echo esc_html($item['sign']); ?></span>
                                </div>
                                <?php
                                if (!empty($item['title'])) :
                                    treck_basic_rendered_content($this, $item,  'title', '', 'p');
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--Counter One Single End-->
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--Counter One End-->
<?php endif; ?>