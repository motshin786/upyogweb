<?php

namespace Layerdrops\Treck\Widgets;


class ImageBox extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-image-box';
    }

    public function get_title()
    {
        return __('Image Box', 'treck-addon');
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

        include treck_get_elementor_option('image-box-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} h3.coaching-details__benefit-title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Highlighted Text', '{{WRAPPER}} .coaching-details__benefit-text', ['layout_one']);
        treck_elementor_general_style_options($this, 'Check List', '{{WRAPPER}} .coaching-details__benefit-points li .text p', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('image-box-one.php');
    }
}
