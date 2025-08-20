<?php

namespace Layerdrops\Treck\Widgets;


class Price extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-price';
    }

    public function get_title()
    {
        return __('Price', 'treck-addon');
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

        include treck_get_elementor_option('price-one-option.php');

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

        treck_elementor_general_style_options($this, 'Price Title', '{{WRAPPER}} .pricing-page__price-sub-title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Price', '{{WRAPPER}} .pricing-page__price', ['layout_one']);

        $this->end_controls_section();

        //General style
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn.pricing-page__btn', '{{WRAPPER}} .thm-btn.pricing-page__btn::before', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('price-one.php');
    }
}
