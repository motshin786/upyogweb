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
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_one');

$this->add_control(
    'sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_one');

$this->add_control(
    'summary',
    [
        'label' => __('Summary', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add summary', 'treck-addon'),
        'default' => __('Default text', 'treck-addon'),
    ]
);

$tab_items = new \Elementor\Repeater();

$tab_items->add_control(
    'title',
    [
        'label' => __('Tab Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('South America', 'treck-addon'),
        'label_block' => true
    ]
);


$tab_items->add_control(
    'contact_info_title',
    [
        'label' => __('Contact Info Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('We’re Always Here for You', 'treck-addon'),
        'label_block' => true
    ]
);


$tab_items->add_control(
    'contact_info',
    [
        'label' => __('Contact Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'default' => __('<li>
            <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="content">
                <p>30 Commercial Road <br>
                    Fratton, Australia</p>
            </div>
        </li>', 'treck-addon'),
        'label_block' => true
    ]
);

$tab_items->add_control(
    'office_time',
    [
        'label' => __('Office Time', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'default' => __('<li>
            <p class="location-one__tab-content-day-name">Monday</p>
            <h4 class="location-one__tab-content-time-box">12:00 pm - 19:00 pm
            </h4>
        </li>', 'treck-addon'),
        'label_block' => true
    ]
);


$tab_items->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$tab_items->add_control(
    'bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$tab_items->add_control(
    'active_status',
    [
        'label' => __('Is active?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'no',
    ]
);

$this->add_control(
    'tab_items',
    [
        'label' => __('Tab Items', 'treck-addon'),
        'prevent_empty' => false,
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $tab_items->get_controls(),
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
