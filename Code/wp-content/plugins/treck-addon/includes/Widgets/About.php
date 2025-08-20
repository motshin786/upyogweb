<?php

namespace Layerdrops\Treck\Widgets;


class About extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'treck-about';
	}

	public function get_title()
	{
		return __('About', 'treck-addon');
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
					'layout_five' => __('Layout Five', 'treck-addon'),
					'layout_six' => __('Layout Six', 'treck-addon'),
					'layout_seven' => __('Layout Seven', 'treck-addon'),
				]
			]
		);

		$this->end_controls_section();

		include treck_get_elementor_option('about-one-option.php');
		include treck_get_elementor_option('about-two-option.php');
		include treck_get_elementor_option('about-three-option.php');
		include treck_get_elementor_option('about-four-option.php');
		include treck_get_elementor_option('about-five-option.php');
		include treck_get_elementor_option('about-six-option.php');
		include treck_get_elementor_option('about-seven-option.php');

		//General style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('Content Style', 'treck-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		treck_elementor_general_style_options($this, 'Section Title', '{{WRAPPER}} .section-title__title', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven']);
		treck_elementor_general_style_options($this, 'Section Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven']);
		treck_elementor_general_style_options($this, 'Summary', '{{WRAPPER}} .about-one__text, {{WRAPPER}} .about-two__text,{{WRAPPER}} .about-three__text-1, {{WRAPPER}} .benefits-one__text, {{WRAPPER}} .about-four__text-1,  {{WRAPPER}} .travel-one__text-1', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_seven']);
		treck_elementor_general_style_options($this, 'Section Summary Two', '{{WRAPPER}} .about-three__text-2,{{WRAPPER}} .travel-one__text-2', ['layout_three', 'layout_seven']);

		treck_elementor_general_style_options($this, 'Highlighted Text', '{{WRAPPER}} .about-three__content h4,{{WRAPPER}} .about-four__content h4', ['layout_three', 'layout_five']);

		treck_elementor_general_style_options($this, 'Featured Title', '{{WRAPPER}} .about-one__points li .content h3,{{WRAPPER}} .benefits-one__points li .content h4', ['layout_one', 'layout_four', 'layout_six']);
		treck_elementor_general_style_options($this, 'Featured Tagline', '{{WRAPPER}} .content p', ['layout_four', 'layout_six']);
		treck_elementor_general_style_options($this, 'Featured Content', '{{WRAPPER}} .about-one__points li .content p', 'layout_one');

		treck_elementor_general_style_options($this, 'Progress Bar Title', '{{WRAPPER}} .about-two__progress-title', 'layout_one');

		treck_elementor_general_style_options($this, 'Caption Count', '{{WRAPPER}} .about-one__experience h3, {{WRAPPER}} .about-two__experience h3,{{WRAPPER}} .about-four__experience h3 ', ['layout_one', 'layout_two', 'layout_five']);
		treck_elementor_general_style_options($this, 'Caption Text', '{{WRAPPER}} .about-one__experience p,{{WRAPPER}} .about-two__experience p,{{WRAPPER}} .benefits-one__solution-title,{{WRAPPER}} .about-four__experience p', ['layout_one', 'layout_two', 'layout_four', 'layout_five']);

		treck_elementor_general_style_options($this, 'Check List Title', '{{WRAPPER}} .about-two__points li .text p,{{WRAPPER}} .about-three__points li .text p,{{WRAPPER}} .about-four__points li .text p,{{WRAPPER}} .travel-one__points li .text p', ['layout_two', 'layout_three', 'layout_five', 'layout_seven']);

		$this->end_controls_section();

		//button style
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__('Button Style', 'treck-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three', 'layout_five', 'layout_seven']
				]
			]
		);

		treck_elementor_button_style_options($this, 'Button', '{{WRAPPER}} .thm-btn', '{{WRAPPER}} .thm-btn:before', ['layout_one', 'layout_two', 'layout_five', 'layout_seven']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include treck_get_template('about-one.php');
		include treck_get_template('about-two.php');
		include treck_get_template('about-three.php');
		include treck_get_template('about-four.php');
		include treck_get_template('about-five.php');
		include treck_get_template('about-six.php');
		include treck_get_template('about-seven.php');
	}
}
