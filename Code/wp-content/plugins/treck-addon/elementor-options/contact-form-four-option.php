<?php

$this->start_controls_section(
    'layout_four_contact_form',
    [
        'label' => __('Contact Form', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_four'
        ]
    ]
);

$this->add_control(
    'layout_four_sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_four');


$this->add_control(
    'layout_four_sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_four');

$this->add_control(
    'layout_four_select_wpcf7_form',
    [
        'label'       => esc_html__('Select your contact form 7', 'treck-addon'),
        'label_block' => true,
        'type'        => \Elementor\Controls_Manager::SELECT,
        'options'     => treck_post_query('wpcf7_contact_form'),
    ]
);

$this->add_control(
    'layout_four_shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_four_shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
