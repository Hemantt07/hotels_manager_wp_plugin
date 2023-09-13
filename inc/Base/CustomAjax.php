<?php
/**
 * Admin ajax 
 *
 * @package  Custom plugin
 */

namespace CG\Base;

use CG\Base\Publish;

class CustomAjax {

    function register (){
        add_action('wp_ajax_add_location_handler', [ $this, 'add_location_handler' ]);
        add_action('wp_ajax_update_location_handler', [ $this, 'update_location_handler' ]);
        add_action('wp_ajax_delete_location_handler', [ $this, 'delete_location_handler' ]);
    }

    function add_location_handler() {
        $data = $_POST['formData'];
        
        $res = Publish::create_location( $data );

        $response = array(
            'status' => $res[0],
            'message' => $res[1],
            'data' => $data, 
        );
    
        wp_send_json($response);
    
        exit();
    }

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
}