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
        'label' => __('Add Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Explore', 'treck-addon')
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h3', 'layout_one');

$nav_menus = new \Elementor\Repeater();

$nav_menus->add_control(
    'nav_menu',
    [
        'label' => __('Select Nav Menu', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_nav_menu(),
        'label_block' => true,
    ]
);


$this->add_control(
    'nav_menus',
    [
        'label' => __('Nav Menus', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $nav_menus->get_controls(),
        'prevent_empty' => false,
    ]
);

$this->end_controls_section();
