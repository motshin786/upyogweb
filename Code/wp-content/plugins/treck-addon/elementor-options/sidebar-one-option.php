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

$sidebar_nav = new \Elementor\Repeater();

$sidebar_nav->add_control(
    'name',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Citizenship Test', 'treck-addon'),
        'label_block' => true,
    ]
);

$sidebar_nav->add_control(
    'button_url',
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
        'show_label' => false,
    ]
);

$sidebar_nav->add_control(
    'active_status',
    [
        'label' => __('Is active?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'no',
    ]
);

$this->add_control(
    'sidebar_nav',
    [
        'label' => __('Sidebar Nav', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $sidebar_nav->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);

$this->end_controls_section();
