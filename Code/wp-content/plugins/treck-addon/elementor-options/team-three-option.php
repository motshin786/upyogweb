<?php

$this->start_controls_section(
    'layout_three_content',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);


$this->add_control(
    'layout_three_name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Jessica Brown', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($this, 'Team Name', 'h3', 'layout_three');

$this->add_control(
    'layout_three_designation',
    [
        'label' => __('Designation', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => __('Visa & Immigration Consultant', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_three_summary',
    [
        'label' => __('Summary Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => __('Default Summary Text', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_three_highlighted_text',
    [
        'label' => __('Highlighted Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => __('Default Highlighted Text', 'treck-addon'),
    ]
);

$layout_three_social_icons = new \Elementor\Repeater();

$layout_three_social_icons->add_control(
    'social_icon',
    [
        'label' => __('Select Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fab fa-facebook-f',
            'library' => 'brand',
        ],
        'label_block' => true,
    ]
);

$layout_three_social_icons->add_control(
    'social_url',
    [
        'label' => __('Add Url', 'treck-addon'),
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
    'layout_three_social_icons',
    [
        'label' => __('Social Icons', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_social_icons->get_controls(),
        'prevent_empty' => false,
        'default' => [
            [
                'social_url' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ],
        ],
    ]
);

$layout_three_checklist_list = new \Elementor\Repeater();

$layout_three_checklist_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
        'label_block' => true
    ]
);

$layout_three_checklist_list->add_control(
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
    'layout_three_checklist_list',
    [
        'label' => __('Check Lists', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_checklist_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'layout_three_image_section',
    [
        'label' => __('Image', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$this->add_control(
    'layout_three_image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'layout_three_shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_three_image_icon',
    [
        'label' => __('Image Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-success-1',
            'library' => 'custom-icon',
        ],
        'label_block' => true,
    ]
);

$this->add_control(
    'layout_three_image_caption',
    [
        'label' => __('Image Caption', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => __('Default Image Caption', 'treck-addon'),
    ]
);

$this->end_controls_section();
