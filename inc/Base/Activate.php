<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace CG\Base;

class Activate {

    public static function activate() {
        $thisClass = new Activate();
        $thisClass->createTable();
        flush_rewrite_rules();
    }

    public function createTable() {
        global $wpdb;
        $table1 = $wpdb->prefix . 'locations_table';
        $sql = "CREATE TABLE IF NOT EXISTS $table1(
            `id` int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` varchar DEFAULT NULL CHECK (json_valid(`title`)),
            `address` varchar DEFAULT NULL CHECK (json_valid(`address`)),
            `services` longtext DEFAULT NULL CHECK (json_valid(`services`)),
            `status` tinyint(1) DEFAULT 0
        );";

        $wpdb->query($sql);

        $table2 = $wpdb->prefix . 'services_table';
        $sql2 = "CREATE TABLE IF NOT EXISTS $table2(
            `id` int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `service_data` longtext DEFAULT NULL CHECK (json_valid(`service_data`)),
            `facilties` longtext DEFAULT NULL CHECK (json_valid(`facilties`)),
            `shortcode` longtext DEFAULT NULL CHECK (json_valid(`shortcode`)),
            `status` tinyint(1) DEFAULT 0
        );";

        $wpdb->query($sql2);
    }
}