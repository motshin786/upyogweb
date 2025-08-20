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

$counter_list = new \Elementor\Repeater();

$counter_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
        'label_block' => true
    ]
);

$counter_list->add_control(
    'number',
    [
        'label' => __('Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'rows' => '2',
        'placeholder' => __('Add Number', 'treck-addon'),
        'default' => __('680', 'treck-addon'),
        'label_block' => true
    ]
);

$counter_list->add_control(
    'sign',
    [
        'label' => __('Sign', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'rows' => '2',
        'placeholder' => __('Add Sign', 'treck-addon'),
        'default' => __('+', 'treck-addon'),
        'label_block' => true
    ]
);

$counter_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-passport-4',
            'library' => 'font-awesome',
        ],
    ]
);

$this->add_control(
    'counter_list',
    [
        'label' => __('Check Lists', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $counter_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->add_control(
    'bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
