<?php

//content
$this->start_controls_section(
    'content_one',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$appartment_details_box_list = new \Elementor\Repeater();

$appartment_details_box_list->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('130', 'treck-addon'),
    ]
);

treck_elementor_heading_option($appartment_details_box_list, 'Apartment Box Title', 'h3', 'layout_one');

$appartment_details_box_list->add_control(
    'subtitle',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('SQUARE AREAS', 'treck-addon'),
    ]
);

treck_elementor_heading_option($appartment_details_box_list, 'Apartment Box Sub Title', 'h5', 'layout_one');

$this->add_control(
    'layout_one_apartment_detail_box_list',
    [
        'label' => __('Box List One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $appartment_details_box_list->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
