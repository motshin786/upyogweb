<?php

namespace Layerdrops\Treck\Widgets;


class Steps extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-step';
    }

    public function get_title()
    {
        return __('Step', 'treck-addon');
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

        include treck_get_elementor_option('step-one-option.php');

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

        treck_elementor_general_style_options($this, 'Step Title', '{{WRAPPER}} .process-one__title a', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Step Text', '{{WRAPPER}} .process-one__text', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Tag Line', '{{WRAPPER}} .process-one__step p, {{WRAPPER}} .process-one__count:before', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Step Icon', '{{WRAPPER}} .process-one__icon span', ['layout_one']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('step-one.php');
    }
}
