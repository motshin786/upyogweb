<?php

namespace Layerdrops\Treck\Widgets;


class MainSlider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-main-slider';
    }

    public function get_title()
    {
        return __('Main Slider', 'treck-addon');
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
                'label' => __('Layout', 'treck-addon'),
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

        include treck_get_elementor_option('main-slider-one-option.php');
        include treck_get_elementor_option('main-slider-two-option.php');
        include treck_get_elementor_option('main-slider-three-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .main-slider__title, {{WRAPPER}} .main-slider-two__title', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Features Title', '{{WRAPPER}} .main-slider__feature-title a', ['layout_two']);
        treck_elementor_general_style_options($this, 'Features Summary', '{{WRAPPER}} .main-slider__feature-text', ['layout_two']);

        treck_elementor_general_style_options($this, 'Icon', '{{WRAPPER}} .main-slider__feature-icon span', ['layout_two']);
        $this->end_controls_section();

        //button style
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn', '{{WRAPPER}} .thm-btn::before', ['layout_one', 'layout_two']);

        $this->end_controls_section();

        treck_get_elementor_carousel_options($this, ['layout_one', 'layout_two', 'layout_three']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('main-slider-one.php');
        include treck_get_template('main-slider-two.php');
        include treck_get_template('main-slider-three.php');
    }
}
