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
        'label' => __('Add Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Contact', 'treck-addon')
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h3', 'layout_one');


$footer_contact_list = new \Elementor\Repeater();

$footer_contact_list->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Content', 'treck-addon'),
        'default' => __('Default Text', 'treck-addon'),
    ]
);

$footer_contact_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-clock',
            'library' => 'font-awesome',
        ],
    ]
);

$this->add_control(
    'footer_contact_list',
    [
        'label' => __('Contact Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $footer_contact_list->get_controls(),
        'prevent_empty' => false,
    ]
);

$this->end_controls_section();
