<?php

namespace Layerdrops\Treck\Widgets;


class Testimonials extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-testimonials';
    }

    public function get_title()
    {
        return __('Testimonials', 'treck-addon');
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

        include treck_get_elementor_option('testimonial-one-option.php');
        include treck_get_elementor_option('testimonial-two-option.php');
        include treck_get_elementor_option('testimonial-three-option.php');
        include treck_get_elementor_option('testimonial-four-option.php');
        include treck_get_elementor_option('testimonial-five-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_two']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_two']);
        treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .testimonial-two__right-text', ['layout_two']);

        treck_elementor_general_style_options($this, 'Name', '{{WRAPPER}} .testimonial-one__client-name,{{WRAPPER}} .testimonial-two__client-name a,{{WRAPPER}} .testimonial-three__client-name', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
        treck_elementor_general_style_options($this, 'Designation', '{{WRAPPER}} .testimonial-one__client-title,{{WRAPPER}} .testimonial-one__client-sub-title, {{WRAPPER}} .testimonial-two__client-sub-title,{{WRAPPER}} .testimonial-three__client-sub-title', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
        treck_elementor_general_style_options($this, 'Content', '{{WRAPPER}} .testimonial-one__text, {{WRAPPER}} .testimonial-two__text,{{WRAPPER}} .testimonial-three__text', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);

        $this->end_controls_section();

        //Features style
        $this->start_controls_section(
            'features_style',
            [
                'label' => esc_html__('Features Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_type' => 'layout_three'
                ]
            ]
        );

        treck_elementor_general_style_options($this, 'Features Title', '{{WRAPPER}} .testimonial-three__counter-content-box p', ['layout_three']);
        treck_elementor_general_style_options($this, 'Features Count', '{{WRAPPER}} .testimonial-three__counter-count-box h3,{{WRAPPER}} .testimonial-three__counter-plus', ['layout_three']);

        $this->end_controls_section();

        treck_get_elementor_carousel_options($this, ['layout_one', 'layout_two', 'layout_five']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('testimonials-one.php');
        include treck_get_template('testimonials-two.php');
        include treck_get_template('testimonials-three.php');
        include treck_get_template('testimonials-four.php');
        include treck_get_template('testimonials-five.php');
    }
}
