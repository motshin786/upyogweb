<?php

//content
$this->start_controls_section(
    'layout_two_content',
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
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_two');

$this->add_control(
    'layout_two_summary',
    [
        'label' => __('Summary', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Text', 'treck-addon'),
        'default' => __('Default Summary Text', 'treck-addon'),
    ]
);

$this->add_control(
    'about_two_year_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$layout_two_checklist_list = new \Elementor\Repeater();

$layout_two_checklist_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
        'label_block' => true
    ]
);

$layout_two_checklist_list->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-check',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'layout_two_checklist_list',
    [
        'label' => __('Check Lists', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_checklist_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$layout_two_progressbar = new \Elementor\Repeater();

$layout_two_progressbar->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Construction', 'treck-addon'),
        'label_block' => true
    ]
);


$layout_two_progressbar->add_control(
    'count_number',
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
            'size' => 80,
        ],
    ]
);

$this->add_control(
    'layout_two_progressbar',
    [
        'label' => __('Progress Bar', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_progressbar->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'about_two_feature_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$this->add_control(
    'layout_two_call_text',
    [
        'label' => __('Call Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Have Question?', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_two_call_text_two',
    [
        'label' => __('Call Text Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Free', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_two_call_number',
    [
        'label' => __('Call Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Number', 'treck-addon'),
        'default' => __('+92 (8800) - 9850', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_two_call_url',
    [
        'label' => __('Call Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Url', 'treck-addon'),
        'default' => __('#', 'treck-addon'),
        'label_block' => true
    ]
);

$this->add_control(
    'layout_two_call_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-phone',
            'library' => 'custom-icon',
        ],
    ]
);


$this->add_control(
    'layout_two_button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Discover More', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_button_url',
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


$this->end_controls_section();

$this->start_controls_section(
    'layout_two_section_image',
    [
        'label' => __('Images', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'layout_two_image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'layout_two_caption_year',
    [
        'label' => __('Caption Year', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('28', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_caption_text',
    [
        'label' => __('Caption Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Default Text', 'treck-addon'),
        'label_block' => true,
    ]
);


$this->add_control(
    'layout_two_shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_two_shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
