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


$layout_one_visa_offer = new \Elementor\Repeater();

$layout_one_visa_offer->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'default' => __('Awesome Title', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($layout_one_visa_offer, 'Title', 'h3', 'layout_one');


$layout_one_visa_offer->add_control(
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

$layout_one_visa_offer->add_control(
    'tag_line',
    [
        'label' => __('Tag Line', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Default Text', 'treck-addon'),
        'label_block' => true,
    ]
);

treck_elementor_heading_option($layout_one_visa_offer, 'Tag Line', 'h5', 'layout_one');

$layout_one_visa_offer->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'default' => __('<li>
        <div class="icon">
            <span class="icon-check"></span>
        </div>
        <div class="text">
            <p>No IELTS Test Required</p>
        </div>
        </li>', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_visa_offer->add_control(
    'price_text',
    [
        'label' => __('Price Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Starting with', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_visa_offer->add_control(
    'price',
    [
        'label' => __('Price', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('$360.00', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_visa_offer->add_control(
    'time',
    [
        'label' => __('Visa Time', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('30 DAYS VISA TIME', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_one_visa_offer->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_one_visa_offer->add_control(
    'flag_image',
    [
        'label' => __('Flag Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_one_visa_offer->add_control(
    'shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_one_visa_offer->add_control(
    'shape_two',
    [
        'label' => __('Shape Two', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_one_visa_offer->add_control(
    'shape_three',
    [
        'label' => __('Shape Three', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$layout_one_visa_offer->add_control(
    'shape_four',
    [
        'label' => __('Shape Four', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);


$this->add_control(
    'layout_one_visa_offer_items',
    [
        'label' => __('Visa Items', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_one_visa_offer->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);


$this->end_controls_section();
