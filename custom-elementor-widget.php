<?php
/**
 * @package Hotel Manager
 *
 *
 * Plugin Name: Hotel Manager (Locations & Services)
 * Description: Add a custom widget for managing locations and services.
 * Version: 1.0.0
 * Author: Hemant Dhiman
 * Author URI: https://hemantt07.netlify.app/
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
define ( 'LOCATION_ICON', icon() );

function icon() : String {
    return '<svg width="18" height="21" viewBox="0 0 18 21" fill="white" xmlns="http://www.w3.org/2000/svg">
    <path d="M14.6569 14.6569C13.7202 15.5935 11.7616 17.5521 10.4138 18.8999C9.63275 19.681 8.36768 19.6814 7.58663 18.9003C6.26234 17.576 4.34159 15.6553 3.34315 14.6569C0.218951 11.5327 0.218951 6.46734 3.34315 3.34315C6.46734 0.218951 11.5327 0.218951 14.6569 3.34315C17.781 6.46734 17.781 11.5327 14.6569 14.6569Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M12 9C12 10.6569 10.6569 12 9 12C7.34315 12 6 10.6569 6 9C6 7.34315 7.34315 6 9 6C10.6569 6 12 7.34315 12 9Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
}

use LSM\Base\Activate;
use LSM\Base\Deactivate;

function activate_elementor_widget_plugin() 
{
    Activate::activate();
}

function deactivate_elementor_widget_plugin() 
{
    Deactivate::deactivate();
}

register_activation_hook( __FILE__ , 'activate_elementor_widget_plugin' );
register_deactivation_hook( __FILE__ , 'deactivate_elementor_widget_plugin' );

if ( class_exists( 'LSM\\Init' ) ) 
{
	LSM\Init::register_services();
}