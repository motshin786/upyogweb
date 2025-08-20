<?php $treck_portfolio_category =  get_the_terms(get_the_iD(), 'portfolio_cat'); ?>
<?php get_header(); ?>

<section class="projects-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="projects-details__wrapper">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="projects-details__img">
                            <?php the_post_thumbnail('treck_portfolio_details_1170X531'); ?>
                        </div>
                    <?php endif; ?>
                    <!--Projects Details Information Start-->
                    <div class="projects-details__information">
                        <ul class="list-unstyled">
                            <li>
                                <h5><?php esc_html_e('Date', 'treck-addon'); ?></h5>
                                <p><?php echo esc_html(get_post_meta(get_the_iD(), 'treck_portfolio_date', true)); ?></p>
                            </li>

                            <li>
                                <h5><?php esc_html_e('Client', 'treck-addon'); ?></h5>
                                <p><?php echo esc_html(get_post_meta(get_the_iD(), 'treck_portfolio_client', true)); ?></p>
                            </li>

                            <li>
                                <h5><?php esc_html_e('Website', 'treck-addon'); ?></h5>
                                <p><a href="<?php echo esc_url(get_post_meta(get_the_iD(), 'treck_portfolio_website', true)); ?>"><?php echo esc_html(get_post_meta(get_the_iD(), 'treck_portfolio_website', true)); ?></a></p>
                            </li>

                            <li>
                                <h5><?php esc_html_e('Location', 'treck-addon'); ?></h5>
                                <p><?php echo esc_html(get_post_meta(get_the_iD(), 'treck_portfolio_location', true)); ?></p>
                            </li>

                            <li>
                                <h5><?php esc_html_e('Value', 'treck-addon'); ?></h5>
                                <p><?php echo esc_html(get_post_meta(get_the_iD(), 'treck_portfolio_Value', true)); ?></p>
                            </li>
                        </ul>
                    </div>
                    <!--Projects Details Information End-->

                    <div class="projects-details__text-box1">
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>

                    <div class="projects-details__pagination clearfix">
                        <ul class="list-unstyled">
                            <li>
                                <div class="previous">
                                    <p><?php echo get_previous_post_link('%link', '<span class="icon-right-arrow-2"></span>' . __('Previous', 'treck-addon'));  ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="next">
                                    <p><?php echo get_next_post_link('%link', __('Next', 'treck-addon') . '<span class="icon-right-arrow-2"></span>'); ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>