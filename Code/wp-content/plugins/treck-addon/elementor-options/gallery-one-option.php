<?php

$this->start_controls_section(
    'content_section',
    [
        'label' => __('Gallery Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$gallery = new \Elementor\Repeater();

$gallery->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'images',
    [
        'label' => __('Gallery', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $gallery->get_controls(),
        'prevent_empty' => false,
        'default' => [],
    ]
);

$this->end_controls_section();
