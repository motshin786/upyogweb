<?php
$this->start_controls_section(
    'header_title',
    [
        'label' => __('Blog Header', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => ['layout_one', 'layout_two', 'layout_three']
        ]
    ]
);

$this->add_control(
    'sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');


$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');


$this->end_controls_section();

$this->start_controls_section(
    'post_option',
    [
        'label' => __('Post Options', 'treck-addon'),
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
                'max' => 15,
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

$this->add_control(
    'select_category',
    [
        'label' => __('Post Category', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_taxonoy('category'),
    ]
);

$this->add_control(
    'pagination_status',
    [
        'label' => __('Enable Pagination?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'no',
        'condition' => [
            'layout_type' => 'layout_four'
        ]
    ]
);


$this->end_controls_section();


$this->start_controls_section(
    'post_list_option',
    [
        'label' => __('Post List Options', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'post_list_status',
    [
        'label' => __('Enable Post List Style ?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'no',
    ]
);

$this->add_control(
    'post_list_count',
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
            'size' => 6,
        ],
        'condition' => [
            'post_list_status' => 'yes'
        ]
    ]
);


$this->add_control(
    'post_list_query_order',
    [
        'label' => __('Select Order', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => 'DESC',
        'options' => [
            'DESC' => __('DESC', 'treck-addon'),
            'ASC' => __('ASC', 'treck-addon'),
        ],
        'condition' => [
            'post_list_status' => 'yes'
        ]
    ]
);

$this->add_control(
    'post_list_select_category',
    [
        'label' => __('Post Category', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_taxonoy('category'),
        'condition' => [
            'post_list_status' => 'yes'
        ]
    ]
);

$this->end_controls_section();
