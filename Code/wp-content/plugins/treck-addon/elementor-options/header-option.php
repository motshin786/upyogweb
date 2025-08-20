<?php


$this->start_controls_section(
    'logo_section',
    [
        'label' => __('Site Logo', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);


$this->add_control(
    'light_logo',
    [
        'label' => __('Light Logo', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'logo_dimension',
    [
        'label' => __('Logo Dimension', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
        'description' => __('Set Custom Logo Size.', 'treck-addon'),
        'default' => [
            'width' => '136',
            'height' => '39',
        ],
    ]
);


$this->end_controls_section();

$this->start_controls_section(
    'nav_section',
    [
        'label' => __('Navigation', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'nav_menu',
    [
        'label' => __('Select Nav Menu', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_nav_menu(),
        'label_block' => true,
    ]
);

$this->end_controls_section();

//top bar
$this->start_controls_section(
    'topbar_section',
    [
        'label' => __('Topbar', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => ['layout_one', 'layout_two', 'layout_three']
        ]

    ]
);


$topbar_infos = new \Elementor\Repeater();

$topbar_infos->add_control(
    'topbar_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-map-marker',
            'library' => 'custom',
        ],
        'label_block' => true,
    ]
);

$topbar_infos->add_control(
    'topbar_info_text',
    [
        'label' => __('Topbar Info ', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('30 Broklyn Golden Street. USA', 'treck-addon'),
        'label_block' => true,
    ]
);


$this->add_control(
    'topbar_infos',
    [
        'label' => __('Top bar Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $topbar_infos->get_controls(),
        'title_field' => '{{{ topbar_info_text }}}',
    ]
);


$topbar_nav = new \Elementor\Repeater();

$topbar_nav->add_control(
    'name',
    [
        'label' => __('Name', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Login', 'treck-addon'),
        'label_block' => true,
    ]
);

$topbar_nav->add_control(
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
        'show_label' => false,
    ]
);

$this->add_control(
    'topbar_nav',
    [
        'label' => __('Top bar Info', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $topbar_nav->get_controls(),
        'title_field' => '{{{ name }}}',
    ]
);


$this->end_controls_section();

//other
$this->start_controls_section(
    'others_section',
    [
        'label' => __('Others', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'search_enable',
    [
        'label' => __('Enable Search?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->add_control(
    'cart_enable',
    [
        'label' => __('Display Cart Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
        'condition' => [
            'layout_type' => ['layout_two', 'layout_three']
        ],
    ]
);

$this->add_control(
    'social_title',
    [
        'label' => __('Social', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Follow us:', 'treck-addon'),
        'label_block' => true,
        'condition' => [
            'layout_type' => 'layout_two'
        ],
    ]
);


$social_icons = new \Elementor\Repeater();

$social_icons->add_control(
    'social_icon',
    [
        'label' => __('Select Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fab fa-facebook-f',
            'library' => 'brand',
        ],
        'label_block' => true,
    ]
);

$social_icons->add_control(
    'social_url',
    [
        'label' => __('Add Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'social_icons',
    [
        'label' => __('Social Icons', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $social_icons->get_controls(),
        'prevent_empty' => false,
        'condition' => [
            'layout_type' => ['layout_two', 'layout_three']
        ],
        'default' => [
            [
                'social_url' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ],
        ],
    ]
);

$this->add_control(
    'social_bg_shape',
    [
        'label' => __('Social Background Shape', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);

$this->add_control(
    'button_label',
    [
        'label' => __('Button Label', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Book Appointment', 'treck-addon'),
        'label_block' => true,
    ]
);


$this->add_control(
    'button_url',
    [
        'label' => __('Button Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => true,
        'default' => [
            'url' => '#',
            'is_external' => true,
            'nofollow' => true,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'call_text',
    [
        'label' => __('Call Text', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Text', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'call_number',
    [
        'label' => __('Call Number', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Number', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'call_url',
    [
        'label' => __('Call Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Call Url', 'treck-addon'),
        'label_block' => true,
        'default' => '#'
    ]
);

$this->add_control(
    'call_icon_image',
    [
        'label' => __('Call Icon Image', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [],
    ]
);

$this->end_controls_section();

//news ticker
$this->start_controls_section(
    'news_ticker_section',
    [
        'label' => __('News Ticker', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_one'
        ]
    ]
);

$this->add_control(
    'search_news_ticker',
    [
        'label' => __('Enable News Ticker?', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'treck-addon'),
        'label_off' => __('No', 'treck-addon'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->add_control(
    'news_ticker_title',
    [
        'label' => __('News Ticker Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Updates', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'news_ticker_icon',
    [
        'label' => __('Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'icon-megaphone',
            'library' => 'custom-icon',
        ],
    ]
);

$this->add_control(
    'news_ticker_social_title',
    [
        'label' => __('News Ticker Social Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Follow us:', 'treck-addon'),
        'label_block' => true,
    ]
);

$news_ticker = new \Elementor\Repeater();

$news_ticker->add_control(
    'title',
    [
        'label' => __('Title', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => '2',
        'placeholder' => __('Add title', 'treck-addon'),
        'default' => __('Default  Text', 'treck-addon'),
    ]
);

$this->add_control(
    'news_ticker',
    [
        'label' => __('News Ticker', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $news_ticker->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ title }}}',

    ]
);

$news_social_icons = new \Elementor\Repeater();

$news_social_icons->add_control(
    'social_icon',
    [
        'label' => __('Select Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fab fa-facebook-f',
            'library' => 'brand',
        ],
        'label_block' => true,
    ]
);

$news_social_icons->add_control(
    'social_url',
    [
        'label' => __('Add Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'news_social_icons',
    [
        'label' => __('Social Icons', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $news_social_icons->get_controls(),
        'prevent_empty' => false,
        'default' => [
            [
                'social_url' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ],
        ],
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'mobile_menu_section',
    [
        'label' => __('Mobile Drawer', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);


$this->add_control(
    'mobile_menu_logo',
    [
        'label' => __('Mobile Drawer Logo', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'mobile_email',
    [
        'label' => __('Email', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Email', 'treck-addon'),
        'label_block' => true,
    ]
);

$this->add_control(
    'mobile_phone',
    [
        'label' => __('Phone', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Phone Number', 'treck-addon'),
        'label_block' => true,
    ]
);

$mobile_menu_social_icons = new \Elementor\Repeater();

$mobile_menu_social_icons->add_control(
    'social_icon',
    [
        'label' => __('Select Icon', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => treck_get_fa_icons(),
        'default' => 'fa-facebook-f',
        'label_block' => true,
    ]
);

$mobile_menu_social_icons->add_control(
    'social_url',
    [
        'label' => __('Add Url', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => __('#', 'treck-addon'),
        'show_external' => false,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_label' => false,
    ]
);

$this->add_control(
    'mobile_menu_social_icons',
    [
        'label' => __('Social Icons', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $mobile_menu_social_icons->get_controls(),
        'prevent_empty' => false,
        'default' => [
            [
                'social_icon' => 'fa-facebook-f',
                'social_url' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ],
        ],
        'title_field' => '{{{ social_icon }}}',
    ]
);

$this->end_controls_section();
