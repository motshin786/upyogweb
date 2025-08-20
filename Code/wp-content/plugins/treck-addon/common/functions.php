<?php

/**
 * making array of custom icon classes
 * which is saved in transient
 * @return array
 */
/**
 * making array of custom icon classes
 * which is saved in transient
 * @return array
 */
/**
 * making array of custom icon classes
 * which is saved in transient
 * @return array
 */
if (!function_exists('treck_get_fa_icons')) :

    function treck_get_fa_icons()
    {
        $data = get_transient('treck_fa_icons');

        if (empty($data)) {
            global $wp_filesystem;
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();

            $fontAwesome_file =   TRECK_ADDON_PATH . '/assets/vendors/fontawesome/css/all.min.css';
            $template_icon_file = TRECK_ADDON_PATH . '/assets/vendors/treck-icons/style.css';
            $content = '';

            if ($wp_filesystem->exists($fontAwesome_file)) {
                $content = $wp_filesystem->get_contents($fontAwesome_file);
            } // End If Statement

            if ($wp_filesystem->exists($template_icon_file)) {
                $content .= $wp_filesystem->get_contents($template_icon_file);
            } // End If Statement

            $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s*{\s*content/';
            $pattern_two = '/\.(icon-(?:\w+(?:-)?)+):before\s*{\s*content/';

            $subject = $content;

            preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
            preg_match_all($pattern_two, $subject, $matches_two, PREG_SET_ORDER);

            $all_matches = array_merge($matches, $matches_two);

            $icons = array();

            foreach ($all_matches as $match) {
                // $icons[] = array('value' => $match[1], 'label' => $match[1]);
                $icons[] = $match[1];
            }


            $data = $icons;
            set_transient('treck_fa_icons', $data, 10080); // saved for one week

        }

        return array_combine($data, $data); // combined for key = value
    }


endif;

// custom kses allowed html
if (!function_exists('treck_kses_allowed_html')) :
    function treck_kses_allowed_html($tags, $context)
    {
        switch ($context) {
            case 'treck_allowed_tags':
                $tags = array(
                    'a' => array('href' => array(), 'class' => array()),
                    'b' => array(),
                    'br' => array(),
                    'span' => array('class' => array(), 'data-count' => array(), 'data-stop' => array(), 'data-speed' => array()),
                    'del' => array('class' => array(), 'data-count' => array()),
                    'ins' => array('class' => array(), 'data-count' => array()),
                    'bdi' => array('class' => array(), 'data-count' => array()),
                    'img' => array('class' => array()),
                    'i' => array('class' => array()),
                    'p' => array('class' => array()),
                    'ul' => array('class' => array()),
                    'li' => array('class' => array()),
                    'div' => array('class' => array()),
                    'strong' => array(),
                    'sup' => array(),
                );
                return $tags;
            default:
                return $tags;
        }
    }

    add_filter('wp_kses_allowed_html', 'treck_kses_allowed_html', 10, 2);

endif;

if (!function_exists('treck_excerpt')) :

    // Post's excerpt text
    function treck_excerpt($get_limit_value, $echo = true)
    {
        $opt = $get_limit_value;
        $excerpt_limit = !empty($opt) ? $opt : 40;
        $excerpt = wp_trim_words(get_the_content(), $excerpt_limit, '');
        if ($echo == true) {
            echo esc_html($excerpt);
        } else {
            return esc_html($excerpt);
        }
    }

endif;


if (!function_exists('treck_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function treck_posted_on()
    {
        $time_trecktring = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_trecktring = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_trecktring = sprintf(
            $time_trecktring,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x(' %s', 'post date', 'treck'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_trecktring . '</a>'
        );

        echo '<span class="posted-on"><i class="fas fa-clock"></i>' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('treck_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function treck_posted_by()
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('%s', 'post author', 'treck'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"><i class="fas fa-user-circle"></i> ' . esc_html__('by ', 'treck') . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('treck_comment_count')) {
    function treck_comment_count()
    {
        if (!post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link"><i class="fas fa-comments"></i> ';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'treck'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }
    }
}

if (!function_exists('treck_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function treck_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(' ', 'treck'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="blog-details__tags"><span>' . esc_html__('Posted in: %1$s', 'treck') . '</span>', '</span>' . $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'treck'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="news-details__tags news-details__tags--tags"><span>' . esc_html__('Tags: %1$s', 'treck') . '</span>', '</span>' . $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    }
endif;

if (!function_exists('treck_post_query')) {
    function treck_post_query($post_type)
    {
        $post_list = get_posts(array(
            'post_type' => $post_type,
            'showposts' => -1,
        ));
        $posts = array();

        if (!empty($post_list) && !is_wp_error($post_list)) {
            foreach ($post_list as $post) {
                $options[$post->ID] = $post->post_title;
            }
            return $options;
        }
    }
}

if (!function_exists('treck_custom_query_pagination')) :
    /**
     * Prints HTML with post pagination links.
     */
    function treck_custom_query_pagination($paged = '', $max_page = '')
    {
        global $wp_query;
        $big = 999999999; // need an unlikely integer
        if (!$paged)
            $paged = get_query_var('paged');
        if (!$max_page)
            $max_page = $wp_query->max_num_pages;

        $links = paginate_links(array(
            'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'     => '?paged=%#%',
            'current'    => max(1, $paged),
            'total'      => $max_page,
            'mid_size'   => 1,
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
        ));

        echo wp_kses($links, 'treck_allowed_tags');
    }
endif;

if (!function_exists('treck_get_nav_menu')) :
    function treck_get_nav_menu()
    {
        $menu_list = get_terms(array(
            'taxonomy' => 'nav_menu',
            'hide_empty' => true,
        ));
        $options = [];
        if (!empty($menu_list) && !is_wp_error($menu_list)) {
            foreach ($menu_list as $menu) {
                $options[$menu->slug] = $menu->name;
            }
            return $options;
        }
    }
endif;

if (!function_exists('treck_get_taxonoy')) :
    function treck_get_taxonoy($taxonoy)
    {
        $taxonomy_list = get_terms(array(
            'taxonomy' => $taxonoy,
            'hide_empty' => true,
        ));
        $options = [];
        if (!empty($taxonomy_list) && !is_wp_error($taxonomy_list)) {
            foreach ($taxonomy_list as $taxonomy) {
                $options[$taxonomy->slug] = $taxonomy->name;
            }
            return $options;
        }
    }
endif;

if (!function_exists('treck_get_template')) :
    function treck_get_template($template_name = null)
    {
        $template_path = apply_filters('treck-elementor/template-path', 'elementor-templates/');
        $template = locate_template($template_path . $template_name);
        if (!$template) {
            $template = TRECK_ADDON_PATH  . '/elementor-templates/' . $template_name;
        }
        if (file_exists($template)) {
            return $template;
        } else {
            return false;
        }
    }
endif;

if (!function_exists('treck_get_elementor_option')) :
    function treck_get_elementor_option($template_name = null)
    {
        $template_path = apply_filters('treck-elementor/template-options', 'elementor-options/');
        $template = locate_template($template_path . $template_name);
        if (!$template) {
            $template = TRECK_ADDON_PATH  . '/elementor-options/' . $template_name;
        }
        if (file_exists($template)) {
            return $template;
        }
    }
endif;

if (!function_exists('treck_get_thumbnail_alt')) :
    function treck_get_thumbnail_alt($thumbnail_id)
    {
        return get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    }
endif;


if (!function_exists('treck_get_owl_options')) :
    function treck_get_owl_options($settings)
    {
        $loop_status = ('yes' == $settings['loop']) ? 'true' : 'false';
        $nav_status = ('yes' == $settings['enable_nav']) ? 'true' : 'false';
        $dots_status = ('yes' == $settings['enable_dots']) ? 'true' : 'false';
        $autoplay_status = ('yes' == $settings['autoplay']) ? 'true' : 'false';
        $hover_pause_status = ('yes' == $settings['hover_pause']) ? 'true' : 'false';
        $delay = $settings['delay']['size'];
        if ('yes' == $settings['enable_nav']) {
            $nav_left_icon = $settings['nav_left_icon']['value'];
            $nav_right_icon = $settings['nav_right_icon']['value'];
        }
        $items = $settings['items']['size'];
        $margin = $settings['margin']['size'];
        $smart_speed = $settings['smart_speed']['size'];
        $breakpoint = $settings['breakpoint'];
        ob_start(); ?>
        {
        "loop": <?php echo esc_attr($loop_status) ?>,
        "margin": <?php echo esc_attr($margin) ?>,
        "items": <?php echo esc_attr($items) ?>
        ,"nav": <?php echo esc_attr($nav_status) ?>
        <?php if ('true' == $autoplay_status) : ?>
            ,"autoplay": <?php echo esc_attr($autoplay_status); ?>
            ,"autoplayTimeout": <?php echo esc_attr($delay); ?>
        <?php endif; ?>
        <?php if ('true' == $hover_pause_status) : ?>
            ,"autoplayHoverPause": <?php echo esc_attr($hover_pause_status); ?>
        <?php endif; ?>
        <?php if ('yes' == $settings['enable_nav']) :  ?>
            ,"navText": [
            "<i class=\" <?php echo esc_attr($nav_left_icon) ?>\"></i>",
            "<i class=\" <?php echo esc_attr($nav_right_icon) ?>\"></i>"
            ]
        <?php endif; ?>
        ,"dots": <?php echo esc_attr($dots_status) ?>
        ,"smartSpeed": <?php echo esc_attr($smart_speed) ?>

        <?php if (!empty($breakpoint)) :  ?>
            ,
            "responsive":
            {
            <?php foreach ($breakpoint as $item) : ?>
                "<?php echo esc_attr($item['screen_size']['size']); ?>": {
                "margin": <?php echo esc_attr($item['margin']['size']); ?>,
                "items": <?php echo esc_attr($item['item']['size']); ?>
                }<?php echo esc_attr($item != end($breakpoint) ? ',' : ''); ?>
            <?php endforeach; ?>
            }
        <?php endif; ?>
        }
    <?php return ob_get_clean();
    }
endif;

if (!function_exists('treck_get_circle_options')) :
    function treck_get_circle_options($arg, $condition = false)
    {

        if (!empty($condition)) :

            //Circle Options
            $arg->start_controls_section(
                'circle_options',
                [
                    'label' => __('Circle Options', 'treck-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout_type' => $condition
                    ]
                ]
            );

        else :
            $arg->start_controls_section(
                'circle_options',
                [
                    'label' => __('Circle Options', 'treck-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
        endif;


        $arg->add_control(
            'enable_gradient_color',
            [
                'label' => __('Enable Gradient Color?', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'treck-addon'),
                'label_off' => __('No', 'treck-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $gradient_items_color = new \Elementor\Repeater();

        $gradient_items_color->add_control(
            'gradient_color',
            [
                'label' => esc_html__('Gradient Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $arg->add_control(
            'gradient_items_color',
            [
                'label' => __('Gradient Lists', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $gradient_items_color->get_controls(),
                'condition' => [
                    'enable_gradient_color' => ['yes']
                ]
            ]
        );


        $arg->add_control(
            'fill_color',
            [
                'label' => esc_html__('Fill Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default=' => '36731f',
                'condition' => [
                    'enable_gradient_color!' => ['yes']
                ]

            ]
        );

        $arg->add_control(
            'empty_fill_color',
            [
                'label' => esc_html__('Empty Fill Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default=' => '36731f'
            ]
        );

        $arg->add_control(
            'thickness',
            [
                'label' => __('Thickness', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 1,
                        'max' => 14,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 3,
                ],
            ]
        );

        $arg->add_control(
            'size',
            [
                'label' => __('Size', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 50,
                        'max' => 200,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 110,
                ],
            ]
        );

        $arg->add_control(
            'angel',
            [
                'label' => __('Angel', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 0,
                        'max' => 180,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 0,
                ],
            ]
        );

        $arg->add_control(
            'linecap',
            [
                'label' => __('Line Cap', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'square',
                'options' => [
                    'butt' => __('Butt', 'treck-addon'),
                    'round' => __('Round', 'treck-addon'),
                    'square' => __('Square', 'treck-addon'),
                ]
            ]
        );
        $arg->end_controls_section();
    }
endif;

if (!function_exists('treck_apply_circle_options')) :
    function treck_apply_circle_options($settings, $item)
    {
        $value = $item['count_number']['size'] / 10;
        $decimal = $value / 10;
        $formatted_value = number_format($decimal, 1, '.', '');
        ob_start(); ?>
        data-options='{
        "value": <?php echo esc_attr($formatted_value); ?>,
        "thickness": <?php echo esc_attr($settings['thickness']['size']); ?>,
        "startAngle": <?php echo esc_attr($settings['angel']['size']); ?>,
        <?php if (!empty($settings['empty_fill_color'])) : ?>
            "emptyFill": "<?php echo esc_attr($settings['empty_fill_color']); ?>",
        <?php endif; ?>
        <?php if (!empty($settings['linecap'])) : ?>
            "lineCap": "<?php echo esc_attr($settings['linecap']); ?>",
        <?php endif; ?>
        "size": <?php echo esc_attr($settings['size']['size']); ?>,
        "fill": {
        <?php if ('yes' == $settings['enable_gradient_color']) :
            // Output gradient colors
            echo '"gradient": [';

            end($settings['gradient_items_color']);
            $endKey = key($settings['gradient_items_color']);

            foreach ($settings['gradient_items_color'] as $key =>  $item) :
                echo esc_attr('"' . $item['gradient_color'] . '"');
                if ($key != $endKey) {
                    echo ',';
                }
            endforeach;

            echo ']';
        else :
            // Output single fill color
            echo '"color": "' . esc_attr($settings['fill_color']) . '"';
        endif; ?>
        }}'
    <?php return ob_get_clean();
    }
endif;

if (!function_exists('treck_get_swiper_options')) :
    function treck_get_swiper_options($settings, $pagination_id = false, $nav_prev_id = false, $nav_next_id = false)
    {
        $loop_status = ('yes' == $settings['loop']) ? 'true' : 'false';
        $autoplay_status = ('yes' == $settings['autoplay']) ? 'true' : 'false';
        $hover_pause_status = ('yes' == $settings['hover_pause']) ? 'true' : 'false';
        $delay = $settings['delay']['size'];
        $items = $settings['items']['size'];
        $margin = $settings['margin']['size'];
        $breakpoint = $settings['breakpoint'];
        ob_start(); ?>

        {
        "loop": <?php echo esc_attr($loop_status); ?>,
        "spaceBetween": <?php echo esc_attr($margin); ?>,
        "slidesPerView": <?php echo esc_attr($items); ?>
        <?php if ('true' == $autoplay_status) : ?>
            ,"autoplay": { "delay": <?php echo esc_attr($delay); ?> }
        <?php endif; ?>
        <?php if ('true' == $hover_pause_status) : ?>
            ,"autoplayDisableOnInteraction": <?php echo esc_attr($hover_pause_status); ?>
        <?php endif; ?>
        <?php if ('yes' == $settings['enable_dots']) : ?>
            ,"pagination": {
            "el": "#<?php echo esc_attr($pagination_id); ?>",
            "type": "bullets",
            "clickable": true
            }
        <?php endif; ?>
        <?php if ('yes' == $settings['enable_nav']) : ?>
            ,"navigation": {
            "nextEl": "#<?php echo esc_attr($nav_next_id); ?>",
            "prevEl": "#<?php echo esc_attr($nav_prev_id); ?>"
            }
        <?php endif; ?>
        <?php if (!empty($breakpoint)) :  ?>
            ,"breakpoints": {
            <?php foreach ($breakpoint as $item) : ?>
                "<?php echo esc_attr($item['screen_size']['size']); ?>": {
                "spaceBetween": <?php echo esc_attr($item['margin']['size']); ?>,
                "slidesPerView": <?php echo esc_attr($item['item']['size']); ?>
                }<?php echo esc_attr($item != end($breakpoint) ? ',' : ''); ?>
            <?php endforeach; ?>
            }
        <?php endif; ?>
        }
    <?php return ob_get_clean();
    }
endif;

if (!function_exists('treck_get_elementor_carousel_options')) :
    function treck_get_elementor_carousel_options($arg, $condition = false)
    {

        if (!empty($condition)) :
            $arg->start_controls_section(
                'slider_options',
                [
                    'label' => __('Slider Options', 'treck-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout_type' => $condition
                    ]
                ]
            );
        else :
            $arg->start_controls_section(
                'slider_options',
                [
                    'label' => __('Slider Options', 'treck-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
        endif;


        $arg->add_control(
            'autoplay',
            [
                'label' => esc_html__('AutoPlay', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'treck-addon'),
                'label_off' => esc_html__('No', 'treck-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $arg->add_control(
            'delay',
            [
                'label' => __('AutoPlay Delay', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],

                'range' => [
                    'count' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 5000,
                ],
            ]
        );

        $arg->add_control(
            'hover_pause',
            [
                'label' => __('AutoPlay On Hover', 'pifoxen-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'pifoxen-addon'),
                'label_off' => esc_html__('No', 'pifoxen-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $arg->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'treck-addon'),
                'label_off' => esc_html__('No', 'treck-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $arg->add_control(
            'enable_nav',
            [
                'label' => esc_html__('Display Nav', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'treck-addon'),
                'label_off' => esc_html__('No', 'treck-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $arg->add_control(
            'nav_left_icon',
            [
                'label' => esc_html__('Nav Left Icon', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'enable_nav' => 'yes'
                ],
                'default' => [
                    'value' => 'fa fa-angle-left',
                    'library' => 'solid',
                ],
            ]
        );

        $arg->add_control(
            'nav_right_icon',
            [
                'label' => esc_html__('Nav Right Icon', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'enable_nav' => 'yes'
                ],
                'default' => [
                    'value' => 'fa fa-angle-right',
                    'library' => 'solid',
                ],
            ]
        );

        $arg->add_control(
            'enable_dots',
            [
                'label' => esc_html__('Display Dots', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'treck-addon'),
                'label_off' => esc_html__('No', 'treck-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $arg->add_control(
            'smart_speed',
            [
                'label' => __('Smart Speed', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],

                'range' => [
                    'count' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 700,
                ],
            ]
        );


        $arg->add_control(
            'items',
            [
                'label' => __('Slide Items', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 1,
                ],
            ]
        );

        $arg->add_control(
            'margin',
            [
                'label' => __('Margin', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 1,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 0,
                ],
            ]
        );


        $breakpoint = new \Elementor\Repeater();

        $breakpoint->add_control(
            'screen_size',
            [
                'label' => __('Screen Size', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 0,
                        'max' => 1920,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 0,
                ],
            ]
        );

        $breakpoint->add_control(
            'item',
            [
                'label' => __('Slide Item', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 1,
                ],
            ]
        );

        $breakpoint->add_control(
            'margin',
            [
                'label' => __('Margin', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['count'],
                'range' => [
                    'count' => [
                        'min' => 1,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'count',
                    'size' => 0,
                ],
            ]
        );

        $arg->add_control(
            'breakpoint',
            [
                'label' => __('Breakpoints', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $breakpoint->get_controls(),
            ]
        );

        $arg->end_controls_section();
    }
endif;


if (!function_exists('treck_elementor_general_style_options')) :
    function treck_elementor_general_style_options($agrs, $label, $selector, $condition, $style = 'color', $typo = true, $color = true)
    {

        //Label
        $agrs->add_control(
            str_replace(' ', '_', $label) . '_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __($label, 'treck-addon'),
                'separator' => 'after',
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $agrs->add_responsive_control(
            str_replace(' ', '_', $label) . '_padding',
            [
                'label' => __(' Padding', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $agrs->add_responsive_control(
            str_replace(' ', '_', $label) . '_margin',
            [
                'label' => __(' Margin', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        if ($typo) :
            $agrs->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'           =>  str_replace(' ', '_', $label) . '_typo',
                    'label'          => esc_html__(' Typography', 'treck-addon'),
                    'selector'       => $selector,
                    'condition' => [
                        'layout_type' => $condition
                    ]
                ]
            );

        endif;
        if ($color) :
            $agrs->add_control(
                str_replace(' ', '_', $label) . '_color',
                [
                    'label' => __('Color', 'treck-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        $selector => $style . ': {{VALUE}}',
                    ],
                    'condition' => [
                        'layout_type' => $condition
                    ]
                ]
            );
        endif;
    }
endif;

if (!function_exists('treck_elementor_button_style_options')) :
    function treck_elementor_button_style_options($init, $label, $selector, $hover_bg_selector = '', $condition = 'layout_one')
    {

        //Label
        $init->add_control(
            str_replace(' ', '_', $label) . '_subtitle_label',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __($label, 'treck-addon'),
                'separator' => 'after',
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_responsive_control(
            str_replace(' ', '_', $label) . '_padding',
            [
                'label' => __('Padding', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => str_replace(' ', '_', $label) . '_typography',
                'selector' => $selector,
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => str_replace(' ', '_', $label) . '_border',
                'selector' => $selector,
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_border_radius',
            [
                'label' => __('Border Radius', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => str_replace(' ', '_', $label) . '_box_shadow',
                'selector' => $selector,
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->start_controls_tabs(str_replace(' ', '_', $label) . '_tabs_button');

        $init->start_controls_tab(
            str_replace(' ', '_', $label) . '_tab_button_normal',
            [
                'label' => __('Normal', 'treck-addon'),
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_color',
            [
                'label' => __('Text Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    $selector => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_bg_color',
            [
                'label' => __('Background Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->end_controls_tab();

        $init->start_controls_tab(
            str_replace(' ', '_', $label) . '_tab_button_hover',
            [
                'label' => __('Hover', 'treck-addon'),
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_hover_color',
            [
                'label' => __('Text Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $selector . ':hover,' . $selector . ':focus' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_hover_bg_color',
            [
                'label' => __('Background Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $hover_bg_selector => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->add_control(
            str_replace(' ', '_', $label) . '_hover_border_color',
            [
                'label' => __('Border Color', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    $selector . ':hover,' . $selector . ':focus' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );

        $init->end_controls_tab();
        $init->end_controls_tabs();
    }
endif;


if (!function_exists('treck_elementor_heading_option')) :
    function treck_elementor_heading_option($init, $label, $default = 'h2', $layout = '')
    {
        $init->add_control(
            str_replace(' ', '_', strtolower($label)) . '_tag_' . $layout,
            [
                'label' => esc_html__($label . ' Tag', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options' => array(
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ),
                'default' => $default,
            ]
        );
    }
endif;

if (!function_exists('treck_elementor_rendered_content')) :
    function treck_elementor_rendered_content($init, $rendered_name, $class = '', $tag = 'p', $url_name = 'url', $extra = '')
    {

        $settings = $init->get_settings_for_display();


        if ('a' == $tag) :
            $init->add_render_attribute($rendered_name, [
                'class' => 'treck-inline-editing'
            ]);
        else :
            $init->add_render_attribute($rendered_name, [
                'class' => $class,
            ]);
        endif;

        if ('a' == $tag) :
            printf(
                '<%1$s %7$s %3$s %4$s><em %2$s>%5$s</em> %6$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($rendered_name),
                'href="' . esc_url($settings[$url_name]['url']) . '"',
                esc_attr(!empty($settings[$url_name]['is_external']) ? "target=_blank" : ' '),
                wp_kses($settings[$rendered_name], 'treck_allowed_tags'),
                $extra,
                'class="' . esc_attr($class) . '"'
            );
        else :
            printf(
                '<%1$s %2$s>%3$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($rendered_name),
                wp_kses($settings[$rendered_name], 'treck_allowed_tags')
            );
        endif;
    }

endif;

if (!function_exists('treck_elementor_repeater_rendered_content')) :
    function treck_elementor_repeater_rendered_content($init, $content, $key, $rendered_name, $class = 'treck-default', $tag = 'p', $url_name = 'url', $extra = '')
    {
        if ('a' == $tag) :
            $init->add_render_attribute(
                $key,
                [
                    'class' => 'treck-inline-editing'
                ]
            );
        else :
            $init->add_render_attribute($key, [
                'class' => $class,
            ]);
        endif;


        if ('a' == $tag) :
            printf(
                '<%1$s %7$s %3$s %4$s><em %2$s>%5$s</em> %6$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($key),
                'href="' . esc_url($content[$url_name]['url']) . '"',
                esc_attr(!empty($content[$url_name]['is_external']) ? "target=_blank" : ' '),
                wp_kses($content[$rendered_name], 'treck_allowed_tags'),
                $extra,
                'class="' . esc_attr($class) . '"'
            );

        else :
            printf(
                '<%1$s %2$s>%3$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($key),
                wp_kses($content[$rendered_name], 'treck_allowed_tags')
            );
        endif;
    }

endif;

if (!function_exists('treck_basic_rendered_content')) :
    function treck_basic_rendered_content($init, $content, $rendered_name, $class = 'treck-default', $tag = 'p', $url_name = 'url', $extra = '')
    {

        $init->add_render_attribute($rendered_name, [
            'class' => $class,
        ]);


        if ('a' == $tag) :
            printf(
                '<%1$s %2$s %3$s %4$s>%5$s%6$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($rendered_name),
                'href="' . esc_url($content[$url_name]['url']) . '"',
                esc_attr(!empty($content[$url_name]['is_external']) ? "target=_blank" : ' '),
                wp_kses($content[$rendered_name], 'treck_allowed_tags'),
                $extra,
            );

        else :
            printf(
                '<%1$s %2$s>%3$s</%1$s>',
                tag_escape($tag),
                $init->get_render_attribute_string($rendered_name),
                wp_kses($content[$rendered_name], 'treck_allowed_tags')
            );
        endif;
    }

endif;

if (!function_exists('treck_elementor_rendered_image')) {
    function treck_elementor_rendered_image($content, $name, $class = '', $duration = '', $delay = '')
    {
        if (empty($content[$name])) {
            return;
        }

        $image = ($content[$name]["id"] != "") ? wp_get_attachment_image_url($content[$name]["id"], "full") : $content[$name]["url"];
        if (empty($image)) {
            return;
        }

        $image_attr = '';
        $title = \Elementor\Control_Media::get_image_title($content[$name]);

        if (!empty($title)) {
            $image_attr .= 'title="' . esc_attr($title) . '" ';
        }

        if (!empty($class)) {
            $image_attr .= 'class="' . esc_attr($class) . '" ';
        }

        if (!empty($duration)) {
            $image_attr .= 'data-wow-duration="' . esc_attr($duration) . '" ';
        }

        if (!empty($delay)) {
            $image_attr .= 'data-wow-delay="' . esc_attr($delay) . '" ';
        }

        printf(
            '<img src="%s" alt="%s" %s>',
            esc_url($image),
            esc_attr(\Elementor\Control_Media::get_image_alt($content[$name])),
            $image_attr
        );
    }
}


if (!function_exists('treck_elementor_column_count_options')) :
    function treck_elementor_column_count_options($init, $condition)
    {
        $init->start_controls_section(
            'column_options',
            [
                'label' => __('Column Options', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout_type' => $condition
                ]
            ]
        );


        $init->add_responsive_control(
            'column_count',
            [
                'label' => __('Column Width %', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .row [class*=col-]' => 'width: {{SIZE}}% !important;',
                ],
            ]
        );

        $init->end_controls_section();
    }
endif;


if (!is_rtl()) :

    function treck_set_rtl_mode($locale)
    {

        $treck_get_rtl_mode_status = get_theme_mod('treck_rtl_mode', false);

        // check page rtl
        $current_page = get_page_by_path($_SERVER['REQUEST_URI']);
        if (isset($current_page->ID)) {
            $check_page_rtl = get_post_meta($current_page->ID, 'treck_enable_rtl_mode', true);
            $treck_get_rtl_mode_status = empty($check_page_rtl) ? $treck_get_rtl_mode_status : $check_page_rtl;
        }

        //check home page
        $check_url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $check_url_without_http = trim(str_replace(array('http://', 'https://'), '', $check_url), '/');

        $site = site_url();
        $site_without_http = trim(str_replace(array('http://', 'https://'), '', $site), '/');

        if ($check_url_without_http ==  $site_without_http) {
            $frontpage_id = get_option('page_on_front');
            $check_home_page_rtl = get_post_meta($frontpage_id, 'treck_enable_rtl_mode', true);
            $treck_get_rtl_mode_status = empty($check_home_page_rtl) ? $treck_get_rtl_mode_status : $check_home_page_rtl;
        }

        $treck_dynamic_rtl_mode_status = isset($_GET['rtl_mode']) ? $_GET['rtl_mode'] : $treck_get_rtl_mode_status;
        if ('yes' == $treck_dynamic_rtl_mode_status) {
            $locale = ($treck_dynamic_rtl_mode_status == 'yes') ? 'ar' : 'en_US';
        }

        return $locale;
    }

    add_filter('locale', 'treck_set_rtl_mode', 1, 1);

endif;

/**
 * Automatically add product to cart on visit
 */
if (!function_exists('treck_auto_add_product_to_cart')) :
    function treck_auto_add_product_to_cart()
    {
        $auto_cart_status = isset($_GET['auto_cart']) ? $_GET['auto_cart'] : '';

        if (!is_admin() && !empty($auto_cart_status)) {
            $get_product = get_page_by_title($auto_cart_status, $output = OBJECT, $post_type = "product"); // 64; //replace with your own product id
            $product_id = $get_product->ID;
            $found = false;
            //check if product already in cart
            if (sizeof(WC()->cart->get_cart()) > 0) {
                foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                    $_product = $values['data'];
                    if ($_product->get_id() == $product_id)
                        $found = true;
                }
                // if product not found, add it
                if (!$found)
                    WC()->cart->add_to_cart($product_id);
            } else {
                // if no products in cart, add it
                WC()->cart->add_to_cart($product_id);
            }
        }
    }
    add_action('template_redirect', 'treck_auto_add_product_to_cart');
endif;


if (!function_exists('treck_fixed_footer_class_to_html_tag')) :
    function treck_fixed_footer_class_to_html_tag($output, $doctype)
    {
        if ('html' !== $doctype) {
            return $output;
        }

        return $output;
    }
endif;

if (!function_exists('treck_product_details_social_share')) :
    //social share
    function treck_product_details_social_share()
    {
        global $post;
        //get current page url
        $treck_url = urlencode_deep(get_permalink());
        //get current page title
        $treck_title = str_replace(' ', '%20', get_the_title($post->ID));
        //get post thumbnail for pinterest
        $treck_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        //all social share link generate
        $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $treck_url;
        $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $treck_title . '&amp;url=' . $treck_url . '&amp;via=Crunchify';;
        $linkedin_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $treck_url . '&amp;title=' . $treck_title;;
        $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url=' . $treck_url . '&amp;media=' . $treck_thumbnail[0] . '&amp;description=' . $treck_title;

    ?>
        <div class="product-details__social">
            <div class="title">
                <h3><?php esc_html_e('Share with friends', 'treck'); ?></h3>
            </div>
            <!-- /.product-details__social -->
            <div class="product-details__social-link">
                <a href="<?php echo esc_url($facebook_share_link); ?>"><span class="fab fa-twitter"></span></a>
                <a href="<?php echo esc_url($twitter_share_link); ?>"><span class="fab fa-facebook"></span></a>
                <a href="<?php echo esc_url($linkedin_share_link); ?>"><span class="fab fa-pinterest-p"></span></a>
                <a href="<?php echo esc_url($linkedin_share_link); ?>"><span class="fab fa-linkedin"></span></a>
            </div>
        </div>
<?php
    }
endif;

if (!function_exists('treck_page_header_extra_class_callback')) :
    function treck_page_header_extra_class_callback($class)
    {
        return '';
    }
endif;
add_filter('treck_page_header_extra_class', 'treck_page_header_extra_class_callback', 10, 1);

if (!function_exists('treck_get_page_by_title')) {
    function treck_get_page_by_title($title, $post_type = 'page')
    {
        $posts = get_posts(
            array(
                'post_type'              => $post_type,
                'title'                  => $title,
                'post_status'            => 'all',
                'numberposts'            => 1,
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false,
                'orderby'                => 'post_date ID',
                'order'                  => 'ASC',
            )
        );

        if (!empty($posts)) {
            return $posts[0];
        } else {
            return null;
        }
    }
}
