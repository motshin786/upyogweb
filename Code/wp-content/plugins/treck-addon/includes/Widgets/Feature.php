<?php

namespace Layerdrops\Treck\Widgets;


class Feature  extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-feature';
    }

    public function get_title()
    {
        return __('Feature', 'treck-addon');
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
                ]
            ]
        );

        $this->end_controls_section();

        include treck_get_elementor_option('feature-one-option.php');
        include treck_get_elementor_option('feature-two-option.php');
        include treck_get_elementor_option('feature-three-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .feature-one__title a,{{WRAPPER}} .feature-two__title a', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Sub Title', '{{WRAPPER}} .feature-one__sub-title,{{WRAPPER}} .feature-two__sub-title', ['layout_one', 'layout_two']);
        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .feature-one__btn', '{{WRAPPER}} .feature-one__btn', ['layout_one']);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('feature-one.php');
        include treck_get_template('feature-two.php');
        include treck_get_template('feature-three.php');
    }
}
