<?php

namespace Layerdrops\Treck;

class Customizer
{
    public function __construct()
    {
        add_action("customize_register", [$this, 'treck_customizer']);
    }
    public function treck_customizer($wp_customize)
    {

        // add panel
        $wp_customize->add_panel(
            'treck_theme_opt',
            array(
                'title'      => esc_html__('Treck Options', 'treck-addon'),
                'description' => esc_html__('Treck Theme options panel', 'treck-addon'),
                'priority'   => 220,
                'capability' => 'edit_theme_options',
            )
        );

        // General Settings
        $wp_customize->add_section('treck_theme_general', array(
            'title' => __('General Settings', 'treck-addon'),
            'description' => esc_html__('Treck General Settings.', 'treck-addon'),
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));


        $this->customize_type_color(
            $wp_customize,
            esc_html__('Select Theme Base color', 'treck-addon'),
            'treck_theme_general',
            'theme_base_color',
            '#e20935'
        );

        $this->customize_type_color(
            $wp_customize,
            esc_html__('Select Theme Primary color', 'treck-addon'),
            'treck_theme_general',
            'theme_primary_color',
            '#f2edeb'
        );

        $this->customize_type_color(
            $wp_customize,
            esc_html__('Select Theme Black color', 'treck-addon'),
            'treck_theme_general',
            'theme_black_color',
            '#16171a'
        );


        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Dark Mode?', 'treck-addon'),
            'treck_theme_general',
            'treck_dark_mode',
            'no',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Boxed Mode?', 'treck-addon'),
            'treck_theme_general',
            'treck_boxed_mode',
            'no',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Rtl Mode?', 'treck-addon'),
            'treck_theme_general',
            'treck_rtl_mode',
            'no',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Custom Cursor', 'treck-addon'),
            'treck_theme_general',
            'custom_cursor',
            'yes',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Back to top?', 'treck-addon'),
            'treck_theme_general',
            'scroll_to_top',
            'yes',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_select(
            $wp_customize,
            esc_html__('Select Back to top icon', 'treck-addon'),
            'treck_theme_general',
            'scroll_to_top_icon',
            'fa-angle-up',
            treck_get_fa_icons(),
            function () {
                return (get_theme_mod('scroll_to_top', 'no') == 'yes' ? true : false);
            }
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Preloader?', 'treck-addon'),
            'treck_theme_general',
            'preloader',
            'yes',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_image(
            $wp_customize,
            esc_html__('Custom Preloader Image', 'treck-addon'),
            'treck_theme_general',
            'preloader_image',
            '',
            function () {
                return (get_theme_mod('preloader', 'no') == 'yes' ? true : false);
            }
        );

        $this->customize_type_image(
            $wp_customize,
            esc_html__('Page Header Background Image', 'treck-addon'),
            'treck_theme_general',
            'page_header_bg_image'
        );

        $this->customize_type_image(
            $wp_customize,
            esc_html__('404 Image', 'treck-addon'),
            'treck_theme_general',
            'error_image'
        );

        $this->customize_type_image(
            $wp_customize,
            esc_html__('404 Background Image', 'treck-addon'),
            'treck_theme_general',
            'error_bg_image'
        );

        $this->customize_type_image(
            $wp_customize,
            esc_html__('404 Shape', 'treck-addon'),
            'treck_theme_general',
            'error_page_shape'
        );

        // Blog Layout
        $wp_customize->add_section('treck_blog_layout_settings', array(
            'title' => __('Blog Layout', 'treck-addon'),
            'description' => esc_html__('Treck Blog Layout', 'treck-addon'),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));

        $this->customize_type_select(
            $wp_customize,
            'Select Sidebar position',
            'treck_blog_layout_settings',
            'treck_blog_layout',
            'right-align',
            array(
                'left-align' => esc_html__('Left Align', 'treck-addon'),
                'right-align' => esc_html__('Right Align', 'treck-addon'),
            )
        );

        // Header options
        $wp_customize->add_section('treck_theme_header', array(
            'title' => __('Header Settings', 'treck-addon'),
            'description' => esc_html__('Treck Header Settings', 'treck-addon'),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Add Logo size in px', 'treck-addon'),
            'treck_theme_header',
            'header_logo_width',
            esc_html(198)
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__('Enable Sticky Header?', 'treck-addon'),
            'treck_theme_header',
            'header_sticky_menu',
            'yes',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__(' Enable Breadcrumb?', 'treck-addon'),
            'treck_theme_header',
            'breadcrumb_opt',
            'yes',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__('Enable Custom Header?', 'treck-addon'),
            'treck_theme_header',
            'header_custom',
            'no',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_select(
            $wp_customize,
            esc_html__('Select Header Type', 'treck-addon'),
            'treck_theme_header',
            'header_custom_post',
            '',
            treck_post_query('header'),
            function () {
                return (get_theme_mod('header_custom', 'no') == 'yes' ? true : false);
            }
        );

        //  Mobile Menu
        $wp_customize->add_section('treck_theme_mobile_menu', array(
            'title' => esc_html__('Mobile Menu Settings', 'treck-addon'),
            'description' => esc_html__('Treck Header Settings', 'treck-addon'),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Mobile Menu Email', 'treck-addon'),
            'treck_theme_mobile_menu',
            'treck_mobile_menu_email',
            esc_html__('needhelp@treck.com', 'treck-addon')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Mobile Menu Phone', 'treck-addon'),
            'treck_theme_mobile_menu',
            'treck_mobile_menu_phone',
            esc_html__('666 888 0000', 'treck-addon')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Facebook url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'facebook_url',
            esc_html('#')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Twitter url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'twitter_url',
            esc_html('#')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Linkedin url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'linkedin_url',
            esc_html('#')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Pinterest url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'pinterest_url',
            esc_html('#')
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Youtube url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'youtube_url',
        );


        $this->customize_type_text(
            $wp_customize,
            esc_html__('dribbble url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'dribble_url',
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Instagram url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'instagram_url',
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Reddit url', 'treck-addon'),
            'treck_theme_mobile_menu',
            'reddit_url',
        );

        // Footer options
        $wp_customize->add_section('treck_theme_footer', array(
            'title' => esc_html__('Footer Settings', 'treck-addon'),
            'description' => esc_html__('Treck Footer Settings.', 'treck-addon'),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Footer Text', 'treck-addon'),
            'treck_theme_footer',
            'footer_copytext',
            esc_html__('&copy; All right reserved', 'treck'),
            function () {
                return (get_theme_mod('footer_custom', 'no') == 'yes' ? false : true);
            }
        );

        $this->customize_type_radio(
            $wp_customize,
            esc_html__('Enable Custom Footer ?', 'treck-addon'),
            'treck_theme_footer',
            'footer_custom',
            'no',
            array(
                'yes' => esc_html__('Yes', 'treck-addon'),
                'no' => esc_html__('No', 'treck-addon'),
            )
        );

        $this->customize_type_select(
            $wp_customize,
            esc_html__('Select Footer Type', 'treck-addon'),
            'treck_theme_footer',
            'footer_custom_post',
            '',
            treck_post_query('footer'),
            function () {
                return (get_theme_mod('footer_custom', 'no') == 'yes' ? true : false);
            }
        );

        // register
        $wp_customize->add_section('treck_login_settings', array(
            'title' => __('Login/Register Settings', 'treck-addon'),
            'description' => esc_html__('Login/Register Settings', 'treck-addon'),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel'      => 'treck_theme_opt'
        ));

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Redirect url After Login', 'treck-addon'),
            'treck_login_settings',
            'login_redirect_url',
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Redirect url After Registration', 'treck-addon'),
            'treck_login_settings',
            'registration_redirect_url',
        );

        $this->customize_type_text(
            $wp_customize,
            esc_html__('Redirect url After Log Out', 'treck-addon'),
            'treck_login_settings',
            'logout_redirect_url',
        );
    }

    //type text
    public function customize_type_text($wp_customize, $label, $section_id, $name,  $default = "", $callback = null)
    {
        // add settings
        $wp_customize->add_setting($name, array(
            'default'  => $default,
            'type'     => 'theme_mod'
        ));

        $wp_customize->add_control(new \WP_Customize_Control(
            $wp_customize,
            $name,
            array(
                "label" => $label,
                "section" => $section_id,
                "settings" => $name,
                "type" => "text",
                "active_callback" => $callback,
            )
        ));
    }


    //type color
    public function customize_type_color($wp_customize, $label, $section_id, $name,  $default)
    {
        // add settings
        $wp_customize->add_setting($name, array(
            'default'  => sanitize_hex_color($default),
            'type'     => 'theme_mod'
        ));

        // Add control
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, $name, array(
            'label'    => $label,
            'section'  => $section_id,
            'setting' => $name,
            'priority' => 1
        )));
    }

    // type checkbox
    public function customize_type_checkbox($wp_customize, $label, $section_id, $name,  $default, $callback = null)
    {
        $wp_customize->add_setting($name, array(
            "default" => $default,
            "transport" => "refresh",

        ));

        $wp_customize->add_control(new \WP_Customize_Control(
            $wp_customize,
            $name,
            array(
                "label" => $label,
                "section" => $section_id,
                "settings" => $name,
                "type" => "checkbox",
                "active_callback" => $callback,
            )
        ));
    }

    // type Image
    public function customize_type_image($wp_customize, $label, $section_id, $name,  $default = '', $callback = null)
    {
        $wp_customize->add_setting($name, array(
            "default" => $default,
            "transport" => "refresh",

        ));

        $wp_customize->add_control(new \WP_Customize_Upload_Control($wp_customize, $name, array(
            'label'    => $label,
            'section'  => $section_id,
            'setting' => $name,
            'priority' => 20,
            "active_callback" => $callback,
        )));
    }

    public function customize_type_select($wp_customize, $label, $section_id, $name,  $default, $select_value,  $callback = null)
    {
        $wp_customize->add_setting($name, array(
            'default'     => $default,
            "transport" => "refresh",

        ));

        $wp_customize->add_control(new \WP_Customize_Control(
            $wp_customize,
            $name,
            array(
                "label" => $label,
                "section" => $section_id,
                "settings" => $name,
                "type" => "select",
                'choices'     => $select_value,
                "active_callback" => $callback,
            )
        ));
    }

    public function customize_type_radio($wp_customize, $label, $section_id, $name,  $default, $radio_value, $callback = null)
    {
        $wp_customize->add_setting($name, array(
            'default'     => $default,
            "transport" => "refresh",

        ));

        $wp_customize->add_control(new \WP_Customize_Control(
            $wp_customize,
            $name,
            array(
                "label" => $label,
                "section" => $section_id,
                "settings" => $name,
                "type" => "radio",
                'choices'     => $radio_value,
                "active_callback" => $callback,
            )
        ));
    }
}
