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
        'label' => __('Add Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('&copy; Layerdrops', 'treck-addon')
    ]
);

$this->end_controls_section();
