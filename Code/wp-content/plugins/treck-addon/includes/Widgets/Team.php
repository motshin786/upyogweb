<?php

namespace Layerdrops\Treck\Widgets;


class Team extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-team';
    }

    public function get_title()
    {
        return __('Team', 'treck-addon');
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

        include treck_get_elementor_option('team-one-option.php');
        include treck_get_elementor_option('team-two-option.php');
        include treck_get_elementor_option('team-three-option.php');

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

        treck_elementor_general_style_options($this, 'Name', '{{WRAPPER}} .team-one__title a,{{WRAPPER}} .team-details__name', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Designation', '{{WRAPPER}} .team-one__sub-title,{{WRAPPER}} .team-details__sub-title', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .team-details__text-1', ['layout_three']);
        treck_elementor_general_style_options($this, 'Highlighted Text', '{{WRAPPER}} .team-details__points-title', ['layout_three']);
        treck_elementor_general_style_options($this, 'Check List', '{{WRAPPER}} .team-details__points li .text p', ['layout_three']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one', 'layout_two']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('team-one.php');
        include treck_get_template('team-two.php');
        include treck_get_template('team-three.php');
    }
}
