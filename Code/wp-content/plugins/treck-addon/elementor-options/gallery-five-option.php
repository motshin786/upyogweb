<?php

$this->start_controls_section(
    'content_section_five',
    [
        'label' => __('Gallery Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_five'
        ]
    ]
);

$gallery_five = new \Elementor\Repeater();

$gallery_five->add_control(
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
    'gallery_list_five',
    [
        'label' => __('Gallery', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $gallery_five->get_controls(),
        'prevent_empty' => false,
    ]
);

$this->end_controls_section();
