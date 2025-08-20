<?php

//content
$this->start_controls_section(
    'content_four',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_four'
        ]
    ]
);


$apartment_list = new \Elementor\Repeater();

$apartment_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
    ]
);

treck_elementor_heading_option($apartment_list, 'Apartment Title', 'h3', 'layout_four');

$apartment_list->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$apartment_list->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('120 m2', 'treck-addon'),
        'label_block' => true,
    ]
);

$apartment_list->add_control(
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

$apartment_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-right-arrow',
            'library' => 'font-awesome',
        ],
    ]
);

$this->add_control(
    'layout_four_apartment_list',
    [
        'label' => __('Apartment Lists', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $apartment_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->end_controls_section();
