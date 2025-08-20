<?php

$this->start_controls_section(
    'content_section',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$layout_one_item = new \Elementor\Repeater();

$layout_one_item->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Title', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($layout_one_item, 'Contact Location Title', 'h4', 'layout_one');

$layout_one_item->add_control(
    'subtitle',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Sub Title', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_item->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => wp_kses(__('<a href="mailto:needhelp@company.com">needhelp@company.com</a> <br> <a href="tel:9200888690">+92 (0088) - 8690</a>'), 'treck_allowed_tags')
    ]
);

$this->add_control(
    'layout_one_items',
    [
        'label' => __('Contact Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_one_item->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->add_control(
    'bg_shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
    ]
);

$this->end_controls_section();
