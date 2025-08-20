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
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Title', 'h3', 'layout_one');


$this->add_control(
    'summary',
    [
        'label' => __('Summary', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Summary Text', 'treck-addon'),
        'default' => __('Default Text', 'treck-addon'),
    ]
);

$this->add_control(
    'search_placeholder',
    [
        'label' => __('Search placeholder', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Search Here', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Contact Now', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => true,
    ]
);

$this->add_control(
    'button_info_text',
    [
        'label' => __('Button Info Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Explain us everything you need?', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->end_controls_section();
