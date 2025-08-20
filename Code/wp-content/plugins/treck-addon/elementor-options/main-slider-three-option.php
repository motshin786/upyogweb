<?php

$this->start_controls_section(
    'layout_three_content_section',
    [
        'label' => __('Slider Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$layout_three_sliders = new \Elementor\Repeater();


$layout_three_sliders->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Awesome Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($layout_three_sliders, 'Title', 'h2', 'layout_three');

$layout_three_sliders->add_control(
    'sub_title',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Sub Title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($layout_three_sliders, 'Sub Title', 'p', 'layout_three');

$layout_three_sliders->add_control(
    'button_one_label',
    [
        'label' => __('Button One Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Book Appointment', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_three_sliders->add_control(
    'button_one_url',
    [
        'label' => __('Button One Url', 'treck-addon'),
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


$layout_three_sliders->add_control(
    'button_two_label',
    [
        'label' => __('Button Two Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Discover More', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_three_sliders->add_control(
    'button_two_url',
    [
        'label' => __('Button Two Url', 'treck-addon'),
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

$layout_three_sliders->add_control(
    'background_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'layout_three_sliders',
    [
        'label' => __('Main Slider', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_sliders->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);



$this->end_controls_section();
