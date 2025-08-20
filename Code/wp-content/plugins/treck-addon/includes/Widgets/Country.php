<?php

namespace Layerdrops\Treck\Widgets;


class Country extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-country';
    }

    public function get_title()
    {
        return __('Country', 'treck-addon');
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
                    'layout_four' => __('Layout Four', 'treck-addon'),
                ]
            ]
        );


        $this->end_controls_section();

        include treck_get_elementor_option('country-one-option.php');
        include treck_get_elementor_option('country-two-option.php');
        include treck_get_elementor_option('country-three-option.php');
        include treck_get_elementor_option('country-four-option.php');

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

        treck_elementor_general_style_options($this, 'Country Title', '{{WRAPPER}} .countries-one__title a,{{WRAPPER}} .countries-two__name h3 a,{{WRAPPER}} .countries-three__title', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
        treck_elementor_general_style_options($this, 'Country Summary', '{{WRAPPER}} .countries-one__text,{{WRAPPER}} .countries-three__text', ['layout_one', 'layout_three', 'layout_four']);
        treck_elementor_general_style_options($this, 'Country Content', '{{WRAPPER}} .countries-two__points li .text p', ['layout_two']);

        treck_elementor_general_style_options($this, 'Bottom Content', '{{WRAPPER}} .countries-three__bottom-text', ['layout_three']);
        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .countries-three__btn', '{{WRAPPER}} .countries-three__btn:before', ['layout_three']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one']);
        treck_get_elementor_carousel_options($this, ['layout_two']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('country-one.php');
        include treck_get_template('country-two.php');
        include treck_get_template('country-three.php');
        include treck_get_template('country-four.php');
    }
}
