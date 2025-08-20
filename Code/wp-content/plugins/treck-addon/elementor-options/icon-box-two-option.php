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


$layout_two_info_box = new \Elementor\Repeater();

$layout_two_info_box->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);


$layout_two_info_box->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-individual',
            'library' => 'custom-icon',
        ],
    ]
);


$this->add_control(
    'layout_two_info_box',
    [
        'label' => __('Icon Box', 'treck-addon'),
        'prevent_empty' => false,
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_info_box->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);

$this->end_controls_section();
