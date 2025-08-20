<?php

namespace Layerdrops\Treck\Widgets;


class VisaOffer extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-visa-offer';
    }

    public function get_title()
    {
        return __('Visa Offer', 'treck-addon');
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

        include treck_get_elementor_option('visa-offer-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .visa-offers__title a', ['layout_one']);
        treck_elementor_general_style_options($this, 'Tag Line', '{{WRAPPER}} .visa-offers__sub-title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Content', '{{WRAPPER}} .visa-offers__points p', ['layout_one']);
        treck_elementor_general_style_options($this, 'Price', '{{WRAPPER}} .visa-offers__price p', ['layout_one']);
        treck_elementor_general_style_options($this, 'Price Text', '{{WRAPPER}} .visa-offers__price-start ', ['layout_one']);
        treck_elementor_general_style_options($this, 'Time', '{{WRAPPER}} .visa-offers__time p ', ['layout_one']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('visa-offer-one.php');
    }
}
