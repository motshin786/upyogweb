<?php

$this->start_controls_section(
    'layout_one_content',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);


$progress_bar = new \Elementor\Repeater();

$progress_bar->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Aleesha Brown', 'treck-addon'),
        'label_block' => true,
    ]
);

$progress_bar->add_control(
    'post_count',
    [
        'label' => __('Count Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['count'],
        'range' => [
            'count' => [
                'min' => 1,
                'max' => 100,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => 'count',
            'size' => 90,
        ],
    ]
);

$this->add_control(
    'progress_bar_items',
    [
        'label' => __('Progress Bar', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $progress_bar->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ name }}}',
    ]
);

$this->end_controls_section();
