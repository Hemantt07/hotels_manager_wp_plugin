<?php
/**
 * Admin ajax 
 *
 * @package  Custom plugin
 */

namespace LSM\Base;

use LSM\Base\Publish;

class CustomAjax {

    function register (){
        add_action('wp_ajax_add_location_handler', [ $this, 'add_location_handler' ]);
        add_action('wp_ajax_update_location_handler', [ $this, 'update_location_handler' ]);
        add_action('wp_ajax_delete_location_handler', [ $this, 'delete_location_handler' ]);

        add_action('wp_ajax_add_service_handler', [ $this, 'add_service_handler' ]);
        add_action('wp_ajax_update_service_handler', [ $this, 'update_service_handler' ]);
        add_action('wp_ajax_delete_service_handler', [ $this, 'delete_service_handler' ]);
    }

    /**
     * Add new location to the DB
     */
    function add_location_handler() {
        $data = $_POST['formData'];
        $img = $_FILES['location_image'];
        $res = Publish::create_location( $data, $img );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
            'data' => $data, 
        );
    
        wp_send_json($response);
    
        exit();
    }

    /**
     * Update the location
     */
    function update_location_handler() {
        $data = $_POST['formData'];
        
        $res = Publish::update_location( $data );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
            'data' => $data, 
        );
    
        wp_send_json($response);
    
        exit();
    }

    /**
     * Delete location
     */
    function delete_location_handler() {
        $loc_id = $_POST['id'];
        $res = Publish::delete_location( $loc_id );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
        );
    
        wp_send_json($response);
    
        exit();
    }

    /**
     * Add service
     */
    function add_service_handler() {
        $data = $_POST['formData'];
        $res = Publish::create_service( $data );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
            'data' => $data, 
        );
    
        wp_send_json($response);
    
        exit();
    }

    /**
     * Update service
     */
    function update_service_handler() {
        $data = $_POST['formData'];
        $res = Publish::update_service( $data );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
            'data' => $data,
        );
    
        wp_send_json($response);
    
        exit();
    }

    /**
     * Delete Service
     */
    function delete_service_handler() {
        $service_id = $_POST['id'];
        $res = Publish::delete_service( $service_id );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
        );
    
        wp_send_json($response);
    
        exit();
    }
}