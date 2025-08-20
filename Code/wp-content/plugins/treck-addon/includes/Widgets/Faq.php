<?php

namespace Layerdrops\Treck\Widgets;


class Faq extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'treck-faq';
	}

	public function get_title()
	{
		return __('FAQ', 'treck-addon');
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
				]
			]
		);

		$this->end_controls_section();

		include treck_get_elementor_option('faq-one-option.php');
		include treck_get_elementor_option('faq-two-option.php');

		//General style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('Content Style', 'treck-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		treck_elementor_general_style_options($this, 'Left Title', '{{WRAPPER}} .faq-one__title', ['layout_one']);
		treck_elementor_general_style_options($this, 'Right Title', '{{WRAPPER}} .section-title__title', ['layout_one']);
		treck_elementor_general_style_options($this, 'Right Sub Title', '{{WRAPPER}} .section-title__tagline', ['layout_one']);

		treck_elementor_general_style_options($this, 'Question', '{{WRAPPER}} .faq-one__faq-box .faq-one-accrodion .accrodion-title h4', ['layout_one', 'layout_two']);
		treck_elementor_general_style_options($this, 'Active Question', '{{WRAPPER}} .faq-one__faq-box .faq-one-accrodion .accrodion.active .accrodion-title h4', ['layout_one', 'layout_two']);
		treck_elementor_general_style_options($this, 'Answer', '{{WRAPPER}} .faq-one__faq-box .faq-one-accrodion .accrodion-content p', ['layout_one', 'layout_two']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include treck_get_template('faq-one.php');
		include treck_get_template('faq-two.php');
	}
}
