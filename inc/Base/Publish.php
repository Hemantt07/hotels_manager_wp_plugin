<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace CG\Base;

use CG\Widgets\Locations_widget;
use CG\Widgets\Services_widget;

class Publish {

    public static function create_location ( $data ) {
        global $wpdb;

        $locations_table = $wpdb->prefix . 'locations_table';
        $insertableData = [
            'title' => $data['title'],
            'address' => $data['address'],
            'services' => json_encode( $data['services'] ),
            'status' => $data['status'] == 'true' ? '1' : '0'
        ];

        try {
            $wpdb->insert($locations_table, $insertableData);

            if ($wpdb->last_error) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Data inserted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }
}