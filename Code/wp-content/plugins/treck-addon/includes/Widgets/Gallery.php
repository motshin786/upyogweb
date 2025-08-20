<?php

namespace Layerdrops\Treck\Widgets;


class Gallery extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-gallery-slider';
    }

    public function get_title()
    {
        return __('Gallery', 'treck-addon');
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
                    // 'layout_four' => __('Layout Four', 'treck-addon'),
                    // 'layout_five' => __('Layout Five', 'treck-addon'),
                ]
            ]
        );

        $this->end_controls_section();

        include treck_get_elementor_option('gallery-one-option.php');
        include treck_get_elementor_option('gallery-two-option.php');
        include treck_get_elementor_option('gallery-three-option.php');
        // include treck_get_elementor_option('gallery-four-option.php');
        // include treck_get_elementor_option('gallery-five-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .gallery-two .section-title__title', ['layout_two']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_two']);

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .gallery-one__title a,{{WRAPPER}} .gallery-two__title a,{{WRAPPER}} .gallery-three__title h3', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Sub Title', '{{WRAPPER}} .gallery-one__sub-title,{{WRAPPER}} .gallery-two__sub-title', ['layout_one', 'layout_two']);

        $this->end_controls_section();

        treck_get_elementor_carousel_options($this, ['layout_one', 'layout_three']);
        treck_elementor_column_count_options($this, ['layout_two']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('gallery-one.php');
        include treck_get_template('gallery-two.php');
        include treck_get_template('gallery-three.php');
        // include treck_get_template('gallery-four.php');
        // include treck_get_template('gallery-five.php');
    }
}
