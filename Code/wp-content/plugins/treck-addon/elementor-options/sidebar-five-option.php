<?php

$this->start_controls_section(
    'layout_five_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_five'
        ]
    ]
);


$this->add_control(
    'layout_five_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Title', 'h4', 'layout_five');

$this->add_control(
    'layout_five_call_title',
    [
        'label' => __('Call Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Have Question?', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_five_call_text',
    [
        'label' => __('Call Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Call Title', 'treck-addon'),
        'default' => __('Free', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_five_call_number',
    [
        'label' => __('Call Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Call Number', 'treck-addon'),
        'default' => __('+92 (8800) - 9850', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_five_call_url',
    [
        'label' => __('Call Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Call Url', 'treck-addon'),
        'default' => __('tel:9288009850', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_five_call_icon',
    [
        'label' => __('Call Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-phone',
            'library' => 'custom-icon',
        ],
    ]
);

$this->end_controls_section();
