<?php

$this->start_controls_section(
    'content_section_two',
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
        'rows' => '2',
        'default' => __('Awesome Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_two');


$this->add_control(
    'layout_two_sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_two');

$this->add_control(
    'layout_two_sec_summary',
    [
        'label' => __('Section Summary', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('Default Summary', 'treck-addon'),
    ]
);


$this->add_control(
    'layout_two_values_one_title_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$values_layout_two_list_one = new \Elementor\Repeater();

$values_layout_two_list_one->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'custom-icon',
        ],
    ]
);

$values_layout_two_list_one->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('wellness', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_values_list_one',
    [
        'label' => __('Feature List One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $values_layout_two_list_one->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'layout_two_values_list_one_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$values_layout_two_list_two = new \Elementor\Repeater();

$values_layout_two_list_two->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'custom-icon',
        ],
    ]
);

$values_layout_two_list_two->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('wellness', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_values_list_two',
    [
        'label' => __('Feature List Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $values_layout_two_list_two->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'layout_two_values_list_two_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$values_layout_two_list_three = new \Elementor\Repeater();

$values_layout_two_list_three->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fa fa-check',
            'library' => 'custom-icon',
        ],
    ]
);

$values_layout_two_list_three->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('wellness', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_two_values_list_three',
    [
        'label' => __('Feature List Three', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $values_layout_two_list_three->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'layout_two_values_one_image_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$this->add_control(
    'layout_two_background_image_one',
    [
        'label' => __('Image One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();
