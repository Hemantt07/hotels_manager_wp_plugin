<?php
/**
 * Admin ajax 
 *
 * @package  Custom plugin
 */

namespace CG\Base;

use CG\Base\Publish;

class CustomAjax {

    function __construct(){
        add_action('wp_ajax_custom_ajax_handler', [ $this, 'custom_ajax_handler' ]);
    }

    function custom_ajax_handler() {
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
}