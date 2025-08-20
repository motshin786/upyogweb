<?php

namespace Layerdrops\Treck\Widgets;


class SideBar extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-sidebar';
    }

    public function get_title()
    {
        return __('Sidebar', 'treck-addon');
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
                    'layout_four' => __('Layout Four', 'treck-addon'),
                    'layout_five' => __('Layout Five', 'treck-addon'),
                ]
            ]
        );


        $this->end_controls_section();

        include treck_get_elementor_option('sidebar-one-option.php');
        include treck_get_elementor_option('sidebar-two-option.php');
        include treck_get_elementor_option('sidebar-three-option.php');
        include treck_get_elementor_option('sidebar-four-option.php');
        include treck_get_elementor_option('sidebar-five-option.php');


        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .coaching-details__services li a,{{WRAPPER}} .banner-one__title,{{WRAPPER}} .countries-details__documents .content h3 a,{{WRAPPER}} .countries-details__services li a', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .banner-one__btn', '{{WRAPPER}} .banner-one__btn', ['layout_two']);
        treck_elementor_general_style_options($this, 'File Size', '{{WRAPPER}} .countries-details__documents .content p', ['layout_three']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        include treck_get_template('sidebar-one.php');
        include treck_get_template('sidebar-two.php');
        include treck_get_template('sidebar-three.php');
        include treck_get_template('sidebar-four.php');
        include treck_get_template('sidebar-five.php');
    }
}
