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
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');


$availability_title_list = new \Elementor\Repeater();

$availability_title_list->add_control(
    'residance_title',
    [
        'label' => __('Residance Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Residance', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'room_title',
    [
        'label' => __('Room Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Room', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'bath_title',
    [
        'label' => __('Bath Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Bath', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'sq_fit_title',
    [
        'label' => __('Squre Fit Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('SQ.FT', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'floor_title',
    [
        'label' => __('Floor Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Floor', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'terrace_title',
    [
        'label' => __('Terrace Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Terrace', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_title_list->add_control(
    'plan_title',
    [
        'label' => __('Plan Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Plan', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'availability_title_list',
    [
        'label' => __('Availability Title List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $availability_title_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ residance_title }}}',
    ]
);

$this->add_control(
    'availability_title_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);


$availability_content_list = new \Elementor\Repeater();

$availability_content_list->add_control(
    'residance_content',
    [
        'label' => __('Residance Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Amazon', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'room_content',
    [
        'label' => __('Room Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('3', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'bath_content',
    [
        'label' => __('Bath Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('2', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'squre_fit_content',
    [
        'label' => __('Squre Fit Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('660', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'floor_content',
    [
        'label' => __('Floor Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('2', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'terrace_content',
    [
        'label' => __('Terrace Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('1', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('View Details', 'treck-addon'),
        'label_block' => true,
    ]
);

$availability_content_list->add_control(
    'url',
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
    'availability_content_list',
    [
        'label' => __('Availability Content List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $availability_content_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ residance_content }}}',
    ]
);


$this->add_control(
    'bac_image_one',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->end_controls_section();
