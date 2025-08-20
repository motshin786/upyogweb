<?php

$this->start_controls_section(
    'layout_one_content',
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

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');

$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');

$team = new \Elementor\Repeater();

$team->add_control(
    'name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Aleesha Brown', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($team, 'Team Name', 'h3', 'layout_one');

$team->add_control(
    'designation',
    [
        'label' => __('Designation', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => __('Consultants', 'treck-addon'),
    ]
);

treck_elementor_heading_option($team, 'Team Designation', 'p', 'layout_one');

$team->add_control(
    'url',
    [
        'label' => __('Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => true,
        ],
        'show_label' => false,
    ]
);

$team->add_control(
    'social_network',
    [
        'label' => __('Social NetWork', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'label_block' => true,
        'default' => wp_kses('<li><a href="#"><i class="fab fa-facebook"></i></a></li>', 'treck_allowed_tags')
    ]
);


$team->add_control(
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
    'team_items',
    [
        'label' => __('Team', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $team->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ name }}}',
    ]
);

$this->end_controls_section();
