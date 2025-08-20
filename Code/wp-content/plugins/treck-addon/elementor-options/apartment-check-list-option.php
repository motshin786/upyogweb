<?php

//content
$this->start_controls_section(
    'content_one',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$appartment_check_list = new \Elementor\Repeater();

$appartment_check_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Lorem ipsum dolor sit amet is simply free text available in the market', 'treck-addon'),
    ]
);

$appartment_check_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'layout_one_apartment_detail_check_list',
    [
        'label' => __('Box List One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $appartment_check_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
