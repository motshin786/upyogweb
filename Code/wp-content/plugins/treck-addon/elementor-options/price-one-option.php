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
    'sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');


$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');


$this->add_control(
    'service_one_btn_hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);


$filter = new \Elementor\Repeater();

$filter->add_control(
    'name',
    [
        'label' => __('Filter Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Filter Name', 'treck-addon'),
        'default' => __('Monthly Plan', 'treck-addon')
    ]
);

$filter->add_control(
    'slug',
    [
        'label' => __('Filter Slug', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Filter Slug', 'treck-addon'),
        'default' => __('monthly', 'treck-addon')
    ]
);

$this->add_control(
    'filter',
    [
        'label' => __('Filter', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => $filter->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);


$layout_one_pricing_items = new \Elementor\Repeater();

$layout_one_pricing_items->add_control(
    'title',
    [
        'label' => __('Pricing Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Single Entry Visa Fee', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_pricing_items->add_control(
    'price',
    [
        'label' => __('Price', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('$35', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_pricing_items->add_control(
    'features_title',
    [
        'label' => __('Features Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('All Visa Services Include:', 'treck-addon'),
        'label_block' => true,
    ]
);


$layout_one_pricing_items->add_control(
    'features',
    [
        'label' => __('Features', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'default' => __('<li> <div class="icon"><i class="fa fa-check"></i>
                </div>
                <div class="text">
                    <p>10 Days Time</p>
                </div>
            </li>', 'treck-addon'),
        'label_block' => true,
    ]
);


$layout_one_pricing_items->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Apply Now', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_pricing_items->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => true,
        ],
        'show_label' => false,
    ]
);

$layout_one_pricing_items->add_control(
    'slug',
    [
        'label' => __('Slug', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('monthly', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_pricing_items->add_control(
    'price_icon',
    [
        'label' => __('Price Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-passport-1',
            'library' => 'custom-icon',
        ],
    ]
);


$layout_one_pricing_items->add_control(
    'shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_one_pricing_items',
    [
        'label' => __('Pricing Items', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_one_pricing_items->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
