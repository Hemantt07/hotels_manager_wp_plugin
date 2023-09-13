<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace CG\Base;

use CG\Widgets\Locations_widget;
use CG\Widgets\Services_widget;

class Publish {

    /**
     * Create Location
     */
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
                $message = 'Location inserted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }

    /**
     * Update Location
     */
    public static function update_location ( $data ) {
        global $wpdb;

        $locations_table = $wpdb->prefix . 'locations_table';

        $updateData = [
            'title'     => $data['title'],
            'address'   => $data['address'],
            'services'  => json_encode( $data['services'] ),
            'status'    => $data['status'] == 'true' ? '1' : '0'
        ];

        $where =[
            'id'    => $data['id']
        ];

        try {
            $updated = $wpdb->update($locations_table, $updateData, $where);

            if ($wpdb->last_error) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Location updated successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }

    /**
     * Delete Location
     */
    public static function delete_location ( $loc_id ) {
        global $wpdb;

        $locations_table = $wpdb->prefix . 'locations_table';

        $where =['id' => $loc_id];

        try {
            $deleted = $wpdb->delete($locations_table, $where);

            if ($deleted == false) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Location deleted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }

    /**
     * Upload Photos
     */
    public static function upload_photos ( $loc_id ) {
        global $wpdb;

        $locations_table = $wpdb->prefix . 'locations_table';

        $where =['id' => $loc_id];

        try {
            $deleted = $wpdb->delete($locations_table, $where);

            if ($deleted == false) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Location deleted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }
}