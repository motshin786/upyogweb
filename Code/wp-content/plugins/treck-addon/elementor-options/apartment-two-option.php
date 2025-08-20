<?php

//content
$this->start_controls_section(
    'content_two',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'layout_two_sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_two');

$this->add_control(
    'layout_two_sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_two');

$apartment_two_list = new \Elementor\Repeater();

$apartment_two_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'rows'  => '2',
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($apartment_two_list, 'Apartment Title', 'h3', 'layout_two');

$apartment_two_list->add_control(
    'subtitle',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows'  => '2',
        'placeholder' => __('Add Sub Title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

$apartment_two_list->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$apartment_two_list->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('120 m2', 'treck-addon'),
        'label_block' => true,
    ]
);

$apartment_two_list->add_control(
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
    'layout_two_apartment_list',
    [
        'label' => __('Apartment Lists', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $apartment_two_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
