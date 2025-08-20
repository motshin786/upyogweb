<?php

$this->start_controls_section(
    'content_section_two',
    [
        'label' => __('Gallery Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);


$gallery_two = new \Elementor\Repeater();


$gallery_two->add_control(
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
    'gallery_list_two',
    [
        'label' => __('Gallery', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $gallery_two->get_controls(),
        'prevent_empty' => false,
    ]
);

$this->end_controls_section();
