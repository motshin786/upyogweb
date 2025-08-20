<?php

$this->start_controls_section(
    'layout_two_content',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$team_list_two = new \Elementor\Repeater();

$team_list_two->add_control(
    'name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Aleesha Brown', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($team_list_two, 'Team Name', 'h3', 'layout_two');

$team_list_two->add_control(
    'designation',
    [
        'label' => __('Designation', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => __('Consultants', 'treck-addon'),
    ]
);

$team_list_two->add_control(
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

$team_list_two->add_control(
    'social_network',
    [
        'label' => __('Social NetWork', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'label_block' => true,
        'default' => wp_kses('<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>', 'treck_allowed_tags')
    ]
);


$team_list_two->add_control(
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
    'layout_two_team_item',
    [
        'label' => __('Team', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $team_list_two->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ name }}}',
    ]
);

$this->end_controls_section();
