<?php

$this->start_controls_section(
    'layout_eight_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_eight'
        ]
    ]
);


$layout_eight_service = new \Elementor\Repeater();

$layout_eight_service->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-tourist',
            'library' => 'custom-icon',
        ],
    ]
);

$layout_eight_service->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Title', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($layout_eight_service, 'Service Title', 'h3', 'layout_eight');


$layout_eight_service->add_control(
    'url',
    [
        'label' => __('Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
    ]
);

$layout_eight_service->add_control(
    'text',
    [
        'label' => __('Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '3',
        'default' => __('Default Text', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_eight_service->add_control(
    'url_icon',
    [
        'label' => __('Url Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-up-right',
            'library' => 'custom-icon',
        ],
    ]
);

$layout_eight_service->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_eight_service->add_control(
    'shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'layout_eight_service_items',
    [
        'label' => __('Service Items', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_eight_service->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
