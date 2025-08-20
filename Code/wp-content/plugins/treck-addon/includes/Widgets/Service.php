<?php

namespace Layerdrops\Treck\Widgets;


class Service extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-service';
    }

    public function get_title()
    {
        return __('Service', 'treck-addon');
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
                    'layout_six' => __('Layout Six', 'treck-addon'),
                    'layout_seven' => __('Layout Seven', 'treck-addon'),
                    'layout_eight' => __('Layout Eight', 'treck-addon'),
                    'layout_nine' => __('Layout Nine', 'treck-addon'),
                ]
            ]
        );


        $this->end_controls_section();

        include treck_get_elementor_option('service-one-option.php');
        include treck_get_elementor_option('service-two-option.php');
        include treck_get_elementor_option('service-three-option.php');
        include treck_get_elementor_option('service-four-option.php');
        include treck_get_elementor_option('service-five-option.php');
        include treck_get_elementor_option('service-six-option.php');
        include treck_get_elementor_option('service-seven-option.php');
        include treck_get_elementor_option('service-eight-option.php');
        include treck_get_elementor_option('service-nine-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_seven', 'layout_nine']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_seven', 'layout_nine']);
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .coaching-one__right, {{WRAPPER}} .services-three__top-text',  ['layout_two', 'layout_four']);

        treck_elementor_general_style_options($this, 'Service Title', '{{WRAPPER}} .services-one__title a,{{WRAPPER}} .coaching-one__title a,{{WRAPPER}} .coaching-two__title a,{{WRAPPER}} .services-three__title a,{{WRAPPER}} .coaching-three__title a', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven', 'layout_eight', 'layout_nine']);
        treck_elementor_general_style_options($this, 'Service Hover Title', '{{WRAPPER}} .services-one__hover-title a, .coaching-one__hover-title a', ['layout_one', 'layout_two', 'layout_seven']);
        treck_elementor_general_style_options($this, 'Service Summary', '{{WRAPPER}} .services-one__text,{{WRAPPER}} .coaching-one__hover-text,{{WRAPPER}} .coaching-two__text,{{WRAPPER}} .services-three__text,{{WRAPPER}} .coaching-three__text', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven', 'layout_eight', 'layout_nine']);
        treck_elementor_general_style_options($this, 'Tag Line', '{{WRAPPER}} .coaching-three__hover p,{{WRAPPER}} .coaching-three__img-content p ', ['layout_five', 'layout_six']);
        treck_elementor_general_style_options($this, 'Service Icon', '{{WRAPPER}} .services-one__icon span', ['layout_one']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one']);

        treck_get_elementor_carousel_options($this, ['layout_five']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('service-one.php');
        include treck_get_template('service-two.php');
        include treck_get_template('service-three.php');
        include treck_get_template('service-four.php');
        include treck_get_template('service-five.php');
        include treck_get_template('service-six.php');
        include treck_get_template('service-seven.php');
        include treck_get_template('service-eight.php');
        include treck_get_template('service-nine.php');
    }
}
