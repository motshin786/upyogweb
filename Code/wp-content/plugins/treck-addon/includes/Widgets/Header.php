<?php

namespace Layerdrops\Treck\Widgets;


class Header extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-header';
    }

    public function get_title()
    {
        return __('Header', 'treck-addon');
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
            'layout_section',
            [
                'label' => __('Layout Type', 'treck-addon'),
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
                    'layout_two' => __('Layout Two', 'treck-addon'),
                    'layout_three' => __('Layout Three', 'treck-addon'),
                ]
            ]
        );

        $this->end_controls_section();

        include treck_get_elementor_option('header-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Font Options', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Menu', '{{WRAPPER}} .main-menu .main-menu__list > li > a,{{WRAPPER}} .main-menu .main-menu__list > li > ul > li > a', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Top Bar', '{{WRAPPER}} .main-menu__contact-list li .text p,{{WRAPPER}} .main-header-two__contact-list li .text p,{{WRAPPER}} .main-menu-three__contact-list li .text p,{{WRAPPER}} .main-menu-three__contact-list li .text p a', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Top Bar Icon', '{{WRAPPER}} .main-menu__contact-list li .icon i,{{WRAPPER}} .main-header-two__contact-list li .icon i,{{WRAPPER}} .main-menu-three__contact-list li .icon i', ['layout_one', 'layout_two', 'layout_three']);

        $this->end_controls_section();

        //button style
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_type' => ['layout_one', 'layout_two', 'layout_three']
                ]
            ]
        );

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn,{{WRAPPER}} .main-menu-three__btn a', '{{WRAPPER}} .thm-btn:before,{{WRAPPER}} .main-menu-three__btn a:before', ['layout_one', 'layout_two', 'layout_three']);

        $this->end_controls_section();

        //sticker style
        $this->start_controls_section(
            'news_sticker_style',
            [
                'label' => esc_html__('News Ticker Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_type' => 'layout_one'
                ]
            ]
        );

        treck_elementor_general_style_options($this, 'News Ticker Title', '{{WRAPPER}} .main-menu__update-text', ['layout_one', 'layout_two', 'layout_three']);

        $this->add_control(
            'news_ticker_background',
            [
                'label' => esc_html__('News Ticker Background', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu__update-box-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('header.php');
    }
}
