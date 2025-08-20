<?php

//content
$this->start_controls_section(
    'content_one',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);


$this->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Content', 'treck-addon'),
        'default' => __('Default Content', 'treck-addon'),
    ]
);


$this->add_control(
    'call_text',
    [
        'label' => __('Call Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Text', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'call_number',
    [
        'label' => __('Call Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Number', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'call_url',
    [
        'label' => __('Call Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Url', 'treck-addon'),
        'label_block' => true,
        'default' => '#'
    ]
);

$this->add_control(
    'call_icon_image',
    [
        'label' => __('Call Icon Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$images = new \Elementor\Repeater();

$images->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'images',
    [
        'label' => __('Images', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $images->get_controls(),
        'prevent_empty' => false,
    ]
);

$this->add_control(
    'bg_shape',
    [
        'label' => __('Background Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->end_controls_section();
