<?php

namespace Layerdrops\Treck\Widgets;


class ServiceDetails extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'treck-service-details';
	}

	public function get_title()
	{
		return __('Service Details', 'treck-addon');
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
					'layout_one' => __('Layout One (Image)', 'treck-addon'),
				]
			]
		);

		$this->end_controls_section();

		include  treck_get_elementor_option('service-details-one-option.php');
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include treck_get_template('service-details-one.php');
	}
}
