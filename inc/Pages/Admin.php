<?php 
/**
 * @package Hotel Manager
 * Admin for pages
 */
namespace LSM\Pages;

class Admin {
	
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() {
		add_menu_page( 
			'Hotels', 
			'Hotels', 
			'manage_options', 
			'hotels-manager', 
			array( $this, 'admin_index' ), 
			'dashicons-hotels', 50 
		);

		add_submenu_page( 
			'hotels-manager',
			'Our Hotels',
			'Our Hotels',
			'manage_options',
			'our-hotels-manager',
			array( $this, 'location_index' ), 
			1,
		);

		add_submenu_page( 
			'hotels-manager', 
			'Services manager', 
			'Services manager', 
			'manage_options', 
			'services-manager', 
			array( $this, 'services_index' ), 
			2,
		);
	}

	function admin_index() {
		require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/admin.php';
	}

	public function location_index() {
		if (isset($_GET['req_type']) && ($_GET['req_type'] == 'new')) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/hotels/add_hotel_page.php';

		} else if ( isset($_GET['req_type']) && ($_GET['req_type'] == 'edit') && isset($_GET['loc_id']) ) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/hotels/update_hotel_page.php';
			
		} else {
			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/hotels/hotels.php';
		}
	}

	public function services_index() {
		if (isset($_GET['req_type']) && ($_GET['req_type'] == 'new' )) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/services/add_service_page.php';
		
		} else if ( isset($_GET['req_type']) && ($_GET['req_type'] == 'edit') && isset($_GET['service_id']) ) {

			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/services/update_service_page.php';
			
		} else {
		
			require_once ELEMENTOR_WIDGET_PLUGIN_PATH . 'inc/Templates/services/services.php';
		
		}
	}
}