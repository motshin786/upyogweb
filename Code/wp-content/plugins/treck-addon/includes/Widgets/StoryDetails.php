<?php

namespace Layerdrops\Treck\Widgets;


class StoryDetails extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-story-details';
    }

    public function get_title()
    {
        return __('Story Details', 'treck-addon');
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

        include treck_get_elementor_option('story-details-one-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .story-details__title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .story-details__text-1, {{WRAPPER}} .story-details__text-2', ['layout_one']);

        treck_elementor_general_style_options($this, 'Info Title', '{{WRAPPER}} .story-details__list li', ['layout_one']);
        treck_elementor_general_style_options($this, 'Info Text', '{{WRAPPER}} .story-details__list li span', ['layout_one']);
        treck_elementor_general_style_options($this, 'Client Name', '{{WRAPPER}} .story-details__client-name h3', ['layout_one']);

        $this->end_controls_section();

        //button style
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_button_style_options($this, 'Button One', '{{WRAPPER}} .story-details__btn-one', '{{WRAPPER}} .story-details__btn-one::before', ['layout_one']);
        treck_elementor_button_style_options($this, 'Button Two', '{{WRAPPER}} .story-details__btn-two', '{{WRAPPER}} .story-details__btn-two::before', ['layout_one']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('story-one.php');
    }
}
