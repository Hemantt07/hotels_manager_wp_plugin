<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace CG\Base;
use CG\Widgets\Locations_widget;
use CG\Widgets\Services_widget;

Class Register_widget{

	public function register () {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_location_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_services_widgets' ] );
    }

	public function init_location_widgets() {

        // Require the widget class.
        require_once __DIR__ . '/../Widgets/Locations_widget.php';

        // Register widget with elementor.
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Locations_widget() );

    }

    public function init_services_widgets() {

        // Require the widget class.
        require_once __DIR__ . '/../Widgets/Services_widget.php';

        // Register widget with elementor.
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Services_widget() );

    }
}