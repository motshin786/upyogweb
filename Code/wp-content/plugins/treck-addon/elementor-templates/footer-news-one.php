<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="footer-widget__column footer-widget__news">
        <?php if (!empty($settings['title'])) : ?>
            <div class="footer-widget__title-box">
                <h3 class="footer-widget__title"><?php echo esc_html($settings['title']); ?></h3>
            </div>
        <?php endif; ?>
        <ul class="footer-widget__news-list list-unstyled ml-0">
            <?php
            $footer_news_query_args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'ignore_sticky_posts' => true,
                'orderby' => 'date',
                'order'   => $settings['query_order'],
                'posts_per_page' => $settings['post_count']['size']
            );

            $footer_news_query = new \WP_Query($footer_news_query_args);
            ?>
            <?php while ($footer_news_query->have_posts()) :
                $footer_news_query->the_post(); ?>
                <li>
                    <div class="footer-widget__news-img">
                        <?php the_post_thumbnail('treck_brand_70X70'); ?>
                    </div>
                    <div class="footer-widget__news-content">
                        <p class="footer-widget__news-date"><?php the_time('d M, y'); ?></p>
                        <h5 class="footer-widget__news-sub-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h5>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>