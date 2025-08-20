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
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Title', 'treck-addon'),
        'label_block' => true
    ]
);

treck_elementor_heading_option($this, 'Title', 'h4', 'layout_one');

$this->add_control(
    'summary_one',
    [
        'label' => __('Summary One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Text', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'summary_two',
    [
        'label' => __('Summary Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Text', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
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

$infos = new \Elementor\Repeater();

$infos->add_control(
    'title',
    [
        'label' => __('title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Default Title', 'treck-addon'),
        'label_block' => true
    ]
);

$infos->add_control(
    'info_text',
    [
        'label' => __('Info Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Default Info Title', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'infos',
    [
        'label' => __('infos Items', 'treck-addon'),
        'prevent_empty' => false,
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $infos->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);

$this->add_control(
    'client_one',
    [
        'label' => __('Client One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Client', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_one_button_label_one',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Apply for Visa Now', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_one_button_url_one',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'layout_one_button_label_two',
    [
        'label' => __('Button Two Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Read More Stories', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_one_button_url_two',
    [
        'label' => __('Button Two Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'shape_three',
    [
        'label' => __('Shape Three', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'shape_four',
    [
        'label' => __('Shape Four', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
