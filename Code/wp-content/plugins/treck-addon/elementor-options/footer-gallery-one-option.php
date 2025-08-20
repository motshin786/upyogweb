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

$this->add_control(
    'title',
    [
        'label' => __('Add Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Gallery', 'treck-addon')
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h3', 'layout_one');

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
