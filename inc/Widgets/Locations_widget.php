<?php
/**
 * Location widget
*/
namespace LSM\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Locations_widget extends Widget_Base {

	public $locations;

    public function get_name() {
        return 'custom-location-widget';
    }

    public function get_title() {
        return __('Location Widget', 'Locations_widget');
    }

    public function get_icon() {
        return 'eicon-map-pin';
    }

    public function get_categories() {

        return [ 'basic' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => 'Content',
            )
        );

		$options;
		global $wpdb;
		
		$locations_table = $wpdb->prefix . 'locations_table';
		$query = "SELECT * FROM $locations_table";
		$this->locations = $wpdb->get_results($query);

		if ($this->locations) {
			foreach ($this->locations as $location) {
				$options[$location->id] = $location->title;
			}
		}

		// Location select box

        // $this->add_control(
		// 	'list',
		// 	[
		// 		'label' => esc_html__( 'List', 'textdomain' ),
		// 		'type' => \Elementor\Controls_Manager::REPEATER,
		// 		'fields' => [
		// 			[
		// 				'name'		=> 'location',
		// 				'type'		=> Controls_Manager::SELECT,
		// 				'label' 	=> esc_html__( 'Location', 'textdomain' ),
		// 				'options' 	=> $options,
		// 				'default' 	=> 'Select location',
		// 			],
		// 		],
		// 		'default' => [
		// 			[
		// 				'text' => esc_html__( 'List Item #1', 'textdomain' ),
		// 			],
		// 		],
		// 		'title_field' => '{{{ location }}}',
		// 	]
		// );

		// Columns

		$this->add_control(
			'columns',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Total Columns', 'textdomain' ),
				'placeholder' => '0',
				'min' => 0,
				'max' => 4,
				'step' => 1,
				'default' => 2,
				'selectors' => [
					'{{WRAPPER}} .location-wrapper .loc-wrapper' => 'width: calc(100% / {{VALUE}});',
				],
			]
		);

		// Columns gap

		$this->add_control(
			'columns-gap',
			[
				'type' => Controls_Manager::NUMBER,
				'label' => esc_html__( 'Columns Gap', 'textdomain' ),
				'placeholder' => '0',
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 10,
				'selectors' => [
					'{{WRAPPER}} .location-wrapper .loc-wrapper' => 'padding: {{VALUE}}px',
				],
			]
		);

		// Location bg color 

		$this->add_control(
			'locations-bg-color',
			[
				'label' => esc_html__( 'Locations Background Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .location-wrapper .loc-wrapper .location' => 'background: {{VALUE}}',
				],
			]
		);

		// Font color 

		$this->add_control(
			'font-color',
			[
				'label' => esc_html__( 'Font Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .location-wrapper .loc-wrapper .location .loc_title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .location-wrapper .loc-wrapper .location .loc_address' => 'color: {{VALUE}}',
				],
			]
		);

		// Link

		$this->add_control(
			'link-single',
			[
				'label' => esc_html__( 'Link for single page', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter link for single page', 'textdomain' ),
				'default' => '',
			]
		);

    
        $this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings();
		?><style>.location-wrapper{display:flex;flex-wrap:wrap}.location{display: flex;border-radius: 10px;align-items: center;padding: 5px 6px;box-shadow: 0 0 6px #8f8f8f;}.location .imageWrapper {width: 35%;border-radius: 8px;overflow: hidden;margin-right: 13px;}.location .details {width: 65%;}.location p.loc_title{font-size: 17px;margin: 0;}.location p.loc_address{font-size:16px;font-weight:300;margin-bottom: 10px;line-height:1.3;max-width:503px;opacity: .7;}.location .services ul{list-style:none;padding:0;margin:0;display:flex;flex-wrap:wrap;}.location .services ul li.service{margin:0 10px 10px 0;padding:8px 13px;background:#a59696;border-radius:8px;color:#fff;line-height:1}</style><?php

        if ($this->locations) : ?>
			<div class="location-wrapper">
			<?php foreach ($this->locations as $key => $location) : ?>
				<div class="loc-wrapper">
					<a class="book-now" href="/<?= $settings['link-single'].'?single_loc_id='.$location->id ?>">
						<div class="location">
							<div class="imageWrapper">
								<img src="<?= ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.webp' ?>" alt="location_image">
							</div>
							<div class="details">
								<p class="loc_address"><?= $location->title ?></p>
								<p class="loc_title"><?= $location->address ?></p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
			</div>
		<?php endif;
    }

    protected function _content_template() {
		?><style>.location-wrapper{display:flex;flex-wrap:wrap}.location{display: flex;border-radius: 10px;align-items: center;padding: 5px 6px;box-shadow: 0 0 6px #8f8f8f;}.location .imageWrapper {width: 35%;border-radius: 8px;overflow: hidden;margin-right: 13px;}.location .details {width: 65%;}.location p.loc_title{font-size: 17px;margin: 0;}.location p.loc_address{font-size:16px;font-weight:300;margin-bottom: 10px;line-height:1.3;max-width:503px;opacity: .7;}.location .services ul{list-style:none;padding:0;margin:0;display:flex;flex-wrap:wrap;}.location .services ul li.service{margin:0 10px 10px 0;padding:8px 13px;background:#a59696;border-radius:8px;color:#fff;line-height:1}</style><?php


		if ($this->locations) : ?>
			<div class="location-wrapper">
			<?php foreach ($this->locations as $key => $location) : ?>
				<div class="loc-wrapper">
					<a class="book-now" href="<?= $settings['link-single'].'?single_loc_id='.$location->id ?>">
						<div class="location">
							<div class="imageWrapper">
								<img src="<?= ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.webp' ?>" alt="location_image">
							</div>
							<div class="details">
								<p class="loc_address"><?= $location->title ?></p>
								<p class="loc_title"><?= $location->address ?></p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
			</div>
		<?php endif;
    }

}