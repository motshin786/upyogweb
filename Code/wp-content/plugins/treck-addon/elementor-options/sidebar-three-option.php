<?php

$this->start_controls_section(
    'layout_three_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);


$this->add_control(
    'layout_three_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Title', 'h3', 'layout_three');


$this->add_control(
    'layout_three_file_size',
    [
        'label' => __('File Size', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('3.9KB', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_three_file_url',
    [
        'label' => __('File Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('#', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_three_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-pdf-file',
            'library' => 'custom-icon',
        ],
    ]
);

$this->end_controls_section();
