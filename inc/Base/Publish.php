<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace LSM\Base;

use LSM\Widgets\Locations_widget;
use LSM\Widgets\Services_widget;

class Publish {

    /**
     * Create Location
     */
    public static function create_location ( $data, $img ) {
        global $wpdb;

        $locations_table = $wpdb->prefix . 'locations_table';

        if (isset($img) && $img['error'] === 0) {
            $uploaded_image = wp_handle_upload($img, array('test_form' => false));
            
            if ($uploaded_image && !isset($uploaded_image['error'])) {
                $image_url = $uploaded_image['url'];
            } else {
                echo 'Error uploading image.';
                $image_url = null;
            }
        } else {
            $image_url = null;
        }

        $insertableData = [
            'title'     => $data['title'],
            'address'   => $data['address'],
            'services'  => json_encode( $data['services'] ),
            'image_url' => $image_url,
            'status'    => $data['status'] == 'true' ? '1' : '0'
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
    public static function upload_photos ( $image_file ) {
        if (isset($image_file) && $image_file['error'] === 0) {
            $uploaded_image = wp_handle_upload($image_file, array('test_form' => false));
            
            if ($uploaded_image && !isset($uploaded_image['error'])) {
                $image_url = $uploaded_image['url'];
                return $image_url;
            } else {
                echo 'Error uploading image.';
                return null;
            }
        } else {
            return null;
        }
    }
}