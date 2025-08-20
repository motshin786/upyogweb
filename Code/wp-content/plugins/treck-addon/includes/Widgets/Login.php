<?php

namespace Layerdrops\Treck\Widgets;


class Login extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-login';
    }

    public function get_title()
    {
        return __('Login', 'treck-addon');
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


        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout_type' => 'layout_one'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Login ', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'user_name_placeholder',
            [
                'label' => __('Placeholder for username', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Username or Email Address* ', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'password_placeholder',
            [
                'label' => __('Placeholder for Password', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Password* ', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'remember_me_text',
            [
                'label' => __('Remember Me Text', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Remember Me?', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'login_btn_text',
            [
                'label' => __('Login Button Text', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Login', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'forget_text',
            [
                'label' => __('Forgot Password Text', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Forgot your Password?', 'treck-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'forget_url',
            [
                'label' => __('Forgot Password Url', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('#', 'treck-addon'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => true,
                ],
                'show_label' => false,
            ]
        );

        $this->end_controls_section();

        //style
        $this->start_controls_section(
            'style_options',
            [
                'label' => esc_html__('Style Options', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Title', '{{WRAPPER}} .login-page__title', ['layout_one']);
        treck_elementor_general_style_options($this, 'Remember Me', '{{WRAPPER}} .login-page__form .checked-box label', ['layout_one']);
        treck_elementor_general_style_options($this, 'Forgot Password', '{{WRAPPER}} .login-page__form-forgot-password a', ['layout_one']);

        treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn', '{{WRAPPER}} .thm-btn::before', ['layout_one']);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('login-one.php');
    }
}
