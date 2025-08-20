<?php
$this->start_controls_section(
    'content_section',
    [
        'label' => __('Offer Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$offer = new \Elementor\Repeater();

$offer->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Awesome Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($offer, 'Title', 'h3', 'layout_one');

$offer->add_control(
    'sub_title',
    [
        'label' => __('Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Sub Title', 'treck-addon'),
        'default' => __('Awesome Sub Title', 'treck-addon'),
    ]
);

$offer->add_control(
    'button_label',
    [
        'label' => __('Button Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Shop Now', 'treck-addon'),
        'label_block' => true,
    ]
);

$offer->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => true,
    ]
);

$offer->add_control(
    'image',
    [
        'label' => __('Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$offer->add_control(
    'shape',
    [
        'label' => __('Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'offers',
    [
        'label' => __('Offers', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $offer->get_controls(),
        'prevent_empty' => false,
        'default' => [
            [
                'title' => __('Awesome Title', 'treck-addon'),
            ],
        ],
        'title_field' => '{{{ title }}}',
    ]
);

$this->end_controls_section();
