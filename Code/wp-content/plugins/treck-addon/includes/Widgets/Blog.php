<?php

namespace Layerdrops\Treck\Widgets;


class Blog extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'treck-blog';
    }

    public function get_title()
    {
        return __('Blog', 'treck-addon');
    }

    public function get_icon()
    {
        return 'eicon-cogs';
    }

    public function get_categories()
    {
        return ['treck-category'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => __('Select Layout', 'treck-addon'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'layout_one',
                'options' => [
                    'layout_one' => __('Layout One', 'treck-addon'),
                    'layout_two' => __('Layout Two', 'treck-addon'),
                    'layout_three' => __('Layout Three', 'treck-addon'),
                    'layout_four' => __('Layout Four', 'treck-addon'),
                ]
            ]
        );

        $this->end_controls_section();

        include  treck_get_elementor_option('blog-option.php');

        //General style
        $this->start_controls_section(
            'general_style',
            [
                'label' => esc_html__('Content Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one', 'layout_two', 'layout_three']);
        treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one', 'layout_two', 'layout_three']);

        treck_elementor_general_style_options($this, 'Post Title', '{{WRAPPER}} .blog-one__title a,{{WRAPPER}} .blog-two__title a', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five']);
        treck_elementor_general_style_options($this, 'Tag', '{{WRAPPER}} .blog-two__tag p,{{WRAPPER}} .blog-one__tag p', ['layout_two', 'layout_three', 'layout_four']);
        treck_elementor_general_style_options($this, 'Post Meta', '{{WRAPPER}} .blog-one__user .text p,{{WRAPPER}} .blog-one__tag p', ['layout_one']);
        treck_elementor_general_style_options($this, 'Post Author', '{{WRAPPER}} .blog-one__user .text p', ['layout_four']);
        treck_elementor_general_style_options($this, 'Comment', '{{WRAPPER}} .blog-two__comment p,{{WRAPPER}} .blog-two__comment p a,{{WRAPPER}} .blog-one__comment p span a', ['layout_two', 'layout_three', 'layout_four']);

        $this->end_controls_section();

        //General style
        $this->start_controls_section(
            'post_list_style',
            [
                'label' => esc_html__('Post List Style', 'treck-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_list_status' => 'yes'
                ]
            ]
        );

        treck_elementor_general_style_options($this, 'Post List Post Title', '{{WRAPPER}} .blog-two__title-two a', ['layout_two']);
        treck_elementor_general_style_options($this, 'Author', '{{WRAPPER}} .blog-two__user-two .text p', ['layout_two']);
        treck_elementor_general_style_options($this, 'Post List Tag', '{{WRAPPER}} .blog-two__tag-two p', ['layout_two']);
        treck_elementor_general_style_options($this, 'Post List Comment', '{{WRAPPER}} .blog-two__comment-two a, {{WRAPPER}} .blog-two__comment-two', ['layout_two']);

        $this->end_controls_section();

        treck_elementor_column_count_options($this, ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include treck_get_template('blog-one.php');
        include treck_get_template('blog-two.php');
        include treck_get_template('blog-three.php');
        include treck_get_template('blog-four.php');
    }
}
