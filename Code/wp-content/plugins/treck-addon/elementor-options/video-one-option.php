<?php

$this->start_controls_section(
    'layout_one_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$this->add_control(
    'sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');

$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

$check_list = new \Elementor\Repeater();

$check_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
    ]
);


$check_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-check',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'check_list',
    [
        'label' => __('Check list', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $check_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'video_text',
    [
        'label' => __('Video Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Video Text', 'treck-addon'),
        'default' => __('Default Video Text', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_one_video_url',
    [
        'label' => __('Video Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Url', 'treck-addon'),
        'default' => __('#', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_one_bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_one_shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
