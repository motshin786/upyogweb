<?php

use Elementor\Modules\DynamicTags\Module as TagsModule;

$this->start_controls_section(
    'contact_form_section',
    [
        'label' => __('Contact Form', 'treck-addon'),
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
    'select_wpcf7_form',
    [
        'label'       => esc_html__('Select your contact form 7', 'treck-addon'),
        'label_block' => true,
        'type'        => \Elementor\Controls_Manager::SELECT,
        'options'     => treck_post_query('wpcf7_contact_form'),
    ]
);

$this->add_control(
    'bg_image',
    [
        'label' => __('Background Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->add_control(
    'bg_shape',
    [
        'label' => __('Background Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'content_section',
    [
        'label' => __('Contents', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$this->add_control(
    'faq_title',
    [
        'label' => __('Faq Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add faq title', 'treck-addon'),
        'default' => __('Default Title', 'treck-addon'),
    ]
);

treck_elementor_heading_option($this, 'Faq Title', 'h3', 'layout_one');

$this->add_control(
    'faq_icon',
    [
        'label' => __('Faq Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-buildings',
            'library' => 'custom-icon',
        ],
    ]
);

$faq = new \Elementor\Repeater();

$faq->add_control(
    'question',
    [
        'label' => __('Question', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Question', 'treck-addon'),
        'default' => __('Default Question', 'treck-addon'),
        'label_block' => true,
    ]
);

$faq->add_control(
    'content',
    [
        'label' => __('Content', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::CODE,
        'placeholder' => __('Add Answer', 'treck-addon'),
        'default' => __('Default Answer', 'treck-addon'),
        'label_block' => true,
    ]
);

$faq->add_control(
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
    'faq_lists',
    [
        'label' => __('FAQ List', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $faq->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ question }}}',
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'section_map',
    [
        'label' => esc_html__('Map', 'treck-addon'),
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
    $api_key = get_option('elementor_google_maps_api_key');

    if (!$api_key) {
        $this->add_control(
            'api_key_notification',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    /* translators: 1: Integration settings link open tag, 2: Create API key link open tag, 3: Link close tag. */
                    esc_html__('Set your Google Maps API Key in Elementor\'s %1$sIntegrations Settings%3$s page. Create your key %2$shere.%3$s', 'treck-addon'),
                    '<a href="' . \Elementor\Settings::get_url() . '#tab-integrations" target="_blank">',
                    '<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">',
                    '</a>'
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );
    }
}

$default_address = esc_html__('London Eye, London, United Kingdom', 'treck-addon');
$this->add_control(
    'address',
    [
        'label' => esc_html__('Location', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'dynamic' => [
            'active' => true,
            'categories' => [
                TagsModule::POST_META_CATEGORY,
            ],
        ],
        'placeholder' => $default_address,
        'default' => $default_address,
        'label_block' => true,
    ]
);

$this->add_control(
    'zoom',
    [
        'label' => esc_html__('Zoom', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'default' => [
            'size' => 10,
        ],
        'range' => [
            'px' => [
                'min' => 1,
                'max' => 20,
            ],
        ],
        'separator' => 'before',
    ]
);

$this->add_responsive_control(
    'height',
    [
        'label' => esc_html__('Height', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 40,
                'max' => 1440,
            ],
            'vh' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'size_units' => ['px', 'vh'],
        'selectors' => [
            '{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'view',
    [
        'label' => esc_html__('View', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::HIDDEN,
        'default' => 'traditional',
    ]
);

$this->end_controls_section();
