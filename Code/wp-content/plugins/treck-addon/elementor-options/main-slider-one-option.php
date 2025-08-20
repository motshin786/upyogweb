<?php

$this->start_controls_section(
    'content_section',
    [
        'label' => __('Slider Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$sliders = new \Elementor\Repeater();

$sliders->add_control(
    'background_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$sliders->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Awesome Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($sliders, 'Title', 'h2', 'layout_one');

$sliders->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Discover More', 'treck-addon'),
        'label_block' => true,
    ]
);

$sliders->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
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


$this->add_control(
    'sliders',
    [
        'label' => __('Main Slider', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $sliders->get_controls(),
        'title_field' => '{{{ title }}}',
        'prevent_empty' => false,
    ]
);

$this->end_controls_section();
