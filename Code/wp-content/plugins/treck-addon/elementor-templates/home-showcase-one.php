<?php if ('layout_one' === $settings['layout_type']) : ?>
    <section class="home-showcase">
        <div class="container">
            <div class="home-showcase__inner">
                <div class="row">
                    <?php foreach ($settings['megamenu_box_list'] as $item) :  ?>
                        <div class="col-lg-3">
                            <div class="home-showcase__item">
                                <div class="home-showcase__image">
                                    <?php treck_elementor_rendered_image($item, 'image'); ?>
                                    <div class="home-showcase__buttons">
                                        <?php if (!empty($item['multi_page_title'])) : ?>
                                            <a href="<?php echo esc_url($item['multi_page_url']['url']); ?>" class="thm-btn home-showcase__buttons__item"><?php echo wp_kses($item['multi_page_title'], 'ogenix_allowed_tags'); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($item['one_page_title'])) : ?>
                                            <a href="<?php echo esc_url($item['one_page_url']['url']); ?>" class="thm-btn home-showcase__buttons__item"><?php echo wp_kses($item['one_page_title'], 'ogenix_allowed_tags'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <!-- /.home-showcase__buttons -->
                                </div><!-- /.home-showcase__image -->
                                <?php
                                if (!empty($item['heading'])) :
                                    treck_basic_rendered_content($this, $item,  'heading', 'home-showcase__title', $item['home_showcase_heading_tag_layout_one']);
                                endif;
                                ?>
                                <!-- /.home-showcase__title -->
                            </div><!-- /.home-showcase__item -->
                        </div><!-- /.col-lg-3 -->
                    <?php endforeach; ?>
                </div><!-- /.row -->
            </div><!-- /.home-showcase__inner -->

        </div><!-- /.container -->
    </section>
<?php endif; ?>