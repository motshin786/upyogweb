<?php

$this->start_controls_section(
    'layout_two_content_section',
    [
        'label' => __('Slider Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$layout_two_sliders = new \Elementor\Repeater();

$layout_two_sliders->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Awesome Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($layout_two_sliders, 'Title', 'h2', 'layout_two');

$layout_two_sliders->add_control(
    'check_list',
    [
        'label' => __('Check List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'placeholder' => __('Check List', 'treck-addon'),
        'default' => __('<li><div class="icon"><span class="icon-check"></span></div><div class="text"><p>No Interviews</p></div></li>', 'treck-addon'),
    ]
);

$layout_two_sliders->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Discover More', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_two_sliders->add_control(
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

$layout_two_sliders->add_control(
    'background_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$layout_two_sliders->add_control(
    'bg_shape',
    [
        'label' => __('Background shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$layout_two_sliders->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'layout_two_sliders',
    [
        'label' => __('Main Slider', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_sliders->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$layout_two_features = new \Elementor\Repeater();

$layout_two_features->add_control(
    'feature_title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Awesome Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
        'label_block' => true
    ]
);

treck_elementor_heading_option($layout_two_features, 'Features Title', 'h4', 'layout_two');

$layout_two_features->add_control(
    'button_url',
    [
        'label' => __('Url', 'treck-addon'),
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

$layout_two_features->add_control(
    'summary',
    [
        'label' => __('Summary', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Summary Text', 'treck-addon'),
        'default' => __('Default Summary Text', 'treck-addon'),
    ]
);

$layout_two_features->add_control(
    'icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-passport-4',
            'library' => 'Custom Icon',
        ],
    ]
);

$this->add_control(
    'layout_two_features',
    [
        'label' => __('Features', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_features->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ feature_title }}}',
    ]
);

$this->end_controls_section();
