<?php
/**
 * @package Hotel Manager
 *
 */
namespace LSM\Handlers;
use LSM\Widgets\Locations_widget;
use LSM\Widgets\Services_widget;
use LSM\Widgets\Locations_list;

Class Register_widget{

	public function register () {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_location_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_services_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'] );
    }

	public function init_location_widgets() {

        require_once __DIR__ . '/../Widgets/Locations_widget.php';

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Locations_widget() );

    }

    public function init_services_widgets() {

        require_once __DIR__ . '/../Widgets/Services_widget.php';

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Services_widget() );

    }

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'loc_ser_manager',
			[
				'title' => esc_html__( 'Locations & Services Manager', 'textdomain' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}
}