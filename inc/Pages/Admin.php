<?php 
/**
 * @package  Calculaor
 * Admin for pages
 */
namespace LSM\Pages;

class Admin {
	
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() {
		add_menu_page( 
			'Location & Services Manager', 
			'Location & Services Manager', 
			'manage_options', 
			'location-services-manager', 
			array( $this, 'admin_index' ), 
			'dashicons-location', 110 
		);

		add_submenu_page( 
			'location-services-manager', 
			'Sevices manager', 
			'Sevices manager', 
			'manage_options', 
			'services-manager', 
			array( $this, 'services_index' ), 
			1,
		);

		add_submenu_page( 
			'location-services-manager', 
			'Settings', 
			'Settings', 
			'manage_options', 
			'settings', 
			array( $this, 'setting_index' ), 
			2,
		);
	}

	public function admin_index() {
		if (isset($_GET['loc_type']) && ($_GET['loc_type'] == 'new')) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/add_location_page.php';

		} else if ( isset($_GET['loc_type']) && ($_GET['loc_type'] == 'edit') && isset($_GET['loc_id']) ) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/update_location_page.php';
			
		} else {
			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/locations.php';
		}
	}

	public function services_index() {
		if (isset($_GET['service_type']) && ($_GET['service_type'] == 'new' )) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/add_service_page.php';
		
		} else if ( isset($_GET['service_type']) && ($_GET['service_type'] == 'edit') && isset($_GET['service_id']) ) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/update_service_page.php';
			
		} else {
		
			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/services.php';
		
		}
	}

	public function setting_index() {
		require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/settings.php';
	}
}