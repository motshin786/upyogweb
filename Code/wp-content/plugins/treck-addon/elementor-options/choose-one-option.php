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
    'sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h3', 'layout_one');

$this->add_control(
    'video_url',
    [
        'label' => __('Video Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => true,
        'default' => [
            'url' => '#',
            'is_external' => true,
            'nofollow' => true,
        ],
        'show_label' => true,
    ]
);

$check_list_one = new \Elementor\Repeater();

$check_list_one->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
    ]
);

$check_list_one->add_control(
    'icon',
    [
        'label' => __('Check Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'font-awesome',
        ],
    ]
);

$this->add_control(
    'check_list_one',
    [
        'label' => __('Check List One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $check_list_one->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'choose_layout_one_divider',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$check_list_two = new \Elementor\Repeater();

$check_list_two->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
    ]
);

$check_list_two->add_control(
    'icon',
    [
        'label' => __('Check Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'font-awesome',
        ],
    ]
);

$this->add_control(
    'check_list_two',
    [
        'label' => __('Check List Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $check_list_two->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'choose_bg_image_one',
    [
        'label' => __('Background Image One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'choose_bg_image_two',
    [
        'label' => __('Background Image Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'choose_bg_shape_one',
    [
        'label' => __('Background Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->end_controls_section();
