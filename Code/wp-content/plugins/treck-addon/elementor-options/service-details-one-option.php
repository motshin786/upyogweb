<?php

//layout_one
$this->start_controls_section(
    'layout_one_content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'conditions' => [
            'terms' => [
                [
                    'name' => 'layout_type',
                    'operator' => '==',
                    'value' => 'layout_one'
                ]
            ]
        ]
    ]
);

$this->add_control(
    'layout_one_image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);


$this->add_control(
    'layout_one_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-organic-food',
            'library' => 'custom-icon',
        ],
    ]
);

$this->end_controls_section();
