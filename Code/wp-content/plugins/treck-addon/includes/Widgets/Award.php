<?php

namespace Layerdrops\Treck\Widgets;


class Award extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-award';
    }

    public function get_title()
    {
        return __('Award', 'treck-addon');
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

        include treck_get_elementor_option('award-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one']);
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .awards-one__text', ['layout_one']);

        treck_elementor_general_style_options($this, 'Check List', '{{WRAPPER}} .awards-one__points li .text p', ['layout_one']);
        treck_elementor_general_style_options($this, 'Award Title', '{{WRAPPER}} .awards-one__title a', ['layout_one']);
        treck_elementor_general_style_options($this, 'Award Year Text', '{{WRAPPER}} .awards-one__year', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('award-one.php');
    }
}
