<?php

$this->start_controls_section(
    'layout_two_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'layout_two_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Title', 'h3', 'layout_two');



$this->add_control(
    'layout_two_button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Apply Now', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_button_url',
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
        'show_label' => true,
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

$this->add_control(
    'layout_two_bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
