<?php

namespace Layerdrops\Treck\Widgets;


class HomeShowCase extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-home-showcase-box';
    }

    public function get_title()
    {
        return __('Home ShowCase', 'treck-addon');
    }

    public function get_icon()
    {
        return 'eicon-cogs';
    }

    public function get_categories()
    {
        return ['treck-category'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => __('Select Layout', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'layout_one',
                'options' => [
                    'layout_one' => __('Layout One', 'treck-addon'),
                ]
            ]
        );

        $megamenu_box_list = new \Elementor\Repeater();

        $megamenu_box_list->add_control(
            'heading',
            [
                'label' => __('Heading', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '2',
                'default' => wp_kses(__('Heading', 'treck-addon'), 'treck_allowed_tags'),
                'label_block' => true,
            ]
        );

        treck_elementor_heading_option($megamenu_box_list, 'Home Showcase Heading', 'h3', 'layout_one');

        $megamenu_box_list->add_control(
            'image',
            [
                'label' => __('Image', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $megamenu_box_list->add_control(
            'multi_page_title',
            [
                'label' => __('Multi Page Title', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '2',
                'default' => wp_kses(__('Multi Page', 'treck-addon'), 'treck_allowed_tags'),
                'label_block' => true,
            ]
        );

        $megamenu_box_list->add_control(
            'multi_page_url',
            [
                'label' => __('Url', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('#', 'treck-addon'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => true,
                ],
                'show_label' => false,
            ]
        );

        $megamenu_box_list->add_control(
            'one_page_title',
            [
                'label' => __('One Page Title', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '2',
                'default' => wp_kses(__('One Page', 'treck-addon'), 'treck_allowed_tags'),
                'label_block' => true,
            ]
        );

        $megamenu_box_list->add_control(
            'one_page_url',
            [
                'label' => __('Url', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('#', 'treck-addon'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => true,
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'megamenu_box_list',
            [
                'label' => __('Mega Menu List', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $megamenu_box_list->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ heading }}}',
            ]
        );


        $this->end_controls_section();

        //Content style
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Heading', '{{WRAPPER}} .home-showcase__title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Menu Title', '{{WRAPPER}} .home-showcase__buttons .thm-btn', ['layout_one']);
        treck_elementor_general_style_options($this, 'Menu Title Hover', '{{WRAPPER}} .home-showcase__buttons .thm-btn:hover', ['layout_one']);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('home-showcase-one.php');
    }
}
