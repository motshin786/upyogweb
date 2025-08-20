<?php

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
        'label' => __('Widget Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Newsletter', 'treck-addon'),
        'label_block' => true
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h3', 'layout_one');

$this->add_control(
    'mailchimp_url',
    [
        'label' => __('Add Mailchimp URL', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '#',
        'label_block' => true
    ]
);

$this->add_control(
    'mc_input_placeholder',
    [
        'label' => __('Input Placeholder Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Email address', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'btn_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Button Label', 'treck-addon'),
        'label_block' => true
    ]
);

$this->end_controls_section();
