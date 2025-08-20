<?php

namespace Layerdrops\Treck\Widgets;


class Counter extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-counter';
    }

    public function get_title()
    {
        return __('Counter', 'treck-addon');
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
                ]
            ]
        );

        $this->end_controls_section();

        include treck_get_elementor_option('counter-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .counter-one__content p', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Number', '{{WRAPPER}} .counter-one__count-box h3', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Sign', '{{WRAPPER}} .counter-two__plus', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Icon', '{{WRAPPER}} .counter-one__icon span', ['layout_one', 'layout_two']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one', 'layout_two']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('counter-one.php');
    }
}
