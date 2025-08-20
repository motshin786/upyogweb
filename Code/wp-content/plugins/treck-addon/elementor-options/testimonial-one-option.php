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

$testimonial = new \Elementor\Repeater();

$testimonial->add_control(
    'name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Kevin martin', 'treck-addon'),
        'label_block' => true
    ]
);

treck_elementor_heading_option($testimonial, 'Testimonial Title', 'h4', 'layout_one');

$testimonial->add_control(
    'designation',
    [
        'label' => __('Designation', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Customer', 'treck-addon'),
        'label_block' => true
    ]
);

$testimonial->add_control(
    'testimonial',
    [
        'label' => __('Testimonial', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Testimonial Content', 'treck-addon'),
    ]
);

$testimonial->add_control(
    'rating',
    [
        'label' => __('Rating', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['count'],
        'range' => [
            'count' => [
                'min' => 1,
                'max' => 5,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => 'count',
            'size' => 5,
        ],
    ]
);


$testimonial->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$testimonial->add_control(
    'shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$testimonial->add_control(
    'shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'testimonials',
    [
        'label' => __('Testimonial Items', 'treck-addon'),
        'prevent_empty' => false,
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $testimonial->get_controls(),
        'title_field' => '{{{ name }}}',
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
