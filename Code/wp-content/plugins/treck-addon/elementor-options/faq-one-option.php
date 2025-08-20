<?php

//content
$this->start_controls_section(
    'left_content_one',
    [
        'label' => __('Left Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);


$this->add_control(
    'left_sec_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Title', 'h3', 'layout_one');

$this->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Discover More', 'treck-addon'),
        'label_block' => true,
    ]
);


$this->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'left_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-deal',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'left_bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->end_controls_section();

//content
$this->start_controls_section(
    'right_content_one',
    [
        'label' => __('Right Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$this->add_control(
    'right_sec_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');

$this->add_control(
    'right_sec_sub_title',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');

$faq = new \Elementor\Repeater();

$faq->add_control(
    'question',
    [
        'label' => __('Question', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Question', 'treck-addon'),
        'default' => __('Default Question', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($faq, 'Faq One Question', 'h4', 'layout_one');

$faq->add_control(
    'answer',
    [
        'label' => __('Answer', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Answer', 'treck-addon'),
        'default' => __('Default Answer', 'treck-addon'),
        'label_block' => true,
    ]
);

$faq->add_control(
    'active_status',
    [
        'label' => __('Is active?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'no',
    ]
);

$this->add_control(
    'faq_lists',
    [
        'label' => __('FAQ List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $faq->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ question }}}',
    ]
);

$this->add_control(
    'right_bg_shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
