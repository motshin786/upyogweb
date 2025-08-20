<?php

$this->start_controls_section(
    'header_title',
    [
        'label' => __('Section Header', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => ['layout_one', 'layout_two']
        ]
    ]
);

$this->add_control(
    'sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');

$this->add_control(
    'sec_title_shape',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');


$this->end_controls_section();

$this->start_controls_section(
    'content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);


$this->add_control(
    'post_count',
    [
        'label' => __('Number Of Posts', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['count'],
        'range' => [
            'count' => [
                'min' => 0,
                'max' => 11,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => 'count',
            'size' => 6,
        ],
    ]
);

$this->add_control(
    'select_category',
    [
        'label' => __('Product Category', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_taxonoy('product_cat'),
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$this->add_control(
    'show_filter',
    [
        'label' => __('Enable Filter', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Show', 'treck-addon'),
        'label_off' => __('Hide', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'select_product_category',
    [
        'label' => __('Product Category', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_taxonoy('product_cat'),
        'multiple' => true,
        'condition' => [
            'layout_type' => 'layout_two',
            'show_filter' => 'yes'
        ]
    ]
);

$this->add_control(
    'query_order',
    [
        'label' => __('Select Order', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => 'DESC',
        'options' => [
            'DESC' => __('DESC', 'treck-addon'),
            'ASC' => __('ASC', 'treck-addon'),
        ]
    ]
);

$this->end_controls_section();
