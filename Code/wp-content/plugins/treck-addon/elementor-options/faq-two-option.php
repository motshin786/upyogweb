<?php

//content
$this->start_controls_section(
    'layout_two_content',
    [
        'label' => __('Content', 'treck-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
            'layout_type' => 'layout_two'
        ]
    ]
);


$layout_two_faq = new \Elementor\Repeater();

$layout_two_faq->add_control(
    'question',
    [
        'label' => __('Question', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add Question', 'treck-addon'),
        'default' => __('Default Question', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_two_faq->add_control(
    'answer',
    [
        'label' => __('Answer', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'placeholder' => __('Add Answer', 'treck-addon'),
        'default' => __('Default Answer', 'treck-addon'),
        'label_block' => true,
    ]
);

$layout_two_faq->add_control(
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
    'layout_two_faq_lists',
    [
        'label' => __('FAQ', 'treck-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $layout_two_faq->get_controls(),
        'prevent_empty' => false,
        'title_field' => '{{{ question }}}',
    ]
);


$this->end_controls_section();
