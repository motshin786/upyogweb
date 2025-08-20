<?php

namespace Layerdrops\Treck\Widgets;


class Visa extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-visa';
    }

    public function get_title()
    {
        return __('Visa', 'treck-addon');
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
                    // 'layout_two' => __('Layout Two', 'treck-addon'),
                    // 'layout_three' => __('Layout Three', 'treck-addon'),
                ]
            ]
        );


        $this->end_controls_section();

        include treck_get_elementor_option('visa-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one', 'layout_two', 'layout_three']);

        treck_elementor_general_style_options($this, 'Visa Title', '{{WRAPPER}} .services-two__title a', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Visa Hover Title', '{{WRAPPER}} .services-two__hover-title a', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Visa Summary', '{{WRAPPER}} .services-two__text-1', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Visa Hover Summary', '{{WRAPPER}} .services-two__hover-text', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Visa Icon', '{{WRAPPER}} .services-two__hover-icon span', ['layout_one']);

        $this->end_controls_section();

        //treck_elementor_column_count_options($this, ['layout_one']);
        treck_get_elementor_carousel_options($this, ['layout_one']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('visa-one.php');
    }
}
