<?php

namespace Layerdrops\Treck\Widgets;


class OfficeLocation extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-office-location';
    }

    public function get_title()
    {
        return __('Office Location', 'treck-addon');
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

        include treck_get_elementor_option('office-location-one-option.php');

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
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} p.ocation-one__top-text', ['layout_one']);

        treck_elementor_general_style_options($this, 'Contact Info Title', '{{WRAPPER}} .location-one__tab-content-contact-title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Contact Info', '{{WRAPPER}} .location-one__tab-content-contact-list li .content p, {{WRAPPER}} .location-one__tab-content-contact-list li .content p a', ['layout_one']);
        treck_elementor_general_style_options($this, 'Office Day', '{{WRAPPER}} .location-one__tab-content-day-name', ['layout_one']);
        treck_elementor_general_style_options($this, 'Office Time ', '{{WRAPPER}} .location-one__tab-content-time-box', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('office-location-one.php');
    }
}
