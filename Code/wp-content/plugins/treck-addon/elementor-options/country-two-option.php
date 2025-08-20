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
    'layout_two_btn_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$layout_two_country = new \Elementor\Repeater();

$layout_two_country->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Title', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($layout_two_country, 'Country Title', 'h3', 'layout_two');


$layout_two_country->add_control(
    'url',
    [
        'label' => __('Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
    ]
);

$layout_two_country->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'rows' => '3',
        'default' => __('<li><div class="icon"><span class="icon-check"></span></div><div class="text"> <p>5 Years Business Visa</p></div></li>', 'treck-addon'),
        'label_block' => true,
    ]
);


$layout_two_country->add_control(
    'image',
    [
        'label' => __('Icon Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_two_country_items',
    [
        'label' => __('Country List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_country->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->end_controls_section();
