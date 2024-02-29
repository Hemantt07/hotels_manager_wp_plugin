<?php
/**
 * @package Hotel Manager
 *
 */
namespace LSM\Handlers;

use LSM\Widgets\Locations_widget;
use LSM\Widgets\Services_widget;

class Publish {

    /**
     * Create Location
     */
    public static function create_location ( $data, $img ) {
        global $wpdb;

        $hotels_table = $wpdb->prefix . 'hotels_table';

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
            'services'  => implode(',',$data['services'] ),
            'image_url' => $image_url,
            'status'    => $data['status'] == 'true' ? '1' : '0'
        ];


        try {
            $wpdb->insert($hotels_table, $insertableData);

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

        $hotels_table = $wpdb->prefix . 'hotels_table';

        $updateData = [
            'title'     => $data['title'],
            'address'   => $data['address'],
            'image_url' => $data['image_file'],
            'services'  => implode(',',$data['services'] ),
            'status'    => $data['status'] == 'true' ? '1' : '0'
        ];

        $where =[
            'id'    => $data['id']
        ];

        try {
            $updated = $wpdb->update($hotels_table, $updateData, $where);

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

        $hotels_table = $wpdb->prefix . 'hotels_table';

        $where =['id' => $loc_id];

        try {
            $deleted = $wpdb->delete($hotels_table, $where);

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

    /**
     * Create Service
     */
    public static function create_service ( $data ) {
        global $wpdb;

        $services_table = $wpdb->prefix . 'services_table';

        $insertableData = [
            'service_data'  => $data['title'],
            'facilities'    => implode(',',$data['facilities']),
            'status'        => $data['status'] == 'true' ? '1' : '0'
        ];

        try {
            $wpdb->insert($services_table, $insertableData);

            if ($wpdb->last_error) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Service inserted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }

     /**
     * Update Service
     */
    public static function update_service ( $data ) {
        global $wpdb;

        $services_table = $wpdb->prefix . 'services_table';

        $updateData = [
            'service_data'  => $data['title'],
            'facilities'    => implode(',',$data['facilities']),
            'status'        => $data['status'] == 'true' ? '1' : '0'
        ];

        $where =[
            'id'    => $data['id']
        ];

        try {
            $updated = $wpdb->update($services_table, $updateData, $where);

            if ($wpdb->last_error) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Service updated successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }

        /**
     * Delete Service
     */
    public static function delete_Service ( $service_id ) {
        global $wpdb;

        $services_table = $wpdb->prefix . 'services_table';
        $where =['id' => $service_id];

        try {
            $deleted = $wpdb->delete($services_table, $where);

            if ($deleted == false) {
                $status = 'failed';
                $message = 'Database Error: ' . $wpdb->last_error;
            } else {
                $success = 'success';
                $message = 'Service deleted successfully!';
            }

        } catch (\Throwable $th) {
            $status = 'failed';
            $message = 'Something went wrong';
        }

        return [$status, $message];
    }
}