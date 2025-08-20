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
        'default' => __('News', 'treck-addon')
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
                'max' => 15,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => 'count',
            'size' => 2,
        ],
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
