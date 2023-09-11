<?php
/**
 * @package Custom Elementor Widget
 *
 *
 * Plugin Name: Location & Services Manager
 * Description: Add a custom widget for managing locations and services.
 * Version: 1.0.0
 * Author: Hemant Dhiman
 * Author URI:  https://www.cybertrontechnologies.com/
 *   
 */


defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

// Require Once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Define Constants

define ( 'ELEMENTOR_WIDGET_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define ( 'ELEMENTOR_WIDGET_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define ( 'ELEMENTOR_WIDGET_PLUGIN_NAME', plugin_basename( __FILE__ ) );
define ( 'ELEMENTOR_WIDGET_PLUGIN_FILE', plugin_basename( dirname( __FILE__, 3 ) ).'/custom-elementor-widget.php');

use CG\Base\Activate;
use CG\Base\Deactivate;

function activate_elementor_widget_plugin() {
    Activate::activate();
}

function deactivate_elementor_widget_plugin() {
    Deactivate::deactivate();
}

register_activation_hook( __FILE__ , 'activate_elementor_widget_plugin' );
register_deactivation_hook( __FILE__ , 'deactivate_elementor_widget_plugin' );

if ( class_exists( 'CG\\Init' ) ) {
	CG\Init::register_services();
}