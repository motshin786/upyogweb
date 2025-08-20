<?php

$this->start_controls_section(
    'layout_three_contact_form',
    [
        'label' => __('Contact Form', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$this->add_control(
    'layout_three_sec_title',
    [
        'label' => __('Section Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Title', 'h2', 'layout_three');

$this->add_control(
    'layout_three_sec_sub_title',
    [
        'label' => __('Section Sub Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add sub title', 'treck-addon'),
        'default' => __('Default Sub Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Section Sub Title', 'span', 'layout_three');

$this->add_control(
    'layout_three_contact_form_title',
    [
        'label' => __('Contact Form Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Contact title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

$this->add_control(
    'layout_three_select_wpcf7_form',
    [
        'label'       => esc_html__('Select your contact form 7', 'treck-addon'),
        'label_block' => true,
        'type'        => \Elementor\Controls_Manager::SELECT,
        'options'     => treck_post_query('wpcf7_contact_form'),
    ]
);

$this->add_control(
    'layout_three_shape_one',
    [
        'label' => __('Shape One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'layout_three_contact_tab',
    [
        'label' => __('Tab', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_three'
        ]
    ]
);

$layout_three_tab_items = new \Elementor\Repeater();

$layout_three_tab_items->add_control(
    'title',
    [
        'label' => __('Tab Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

$layout_three_tab_items->add_control(
    'text',
    [
        'label' => __('Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add Text', 'treck-addon'),
        'default' => __('Default Text', 'treck-addon'),
    ]
);

$layout_three_tab_items->add_control(
    'info',
    [
        'label' => __('Info Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'rows' => '2',
        'placeholder' => __('Add Text', 'treck-addon'),
        'default' => __('<li>
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="text">
                    <p>30 Commercial Road <br> Fratton, Australia</p>
                </div>
            </li>', 'treck-addon'),
    ]
);

$layout_three_tab_items->add_control(
    'image',
    [
        'label' => __('Image One', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$layout_three_tab_items->add_control(
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
    'layout_three_tab_items',
    [
        'label' => __('Contact Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_three_tab_items->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',
    ]
);

$this->end_controls_section();
