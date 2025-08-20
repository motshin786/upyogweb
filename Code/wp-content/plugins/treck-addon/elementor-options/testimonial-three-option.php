<?php

$this->start_controls_section(
    'layout_three_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$layout_three_testimonial = new \Elementor\Repeater();

$layout_three_testimonial->add_control(
    'name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Kevin martin', 'treck-addon'),
        'label_block' => true
    ]
);


$layout_three_testimonial->add_control(
    'designation',
    [
        'label' => __('Designation', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Customer', 'treck-addon'),
        'label_block' => true
    ]
);

$layout_three_testimonial->add_control(
    'rating',
    [
        'label' => __('Rating', 'jetly-addon'),
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

$layout_three_testimonial->add_control(
    'testimonial',
    [
        'label' => __('Testimonial', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Testimonial Content', 'treck-addon'),
    ]
);


$layout_three_testimonial->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_three_testimonial->add_control(
    'quote_image',
    [
        'label' => __('Quote Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'layout_three_testimonials',
    [
        'label' => __('Testimonial Items', 'treck-addon'),
        'prevent_empty' => false,
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_testimonial->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);

$this->add_control(
    'layout_three_shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_three_shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->end_controls_section();

$this->start_controls_section(
    'layout_three_content_features',
    [
        'label' => __('Features', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$layout_three_features = new \Elementor\Repeater();

$layout_three_features->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Title', 'treck-addon'),
    ]
);

$layout_three_features->add_control(
    'count_number',
    [
        'label' => __('Count Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'rows' => '2',
        'placeholder' => __('Add Number', 'treck-addon'),
        'default' => __('68', 'treck-addon'),
        'label_block' => true
    ]
);

$layout_three_features->add_control(
    'count_sign',
    [
        'label' => __('Count Sign', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'rows' => '2',
        'placeholder' => __('Add Number', 'treck-addon'),
        'default' => __('K', 'treck-addon'),
        'label_block' => true
    ]
);


$layout_three_features->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-life-insurance',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'layout_three_features',
    [
        'label' => __('Features', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_features->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'layout_three_features_shape',
    [
        'label' => __('Background Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
