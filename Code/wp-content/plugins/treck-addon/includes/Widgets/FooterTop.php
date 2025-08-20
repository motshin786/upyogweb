<?php

namespace Layerdrops\Treck\Widgets;


class FooterTop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-footer-top';
    }

    public function get_title()
    {
        return __('Footer Top', 'treck-addon');
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

        include treck_get_elementor_option('footer-top-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Style Options', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Content', '{{WRAPPER}} .site-footer__visa-text', ['layout_one']);
        treck_elementor_general_style_options($this, 'Call Text', '{{WRAPPER}} .site-footer__call-sub-title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Call Number', '{{WRAPPER}} .site-footer__call-number a', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('footer-top-one.php');
    }
}
