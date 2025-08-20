<?php

namespace Layerdrops\Treck\Widgets;


class ContactForm extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-contact-form';
    }

    public function get_title()
    {
        return __('Contact Form', 'treck-addon');
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

        include treck_get_elementor_option('contact-form-one-option.php');
        include treck_get_elementor_option('contact-form-two-option.php');
        include treck_get_elementor_option('contact-form-three-option.php');
        include treck_get_elementor_option('contact-form-four-option.php');
        include treck_get_elementor_option('contact-form-five-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five']);

        treck_elementor_general_style_options($this, 'Contact Form Title', '{{WRAPPER}} .contact-three__form-top p', ['layout_three']);

        treck_elementor_general_style_options($this, 'Faq Heading', '{{WRAPPER}} .contact-one__address-top-title h3,{{WRAPPER}} .contact-two__address-top-title h3', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Faq Title', '{{WRAPPER}} .contact-one__address-faq .faq-one-accrodion .accrodion-title h4,{{WRAPPER}} .contact-two__address-faq .faq-one-accrodion .accrodion-title h4', ['layout_one', 'layout_two']);
        treck_elementor_general_style_options($this, 'Faq Content', '{{WRAPPER}} .contact-one__address-list li .text p,{{WRAPPER}} .contact-two__address-list li .text p,{{WRAPPER}} .contact-two__address-list li .text p a', ['layout_one', 'layout_two']);

        $this->end_controls_section();

        //button style
        $this->start_controls_section(
            'tab_style',
            [
                'label' => esc_html__('Tab Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_type' => 'layout_three'
                ]
            ]
        );

        treck_elementor_general_style_options($this, 'Tab Text', '{{WRAPPER}} .contact-three__tab-content-text', ['layout_three']);
        treck_elementor_general_style_options($this, 'Info Text', '{{WRAPPER}} .contact-three__contact-list li .text p, {{WRAPPER}} .contact-three__contact-list li .text p a', ['layout_three']);

        treck_elementor_button_style_options($this, 'Tab Button', '{{WRAPPER}} .contact-three__main-tab-box .tab-buttons .tab-btn span', '{{WRAPPER}} .contact-three__main-tab-box .tab-buttons .tab-btn span', ['layout_three']);
        treck_elementor_button_style_options($this, 'Tab Active Button', '{{WRAPPER}} .contact-three__main-tab-box .tab-buttons .tab-btn span', '{{WRAPPER}} .contact-three__main-tab-box .tab-buttons .tab-btn span:before,{{WRAPPER}} .contact-three__main-tab-box .tab-buttons .tab-btn span:after ', ['layout_one', 'layout_two', 'layout_three']);

        $this->end_controls_section();

        //button style
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_type' => ['layout_one', 'layout_two']
                ]
            ]
        );

        treck_elementor_button_style_options($this, 'Contact Info Icon', '{{WRAPPER}} .contact-one__points li .icon span,{{WRAPPER}} .contact-two__call-icon', '{{WRAPPER}} .contact-one__points li .icon span:hover,{{WRAPPER}} .contact-two__call-icon:hover', ['layout_one', 'layout_three']);
        treck_elementor_button_style_options($this, 'Contact Button', '{{WRAPPER}} .thm-btn', '{{WRAPPER}} .thm-btn:before', ['layout_one', 'layout_two', 'layout_three']);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('contact-form-one.php');
        include treck_get_template('contact-form-two.php');
        include treck_get_template('contact-form-three.php');
        include treck_get_template('contact-form-four.php');
        include treck_get_template('contact-form-five.php');
    }
}
