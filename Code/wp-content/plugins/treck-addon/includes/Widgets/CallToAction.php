<?php

namespace Layerdrops\Treck\Widgets;


class CallToAction extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-call-to-action';
    }

    public function get_title()
    {
        return __('Call To Action', 'treck-addon');
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
                ]
            ]
        );
        $this->end_controls_section();

        include treck_get_elementor_option('call-to-action-one-option.php');
        include treck_get_elementor_option('call-to-action-two-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .excellence-one__title,{{WRAPPER}} .coaching-details__importance-title', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Check List', '{{WRAPPER}} .coaching-details__importance-points-list li .text p', ['layout_two']);

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

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn,{{WRAPPER}} .coaching-details__importance-btn', '{{WRAPPER}} .thm-btn:before, {{WRAPPER}} .coaching-details__importance-btn', ['layout_one', 'layout_two']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('call-to-action-one.php');
        include treck_get_template('call-to-action-two.php');
    }
}
